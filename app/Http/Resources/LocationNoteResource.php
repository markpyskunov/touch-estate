<?php

namespace App\Http\Resources;

use App\Models\LocationNote;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationNoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var LocationNote $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'note' => $model->note,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
