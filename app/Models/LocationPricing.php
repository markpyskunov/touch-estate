<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\HasUUID;

/**
 * @property string $id
 * @property string $location_id
 * @property int $price_before
 * @property int|null $price_after
 * @property \Illuminate\Support\Carbon $active_from
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \App\Models\Location $location
 */
class LocationPricing extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'price_before',
        'price_after',
        'active_from',
    ];

    protected $casts = [
        'active_from' => 'datetime',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
