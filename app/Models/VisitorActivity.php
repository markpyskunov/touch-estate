<?php

namespace App\Models;

use App\Enums\VisitorActivityEvent;
use App\Enums\VisitorActivityType;
use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $visitor_id
 * @property string $location_id
 * @property VisitorActivityType $type
 * @property string $event
 * @property array $metadata
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Location $location
 * @property-read Visitor $visitor
 * @property-read VisitorActivityAggregation|null $aggregate
 */
class VisitorActivity extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'campaign_id',
        'type',
        'event',
        'metadata',
    ];

    protected $casts = [
        'type' => VisitorActivityType::class,
        'event' => VisitorActivityEvent::class,
        'metadata' => 'json',
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function aggregate(): BelongsTo
    {
        return $this->belongsTo(VisitorActivityAggregation::class);
    }
}
