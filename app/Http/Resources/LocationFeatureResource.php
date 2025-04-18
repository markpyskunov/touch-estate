<?php

namespace App\Http\Resources;

use App\Models\LocationFeature;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationFeatureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var LocationFeature $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'feature' => $model->feature,
            'value' => $this->castValue($model->value),
        ];
    }

    private function castValue(string $value): bool|int|float|string
    {
        if ($value === 'true' || $value === 'false') {
            return $value === 'true';
        }

        if (is_numeric($value)) {
            return str_contains($value, '.')
                ? (int) $value
                : (float) $value;
        }

        return $value;
    }
}
