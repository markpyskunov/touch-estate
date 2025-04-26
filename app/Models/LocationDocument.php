<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property int $location_id
 * @property string $name
 * @property string $url
 * @property string $size
 * @property string $icon
 * @property string $icon_color
 *
 * @property-read Location $location
 */
class LocationDocument extends Model
{
    use HasUUID;

    protected $fillable = [
        'location_id',
        'name',
        'url',
        'size',
        'icon',
        'icon_color',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
