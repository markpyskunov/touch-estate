<?php

namespace App\Http\Requests\Api\Public;

use App\Models\Location;
use App\Services\VisitorService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;

class FetchVisitPropertyPayloadRequest extends FormRequest
{
    private VisitorService $visitorService;
    private Location $property;

    public function authorize(): bool
    {
        if ($vid = $this->getVisitService()->extractVidFromRequest($this)) {
            $exists = $this->getVisitService()->alreadyVisitedLocation($vid, $this->getProperty()->id);

            if ($exists) {
                return true;
            }
        }

        $sessionId = $this->query('sid');
        $accessCode = $this->query('access_code');

        $cacheCode = Cache::get("visitor_session.{$sessionId}")['access_code'] ?? null;
        return $cacheCode && $cacheCode === $accessCode;
    }

    public function rules(): array
    {
        return [];
    }

    public function getProperty(): Location
    {
        if (!isset($this->property)) {
            $this->property = Location::with([
                'address',
                'locationImages',
                'locationFeatures',
                'locationPricings',
                'locationMetas',
                'locationRooms',
                'locationNotes',
                'campaign',
            ])->findOrFail($this->route('property'));
        }

        return $this->property;
    }

    public function getVisitService(): VisitorService
    {
        if (!isset($this->visitorService)) {
            $this->visitorService = app(VisitorService::class);
        }

        return $this->visitorService;
    }
}
