<?php

namespace App\Http\Resources;

use App\Models\LocationRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationRoomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var LocationRoom $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'type' => $model->type,
            'level' => $model->level,
            'name' => $model->name,
            'area_sqft' => $model->area_sqft,
            'width_ft' => $model->width_ft,
            'length_ft' => $model->length_ft,
            'width_meters' => $model->width_meters,
            'length_meters' => $model->length_meters,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
