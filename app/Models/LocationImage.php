<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $location_id
 * @property string $source
 * @property null|string $title
 * @property null|int $order
 * @property boolean $is_default
 * @property boolean $is_featured
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \App\Models\Location $location
 */
class LocationImage extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'source',
        'title',
        'order',
        'is_default',
        'is_featured',
    ];

    protected $casts = [
        'is_default' => 'bool',
        'is_featured' => 'bool',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
