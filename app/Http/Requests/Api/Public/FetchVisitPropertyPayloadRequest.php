<?php

namespace App\Http\Requests\Api\Public;

use App\Models\Location;
use App\Models\Visitor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;

class FetchVisitPropertyPayloadRequest extends FormRequest
{
    private Location $property;

    public function authorize(): bool
    {
        if ($vid = $this->route('vid')) {
            $exists = Visitor::query()
                ->where('vid', $vid)
                ->where('location_id', $this->getProperty()->id)
                ->exists();

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
}
