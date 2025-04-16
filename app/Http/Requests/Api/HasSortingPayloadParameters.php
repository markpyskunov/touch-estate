<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

trait HasSortingPayloadParameters
{
    protected function getSortingRules(array $availableValues): array
    {
        return [
            'sort_by' => ['nullable', 'string', Rule::in($availableValues)],
            'sort_direction' => ['nullable', 'string', Rule::in(['asc', 'desc'])],
        ];
    }

    public function toDto(): ?array
    {
        if ($this->input('sort_by') === null) {
            return null;
        }

        return [
            'sort_by' => $this->input('sort_by'),
            'sort_direction' => $this->input('sort_direction', 'asc'),
        ];
    }
}
