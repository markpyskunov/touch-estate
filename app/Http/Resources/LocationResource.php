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
            'name' => $model->name,
            'address' => AddressResource::make($model->address),
            'location_images' => LocationImageResource::make($model->locationImages),
            'features' => LocationFeatureResource::collection($model->locationFeatures),
            'pricing' => LocationPricingResource::collection($model->locationPricings),
            'meta' => LocationMetaResource::collection($model->locationMetas),
            'rooms' => LocationRoomResource::collection($model->locationRooms),
            'nfc_qr_tags' => NfcQrTagResource::collection($model->nfcQrTags),
            'campaign' => CampaignResource::make($model->campaign),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
