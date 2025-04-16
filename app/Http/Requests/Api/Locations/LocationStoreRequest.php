<?php

namespace App\Http\Requests\Api\Locations;

use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Location::class);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'mls' => ['nullable', 'string', 'regex:/^[A-Z]?[0-9]{6,8}$/'],
            'company_id' => ['required', 'uuid', Rule::exists('companies', 'id')],
            'address_id' => ['required', 'uuid', Rule::exists('addresses', 'id')],
        ];
    }
}
