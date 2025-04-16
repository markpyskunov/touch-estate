<?php

namespace App\Http\Requests\Api\Campaigns;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

class CampaignIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Campaign::class);
    }

    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
