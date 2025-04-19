<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Public\FetchVisitPropertyPayloadRequest;
use App\Http\Resources\LocationNoteResource;
use App\Http\Resources\PropertyResource;
use App\Models\Campaign;
use App\Models\Location;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Group;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Patch;
use Spatie\RouteAttributes\Attributes\Post;

#[Group(prefix: 'api/v1/visitors/', as: 'api.v1.visitors.')]
#[Middleware(['guest'])]
class VisitorController extends Controller
{
    #[Get('properties/{vid}/{property}', name: 'fetchVisitPropertyPayload')]
    public function fetchVisitPropertyPayload(FetchVisitPropertyPayloadRequest $request): JsonResponse
    {
        $visitor = Visitor::query()
            ->where('location_id', $request->route('property'))
            ->where('vid', $request->route('vid'))
            ->first();
        if ($visitor) {
            $visits = $visitor->visits ?? [];

            // Do not spam. Visit back >= 30 mins after prev = new visit
            if (!empty($visits) && Carbon::parse(Arr::last($visits)['created_at'])->diffInMinutes(Carbon::now()) >= 30) {
                /**
                 * Types
                 *
                 * qr - if not type param
                 * nfc - if the param is nfc
                 * website - if the param is website
                 */
                $visits[] = [
                    'created_at' => now()->format('Y-m-d H:i:s'),
                    'type' => $request->input('utm_source', 'qr'),
                ];
                $visitor->visits = $visits;
                $visitor->save();
            }
        }

        return response()->json(
            PropertyResource::make(
                $request->getProperty()
            )
        );
    }

    #[Get('verify-visit/{vid}/{property}/{campaign}', name: 'verifyVisit')]
    public function verifyVisit(Request $request): JsonResponse
    {
        $visitKey = "visits.visitor_{$request->route('vid')}.property_{$request->route('property')}.campaign_{$request->route('campaign')}";
        if ($request->query->getBoolean('force')) {
            Cache::forget($visitKey);
        }

        $visitData = Cache::get($visitKey);
        if ($visitData === null) {
            Cache::put(
                $visitKey,
                [
                    'is_verified' => false,
                    'verification_sent' => false,
                ],
                ttl: now()->addDays(2)
            );
        }

        return response()->json(
            Cache::get($visitKey)
        );
    }

    #[Post('verify-visit/{vid}/{property}/{campaign}', name: 'sendNotification')]
    public function sendNotification(Request $request): JsonResponse
    {
        $visitKey = "visits.visitor_{$request->route('vid')}.property_{$request->route('property')}.campaign_{$request->route('campaign')}";
        $visitData = Cache::get($visitKey);
        if (!$visitData) {
            return response()->json([
                'message' => 'no visit to verify',
            ], 417);
        }

        // Generate verification code
        $visitData['code'] = '000000';

        // Send the code
        $visitData['verification_sent'] = true;

        Cache::put(
            $visitKey,
            $visitData,
            now()->addDays(2)
        );

        return response()->json($visitData);
    }

    #[Patch('verify-visit/{vid}/{property}/{campaign}', name: 'verifyCodeAndCollectVerifiedData')]
    public function verifyCodeAndCollectVerifiedData(Request $request): JsonResponse
    {
        $visitKey = "visits.visitor_{$request->route('vid')}.property_{$request->route('property')}.campaign_{$request->route('campaign')}";
        $visitData = Cache::get($visitKey);
        if (!$visitData) {
            return response()->json([
                'message' => 'no visit to verify',
            ], 417);
        }

        if ($visitData['code'] === $request->input('code')) {
            $visitData['is_verified'] = true;

            /** @var Visitor $visitor */
            $visitor = Visitor::query()
                ->where('vid', $request->route('vid'))
                ->where('location_id', $request->route('property'))
                ->first() ?? new Visitor();
            /** @var Campaign $campaign */
            $campaign = Campaign::findOrFail($request->route('campaign'));
            $property = Location::findOrFail($request->route('property'));

            $existingData = $visitor->collected_data ?? [];
            $campaignFields = $campaign->payload['fields'];

            $data = $existingData;
            foreach ($campaignFields as $field) {
                $fieldId = $field['id'];
                if ($field['required'] && $request->missing($fieldId)) {
                    throw new \RuntimeException("Failed to collect required field {$fieldId}");
                }

                $data[$fieldId] = $request->input($fieldId);
            }

            // Handle email and phone separately to maintain history
            if ($request->has('email')) {
                $data['emails'] = array_unique(
                    array_filter(
                        array_merge(
                            $data['emails'] ?? [],
                            [$request->input('email')]
                        )
                    )
                );
            }

            if ($request->has('phone')) {
                $data['phones'] = array_unique(
                    array_filter(
                        array_merge(
                            $data['phones'] ?? [],
                            [$request->input('phone')]
                        )
                    )
                );
            }

            // Persist visitor data
            $visitor->vid = $request->route('vid');
            $visitor->location_id = $property->id;
            $visitor->collected_data = $data;
            $visitor->visits = [
                [
                    'created_at' => now()->format('Y-m-d H:i:s'),
                    'type' => $request->input('utm_source'),
                ]
            ];
            $visitor->save();
        } else {
            return response()->json([
                'message' => 'wrong code',
            ], 417);
        }

        Cache::put(
            $visitKey,
            $visitData,
            ttl: now()->addDays(2)
        );

        return response()->json(
            Cache::get($visitKey)
        );
    }

    #[Patch('toggle-favorite/{vid}/{property}', name: 'toggleFavorite')]
    public function toggleFavorite(Request $request): JsonResponse
    {
        /** @var Visitor $visitor */
        $visitor = Visitor::where('vid', $request->route('vid'))->latest()->firstOrFail();

        $exists = $visitor->favoriteLocations()->where('location_id', $request->route('property'))->exists();
        if ($exists) {
            $visitor->favoriteLocations()->detach($request->route('property'));
        } else {
            $visitor->favoriteLocations()->attach($request->route('property'));
        }

        return response()->json(
            PropertyResource::make(
                Location::findOrFail(
                    $request->route('property')
                )
            )
        );
    }

    #[Post('notes/{vid}/{property}', name: 'storePropertyNote')]
    public function storePropertyNote(Request $request): JsonResponse
    {
        /** @var Visitor $visitor */
        $visitor = Visitor::where('vid', $request->route('vid'))->latest()->firstOrFail();
        /** @var Location $property */
        $property = Location::findOrFail($request->route('property'));

        return response()->json(
            LocationNoteResource::make(
                $property->locationNotes()->create([
                    'visitor_id' => $visitor->id,
                    'note' => $request->input('note'),
                ])
            )
        );
    }
}
