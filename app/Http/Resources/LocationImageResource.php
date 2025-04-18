<?php

namespace App\Http\Resources;

use App\Models\LocationImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var LocationImage $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'source' => $model->source,
            'title' => $model->title,
            'order' => $model->order,
            'is_default' => $model->is_default,
            'is_featured' => $model->is_featured,
        ];
    }
}
