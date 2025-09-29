<?php

namespace App\Models;

use App\Enums\VisitorActivityAggregationType;
use App\Enums\VisitorActivityEvent;
use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string|null $visitor_activity_aggregation_id
 * @property string $visitor_id
 * @property string $location_id
 * @property VisitorActivityAggregationType $aggregation_type
 * @property VisitorActivityEvent $event
 * @property int|null $year
 * @property int|null $month
 * @property int|null $week
 * @property int|null $day
 * @property string $value
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Location $location
 * @property-read VisitorActivityAggregation|null $aggregatedTo
 */
class VisitorActivityAggregation extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'aggregation_type',
        'event',
        'year',
        'month',
        'week',
        'day',
        'value',
    ];

    protected $casts = [
        'aggregation_type' => VisitorActivityAggregationType::class,
        'event' => VisitorActivityEvent::class,
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function aggregatedTo(): BelongsTo
    {
        return $this->belongsTo(static::class, 'visitor_activity_aggregation_id');
    }
}
