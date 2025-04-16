<?php

namespace App\Http\Requests\Api\Locations;

use App\Http\Requests\Api\HasLocationRouteParameter;
use Illuminate\Foundation\Http\FormRequest;

class LocationShowRequest extends FormRequest
{
    use HasLocationRouteParameter;

    public function authorize(): bool
    {
        return $this->user()->can('view', $this->getLocation());
    }

    public function rules(): array
    {
        return [];
    }
}
