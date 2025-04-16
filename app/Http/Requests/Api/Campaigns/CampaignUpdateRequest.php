<?php

namespace App\Http\Requests\Api\Campaigns;

use App\Http\Requests\Api\HasCampaignRouteParameter;
use Illuminate\Foundation\Http\FormRequest;

class CampaignUpdateRequest extends FormRequest
{
    use HasCampaignRouteParameter;

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->getCampaign());
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'payload' => ['required', 'array'],
        ];
    }
}
