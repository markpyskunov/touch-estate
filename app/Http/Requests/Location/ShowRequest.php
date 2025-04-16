<?php

namespace App\Http\Requests\Location;

use App\Http\Requests\Api\HasLocationRouteParameter;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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