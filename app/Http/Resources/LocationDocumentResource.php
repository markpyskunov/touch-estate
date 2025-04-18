<?php

namespace App\Http\Resources;

use App\Models\LocationDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var LocationDocument $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'name' => $model->name,
            'url' => $model->url,
            'size' => $model->size,
            'icon' => $model->icon,
            'icon_color' => $model->icon_color,
        ];
    }
}
