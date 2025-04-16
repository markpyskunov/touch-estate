<?php

namespace App\Http\Requests\Api\Campaigns;

use App\Http\Requests\Api\HasCampaignRouteParameter;
use Illuminate\Foundation\Http\FormRequest;

class CampaignShowRequest extends FormRequest
{
    use HasCampaignRouteParameter;

    public function authorize(): bool
    {
        return $this->user()->can('view', $this->getCampaign());
    }

    public function rules(): array
    {
        return [];
    }
}
