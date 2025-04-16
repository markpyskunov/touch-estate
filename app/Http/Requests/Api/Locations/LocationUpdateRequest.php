<?php

namespace App\Http\Requests\Api\Locations;

use App\Http\Requests\Api\HasLocationRouteParameter;
use Illuminate\Foundation\Http\FormRequest;

class LocationUpdateRequest extends FormRequest
{
    use HasLocationRouteParameter;

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->getLocation());
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
