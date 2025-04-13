<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    use HasFactory;

    public function toArray(Request $request): array
    {
        return $this->resource->toArray();
    }
}
