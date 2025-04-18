<?php

namespace App\Http\Resources;

use App\Models\Location;
use App\Models\LocationPricing;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Property is a concrete form of a Location
 */
class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Location $model */
        $model = $this->resource;

        $visitor = Visitor::query()->where('vid', $request->route('vid'))->latest()->first();

        return [
            'id' => $model->id,
            'name' => $model->name,
            'mls' => $model->mls,
            'description' => $model->description,
            'address' => AddressResource::make($model->address),
            'location_images' => LocationImageResource::collection($model->locationImages),
            'features' => LocationFeatureResource::collection($model->locationFeatures),
            'pricing' => LocationPricingResource::make($this->calculateCurrentActivePricing($model)),
            'meta' => LocationMetaResource::collection($model->locationMetas),
            'rooms' => LocationRoomResource::collection($model->locationRooms),
            'documents' => LocationDocumentResource::collection($model->locationDocuments),
            'campaign' => CampaignResource::make($model->campaign),
            'notes' => $this->when(
                $visitor,
                fn() => LocationNoteResource::collection(
                    $model
                        ->locationNotes()
                        ->where('visitor_id', $visitor->id)
                        ->get()
                ),
                []
            ),
            'visits' => $this->when(
                $visitor,
                fn() => array_reverse($visitor->visits),
                []
            ),
            'stats' => $model->getStats(),
            'is_favorite' => $this->when(
                $visitor,
                fn() => $visitor->favoriteLocations()->where('location_id', $model->id)->exists(),
                false
            ),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

    private function calculateCurrentActivePricing(Location $location): ?LocationPricing
    {
        $selected = null;
        $location->locationPricings->each(function (LocationPricing $pricing) use (&$selected) {
            if ($selected === null) {
                if ($pricing->active_from->isPast()) {
                    $selected = $pricing;
                }
            }
        });

        return $selected;
    }
}
