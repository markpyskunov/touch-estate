<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\HasUUID;
use Illuminate\Support\Collection;

/**
 * @property string $id UUID from the HTTP Cookie that FE assigns
 * @property \Illuminate\Support\Carbon $last_seen_at
 * @property int $visits
 * @property null|array $profile
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Collection<LocationNote> $locationNotes
 * @property-read Collection<VisitorActivity> $visitorActivities
 * @property-read Collection<VisitorActivityAggregation> $visitorActivityAggregations
 */
class Visitor extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'id',
        'last_seen_at',
        'visits',
        'profile',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
        'profile' => 'json',
    ];

    public function locationNotes(): HasMany
    {
        return $this->hasMany(LocationNote::class);
    }

    public function visitorActivities(): HasMany
    {
        return $this->hasMany(VisitorActivity::class);
    }

    public function visitorActivityAggregations(): HasMany
    {
        return $this->hasMany(VisitorActivityAggregation::class);
    }
}
