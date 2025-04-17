<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Public\FetchVisitPropertyPayloadRequest;
use App\Http\Resources\PropertyResource;
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
        $type = $request->input('type');
        $visitKey = "visits.visitor_{$request->route('visitor')}.property_{$request->route('property')}.campaign_{$request->route('campaign')}";
        $visitData = Cache::get($visitKey);
        if (!$visitData) {
            return response()->json([
                'message' => 'no visit to collect data'
            ], 417);
        }

        $visitData['code'] = '000000';
        $visitData['data'] = [
            'full_name' => $request->input('name'),
        ];

        switch ($type) {
            case 'email':
                // Collect email
                $emails = $visitData['data']['emails'] ?? [];
                $emails[] = $request->input('contact');
                $emails = array_unique($emails);
                $visitData['data']['emails'] = $emails;
                // Send verification email
                $visitData['verification_sent'] = true;
                break;

            case 'sms':
                // Collect phone number
                $phones = $visitData['data']['phones'] ?? [];
                $phones[] = $request->input('contact');
                $phones = array_unique($phones);
                $visitData['data']['phones'] = $phones;
                // Send verification sms
                $visitData['verification_sent'] = true;
                break;
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

        $visitor = Visitor::find($request->route('visitor'));
        if ($visitor === null) {
            Visitor::create([
                'id' => $request->route('visitor'),
                'location_id' => $request->route('property'),
                'collected_data' => $visitData['data'],
            ]);
        } else {
            $mergedData = $visitor->collected_data;
            $mergedData['emails'] = array_unique(
                array_merge(
                    $mergedData['emails'] ?? [],
                    $visitData['data']['emails'] ?? []
                )
            );

            $mergedData['phones'] = array_unique(
                array_merge(
                    $mergedData['phones'] ?? [],
                    $visitData['data']['phones'] ?? []
                )
            );
            $visitor->update(['collected_data' => $mergedData]);
        }

        return response()->json(
            Cache::get($visitKey)
        );
    }
}
