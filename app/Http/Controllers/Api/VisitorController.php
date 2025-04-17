<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Public\FetchVisitPropertyPayloadRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Campaign;
use App\Models\Location;
use App\Models\Visitor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    #[Get('properties/{property}', name: 'fetchVisitPropertyPayload')]
    public function fetchVisitPropertyPayload(FetchVisitPropertyPayloadRequest $request): JsonResponse
    {
        $property = Location::with([
            'address',
            'locationImages',
            'locationFeatures',
            'locationPricings',
            'locationMetas',
            'locationRooms',
            'campaign',
        ])->findOrFail($request->route('property'));

        return response()->json(
            PropertyResource::make($property)
        );
    }

    #[Get('verify-visit/{visitor}/{property}/{campaign}', name: 'verifyVisit')]
    public function verifyVisit(Request $request): JsonResponse
    {
        $visitKey = "visits.visitor_{$request->route('visitor')}.property_{$request->route('property')}.campaign_{$request->route('campaign')}";
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

    #[Post('verify-visit/{visitor}/{property}/{campaign}', name: 'collectVerificationData')]
    public function collectVerificationData(Request $request): JsonResponse
    {
        $visitKey = "visits.visitor_{$request->route('visitor')}.property_{$request->route('property')}.campaign_{$request->route('campaign')}";
        $visitData = Cache::get($visitKey);
        if (!$visitData) {
            return response()->json([
                'message' => 'no visit to verify',
            ], 417);
        }

        $visitor = Visitor::find($request->route('visitor')) ?? new Visitor();
        $campaign = Campaign::findOrFail($request->route('campaign'));

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

        // Update visitor data
        $visitor->collected_data = $data;
        $visitor->save();

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

    #[Patch('verify-visit/{visitor}/{property}/{campaign}', name: 'finishVerification')]
    public function finishVerification(Request $request): JsonResponse
    {
        $visitKey = "visits.visitor_{$request->route('visitor')}.property_{$request->route('property')}.campaign_{$request->route('campaign')}";
        $visitData = Cache::get($visitKey);
        if (!$visitData) {
            return response()->json([
                'message' => 'no visit to verify',
            ], 417);
        }

        if ($visitData['code'] === $request->input('code')) {
            $visitData['is_verified'] = true;
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
}
