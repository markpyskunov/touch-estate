<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\MustHaveVidCookie;
use App\Http\Requests\Api\Public\FetchVisitPropertyPayloadRequest;
use App\Http\Resources\LocationNoteResource;
use App\Http\Resources\VisitorToPropertyResource;
use App\Models\Campaign;
use App\Models\Location;
use App\Models\Visitor;
use App\Services\VisitorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Group;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Patch;
use Spatie\RouteAttributes\Attributes\Post;

#[Group(prefix: 'api/v1/visitors/', as: 'api.v1.visitors.')]
#[Middleware(['guest', MustHaveVidCookie::class])]
class VisitorController extends Controller
{
    public function __construct(
        private readonly VisitorService $visitorService,
    )
    {
    }

    #[Get('properties/{property}', name: 'fetchVisitPropertyPayload')]
    public function fetchVisitPropertyPayload(FetchVisitPropertyPayloadRequest $request): JsonResponse
    {
        $visitor = $this->visitorService->getVisitorByVid(
            $this->visitorService->extractVidFromRequest($request)
        );

        $lastVisit = $this->visitorService->getVisitorLastVisit($visitor);
        if (!$lastVisit || now()->diffInMinutes($lastVisit->created_at) > 60) {
            if ($request->getProperty()->campaign_id) {
                $this->visitorService->pushVisitEvent(
                    $visitor,
                    $request->getProperty()->id,
                    $request->getProperty()->campaign_id,
                    $request->input('utm_source', 'qr')
                );
            }
        }

        $property = $request->getProperty();
        $property->_visitor = $visitor;
        $property->_stats = $this->visitorService->getVisitorStatsOnLocation($visitor->id, $property->id);
        return response()->json(
            VisitorToPropertyResource::make($property)
        );
    }

    #[Get('verify-visit/{property}/{campaign}', name: 'verifyVisit')]
    public function verifyVisit(Request $request): JsonResponse
    {
        $visitKey = $this->visitorService->getVisitCacheKey(
            $request->cookie('vid'),
            $request->route('property'),
            $request->route('campaign')
        );

        return response()->json(
            $this->visitorService->getVisitDataFromCache(
                $visitKey,
                $request->query->getBoolean('force')
            )
        );
    }

    #[Post('verify-visit/{property}/{campaign}', name: 'sendNotification')]
    public function sendNotification(Request $request): JsonResponse
    {
        $visitKey = $this->visitorService->getVisitCacheKey(
            $request->cookie('vid'),
            $request->route('property'),
            $request->route('campaign')
        );

        if (!$this->visitorService->visitDataExists($visitKey)) {
            return response()->json([
                'message' => 'no visit to verify',
            ], 417);
        }

        $visitData = $this->visitorService->getVisitDataFromCache($visitKey);

        // Generate verification code
        $visitData['code'] = '000000';
        // Send the code
        $visitData['verification_sent'] = true;

        $this->visitorService->putVisitDataToCache($visitKey, $visitData);

        return response()->json($visitData);
    }

    #[Patch('verify-visit/{property}/{campaign}', name: 'verifyCodeAndCollectVerifiedData')]
    public function verifyCodeAndCollectVerifiedData(Request $request): JsonResponse
    {
        $visitKey = $this->visitorService->getVisitCacheKey(
            $request->cookie('vid'),
            $request->route('property'),
            $request->route('campaign')
        );

        if (!$this->visitorService->visitDataExists($visitKey)) {
            return response()->json([
                'message' => 'no visit to verify',
            ], 417);
        }

        $visitData = $this->visitorService->getVisitDataFromCache($visitKey);
        if ($visitData['code'] !== $request->input('code')) {
            return response()->json([
                'message' => 'wrong code',
            ], 417);
        }

        $visitData['is_verified'] = true;

        /** @var Visitor $visitor */
        $visitor = $this->visitorService->getVisitorByVid(
            $this->visitorService->extractVidFromRequest($request)
        );
        /** @var Campaign $campaign */
        $campaign = Campaign::findOrFail($request->route('campaign'));
        $property = Location::findOrFail($request->route('property'));

        $campaignFields = $campaign->payload['fields'];
        DB::transaction(function () use ($campaignFields, $request, $visitor, $property, $campaign) {
            foreach ($campaignFields as $field) {
                $fieldId = $field['id'];
                if ($field['required'] && $request->missing($fieldId)) {
                    throw new \RuntimeException("Failed to collect required field {$fieldId}");
                }

                $this->visitorService->pushCollectedDataPoint(
                    $visitor,
                    $property->id,
                    $campaign->id,
                    $fieldId,
                    $request->input($fieldId)
                );
            }
        });

        $this->visitorService->putVisitDataToCache($visitKey, $visitData);
        return response()->json($visitData);
    }

    #[Patch('toggle-favorite/{property}', name: 'toggleFavorite')]
    public function toggleFavorite(Request $request): JsonResponse
    {
        $visitor = $this->visitorService->getVisitorByVid(
            $this->visitorService->extractVidFromRequest($request)
        );

        return response()->json([
            'current_state' => $this->visitorService->pushLikeEvent(
                $visitor,
                $request->route('property')
            ),
        ]);
    }

    #[Patch('toggle-subscribe/{property}', name: 'toggleSubscribe')]
    public function toggleSubscribe(Request $request): JsonResponse
    {
        $visitor = $this->visitorService->getVisitorByVid(
            $this->visitorService->extractVidFromRequest($request)
        );

        return response()->json([
            'current_state' => $this->visitorService->pushSubscribeEvent(
                $visitor,
                $request->route('property')
            ),
        ]);
    }

    #[Post('notes/{property}', name: 'storePropertyNote')]
    public function storePropertyNote(Request $request): JsonResponse
    {
        $visitor = $this->visitorService->getVisitorByVid(
            $this->visitorService->extractVidFromRequest($request)
        );
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
