<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $location_id
 * @property string $name
 * @property string $url
 * @property string $size
 *
 * @property-read Location $location
 */
class LocationDocument extends Model
{
    protected $fillable = [
        'location_id',
        'name',
        'url',
        'size',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
