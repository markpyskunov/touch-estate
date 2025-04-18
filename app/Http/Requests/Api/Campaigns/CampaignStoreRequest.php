<?php

namespace App\Http\Requests\Api\Campaigns;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CampaignStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Campaign::class);
    }

    public function rules(): array
    {
        return [
            'location_id' => ['nullable', Rule::exists('locations', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'payload' => ['required', 'array'],
        ];
    }
}
