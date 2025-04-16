<?php

namespace App\Http\Requests\Api\Locations;

use App\Http\Requests\Api\HasSortingPayloadParameters;
use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;

class LocationIndexRequest extends FormRequest
{
    use HasSortingPayloadParameters;

    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Location::class);
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1'],
            ...$this->getSortingRules(['name', 'created_at']),
        ];
    }
}
