<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $location_id
 * @property int $level
 * @property string $name
 * @property int $area_sqft
 * @property string $width_sqft
 * @property string $length_sqft
 * @property string $width_meters
 * @property string $length_meters
 *
 * @property-read array $imperial
 * @property-read array $metric
 * @property-read Location $location
 */
class LocationRoom extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'level',
        'name',
        'area_sqft',
        'width_sqft',
        'length_sqft',
        'width_meters',
        'length_meters',
    ];

    protected $appends = [
        'imperial',
        'metric',
    ];

    public function imperial(): Attribute
    {
        return new Attribute(
            get: fn() => [ 'width' => $this->width_sqft, 'length' => $this->length_sqft ],
        );
    }

    public function metric(): Attribute
    {
        return new Attribute(
            get: fn() => [ 'width' => $this->width_meters, 'length' => $this->length_meters ],
        );
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
