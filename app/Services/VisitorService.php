<?php

namespace App\Services;

use App\Enums\VisitorActivityAggregationType;
use App\Enums\VisitorActivityEvent;
use App\Enums\VisitorActivityType;
use App\Models\Visitor;
use App\Models\VisitorActivity;
use App\Models\VisitorActivityAggregation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class VisitorService
{
    public function initVisitorSession(): array
    {
        $sid = Str::uuid()->toString();
        $accessCode = Str::uuid()->toString();

        Cache::put("visitor_session.{$sid}", [
            'access_code' => $accessCode,
        ], ttl: now()->addMinutes(30));

        return [$sid, $accessCode];
    }

    public function extractVidFromRequest(Request $request): ?string
    {
        return $request->cookie('vid');
    }

    public function alreadyVisitedLocation(string $vid, string $locationId): bool
    {
        return VisitorActivity::query()
            ->where('visitor_id', $vid)
            ->where('location_id', $locationId)
            ->exists();
    }

    public function getOrCreateVisitorById(string $id): Visitor
    {
        $visitor = Visitor::find($id);
        if (!$visitor) {
            $visitor = new Visitor();
            $visitor->id = $id;
            $visitor->save();
        }

        return $visitor;
    }

    public function getVisitorByVid(string $id): Visitor
    {
        return Visitor::findOrFail($id);
    }

    public function getVisitorLastVisit(Visitor|string $visitor): ?VisitorActivity
    {
        if (is_string($visitor)) {
            $visitor = $this->getVisitorByVid($visitor);
        }

        return $visitor
            ->visitorActivities()
            ->where('type', VisitorActivityType::VISITS)
            ->where('event', VisitorActivityEvent::VISIT)
            ->latest()
            ->first();
    }

    public function pushVisitEvent(
        Visitor $visitor,
        string $locationId,
        string $campaignId,
        string $visitSourceType
    ): void {
        $visitor
            ->visitorActivities()
            ->create([
                'location_id' => $locationId,
                'campaign_id' => $campaignId,
                'type' => VisitorActivityType::VISITS,
                'event' => VisitorActivityEvent::VISIT,
                'metadata' => [
                    'type' => $visitSourceType,
                ],
            ]);

        $visitor->visits += 1;
        $visitor->last_seen_at = now();
        $visitor->save();
    }

    public function getVisitCacheKey(
        string $vid,
        string $locationId,
        string $campaignId
    ): string {
        return "visits.visitor_{$vid}.property_{$locationId}.campaign_{$campaignId}";
    }

    public function getVisitDataFromCache(string $visitKey, bool $force = false): array
    {
        if ($force) {
            Cache::forget($visitKey);
        }

        $visitData = Cache::get($visitKey);
        if ($visitData === null) {
            $visitData = [
                'is_verified' => false,
                'verification_sent' => false,
            ];

            $this->putVisitDataToCache($visitKey, $visitData);
        }

        return $visitData;
    }

    public function putVisitDataToCache(string $visitKey, array $visitData): void
    {
        Cache::put(
            $visitKey,
            $visitData,
            ttl: now()->addDays(2)
        );
    }

    public function visitDataExists(string $visitKey): bool
    {
        return Cache::has($visitKey);
    }

    public function pushCollectedDataPoint(
        Visitor $visitor,
        string $locationId,
        string $campaignId,
        string $key,
        string|int $value
    ): void {
        if (!$value) {
            return;
        }

        if (in_array($key, ['email', 'phone'])) {
            $profile = $visitor->profile ?? [];
            $touched = false;
            if (!isset($profile[$key])) {
                $profile[$key] = [$value];
                $touched = true;
            } else {
                if (!in_array($value, $profile[$key])) {
                    $profile[$key][] = $value;
                    $touched = true;
                }
            }

            if ($touched) {
                $visitor->save();
            }
        }

        $visitor
            ->visitorActivities()
            ->create([
                'location_id' => $locationId,
                'campaign_id' => $campaignId,
                'type' => VisitorActivityType::DATA_POINT,
                'event' => VisitorActivityEvent::COLLECTED_DATA_POINT,
                'metadata' => [$key => $value],
            ]);
    }

    public function pushLikeEvent(Visitor $visitor, string $locationId): bool
    {
        $latestEvent = $visitor
            ->visitorActivities()
            ->where('location_id', $locationId)
            ->where('type', VisitorActivityType::ENGAGEMENT)
            ->where('event', VisitorActivityEvent::LIKE)
            ->latest()
            ->first();
        $latestState = $latestEvent
            ? $latestEvent->metadata['state']
            : false;

        $visitor
            ->visitorActivities()
            ->create([
                'location_id' => $locationId,
                'type' => VisitorActivityType::ENGAGEMENT,
                'event' => VisitorActivityEvent::LIKE,
                'metadata' => [
                    'state' => !$latestState,
                ]
            ]);

        return !$latestState;
    }

    public function pushSubscribeEvent(Visitor $visitor, string $locationId): bool
    {
        $latestEvent = $visitor
            ->visitorActivities()
            ->where('location_id', $locationId)
            ->where('type', VisitorActivityType::ENGAGEMENT)
            ->where('event', VisitorActivityEvent::SUBSCRIBE)
            ->latest()
            ->first();
        $latestState = $latestEvent
            ? $latestEvent->metadata['state']
            : false;

        $visitor
            ->visitorActivities()
            ->create([
                'location_id' => $locationId,
                'type' => VisitorActivityType::ENGAGEMENT,
                'event' => VisitorActivityEvent::SUBSCRIBE,
                'metadata' => [
                    'state' => !$latestState,
                ]
            ]);

        return !$latestState;
    }

    public function getVisitorStatsOnLocation(string $visitorId, string $locationId): array
    {
        return [
            'stats' => [
                'visitors' => (int) VisitorActivityAggregation::query()
                        ->where('aggregation_type', VisitorActivityAggregationType::ALL_TIME)
                        ->where('event', VisitorActivityEvent::VISIT)
                        ->first('value')
                        ?->value ?? 0,
                'favorites' => (int) VisitorActivityAggregation::query()
                        ->where('aggregation_type', VisitorActivityAggregationType::ALL_TIME)
                        ->where('event', VisitorActivityEvent::LIKE)
                        ->first('value')
                        ?->value ?? 0,
            ],
            'visits' => VisitorActivity::query()
                ->where('type', VisitorActivityType::VISITS)
                ->where('visitor_id', $visitorId)
                ->get()
                ->map(fn(VisitorActivity $visitorActivity) => [
                    'created_at' => $visitorActivity->created_at,
                    'type' => $visitorActivity->metadata['type'],
                ]),
            'is_favorite' => VisitorActivity::query()
                    ->where('location_id', $locationId)
                    ->where('visitor_id', $visitorId)
                    ->where('event', VisitorActivityEvent::LIKE)
                    ->latest()
                    ->first()
                    ?->metadata['state'] ?? false,
            'is_subscribed' => VisitorActivity::query()
                    ->where('location_id', $locationId)
                    ->where('visitor_id', $visitorId)
                    ->where('event', VisitorActivityEvent::SUBSCRIBE)
                    ->latest()
                    ->first()
                    ?->metadata['state'] ?? false,
        ];
    }
}
