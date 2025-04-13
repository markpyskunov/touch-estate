<?php

namespace App\Http\Resources;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Location $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'address_id' => $model->address_id,
            'location_image_id' => $model->location_image_id,
            'name' => $model->name,
            'is_active' => $model->is_active,
            'mls' => $model->mls,
            'full_address' => $model->full_address,
            'street_address' => $model->street_address,
            'city_state_zip' => $model->city_state_zip,
            'coordinates' => $model->coordinates,
            'address' => new AddressResource($model->address),
            'location_image' => new LocationImageResource($model->locationImage),
            'features' => LocationFeatureResource::collection($model->features),
            'pricing' => LocationPricingResource::collection($model->pricing),
            'meta' => LocationMetaResource::collection($model->meta),
            'rooms' => LocationRoomResource::collection($model->rooms),
            'nfc_qr_tags' => NfcQrTagResource::collection($model->nfcQrTags),
            'campaigns' => CampaignResource::collection($model->campaigns),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
