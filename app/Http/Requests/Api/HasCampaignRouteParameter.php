<?php

namespace App\Http\Requests\Api;

use App\Models\Campaign;

trait HasCampaignRouteParameter
{
    protected ?Campaign $campaign = null;

    public function getCampaign(): Campaign
    {
        if ($this->campaign === null) {
            $this->campaign = Campaign::findOrFail($this->route('campaign'));
        }

        return $this->campaign;
    }
}
