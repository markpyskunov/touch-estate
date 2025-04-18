<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $location_id
 * @property string $vid UUID from the Frontend
 * @property array $collected_data
 * @property array $visits
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Location $location
 * @property-read \App\Models\Campaign $campaign
 * @property-read Collection<LocationNote> $locationNotes
 */
class Visitor extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'vid',
        'collected_data',
        'visits',
    ];

    protected $casts = [
        'collected_data' => 'json',
        'visits' => 'json',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function locationNotes(): HasMany
    {
        return $this->hasMany(LocationNote::class);
    }

    public function favoriteLocations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'visitors_favorite_locations');
    }
}
