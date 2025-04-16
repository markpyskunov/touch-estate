<?php

namespace App\Http\Requests\Api\Campaigns;

use App\Http\Requests\Api\HasCampaignRouteParameter;
use Illuminate\Foundation\Http\FormRequest;

class CampaignDestroyRequest extends FormRequest
{
    use HasCampaignRouteParameter;

    public function authorize(): bool
    {
        return $this->user()->can('delete', $this->getCampaign());
    }

    public function rules(): array
    {
        return [];
    }
}
