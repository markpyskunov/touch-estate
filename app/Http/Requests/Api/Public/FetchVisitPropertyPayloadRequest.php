<?php

namespace App\Http\Requests\Api\Public;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;

class FetchVisitPropertyPayloadRequest extends FormRequest
{
    public function authorize(): bool
    {
        $sid = $this->query('sid');
        $accessCode = $this->query('access_code');

        $cacheCode = Cache::get("visitor_session.{$sid}")['access_code'] ?? null;
        return $cacheCode && $cacheCode === $accessCode;
    }

    public function rules(): array
    {
        return [];
    }
}
