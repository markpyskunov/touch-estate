<?php

namespace App\Http\Resources;

use App\Models\LocationDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin LocationDocument
 */
class LocationDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'size' => $this->size,
            'icon' => $this->icon,
            'icon_color' => $this->icon_color,
        ];
    }
}
