<?php

namespace App\Http\Resources;

use App\Models\LocationRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin LocationRoom
 */
class LocationRoomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'level' => $this->level,
            'name' => $this->name,
            'area_sqft' => $this->area_sqft,
            'width_ft' => $this->width_ft,
            'length_ft' => $this->length_ft,
            'width_meters' => $this->width_meters,
            'length_meters' => $this->length_meters,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
