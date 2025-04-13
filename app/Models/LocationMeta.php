<?php

namespace App\Models;

use App\Enums\LocationMetaKey;
use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $location_id
 * @property \App\Enums\LocationMetaKey $key
 * @property string $value
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \App\Models\Location $location
 */
class LocationMeta extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'key',
        'value',
    ];

    protected $casts = [
        'key' => LocationMetaKey::class,
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
