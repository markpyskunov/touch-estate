<?php

namespace App\Http\Requests\Api;

use App\Models\Location;

trait HasLocationRouteParameter
{
    protected ?Location $location = null;

    public function getLocation(): Location
    {
        if ($this->location === null) {
            $this->location = Location::findOrFail($this->route('location'));
        }

        return $this->location;
    }
}
