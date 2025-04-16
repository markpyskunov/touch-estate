<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder sortByDTO(?array $sortDTO)
 */
trait HasSorting
{
    public function scopeSortByDTO(Builder $query, ?array $sortDTO): Builder
    {
        return $query->when(
            $sortDTO && isset($sortDTO['sort_by']),
            fn($q) => $q->orderBy($sortDTO['sort_by'], $sortDTO['sort_direction'] ?? 'asc'),
            fn($q) => $q->latest()
        );
    }
}
