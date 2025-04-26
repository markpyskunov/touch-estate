<?php

namespace App\Models;

use App\Enums\RoomType;
use App\Models\Traits\HasUUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $location_id
 * @property int $level
 * @property RoomType $type
 * @property string $name
 * @property int $area_sqft
 * @property string $width_ft
 * @property string $length_ft
 * @property string $width_meters
 * @property string $length_meters
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Location $location
 */
class LocationRoom extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'type',
        'level',
        'name',
        'area_sqft',
        'width_ft',
        'length_ft',
        'width_meters',
        'length_meters',
    ];

    protected $casts = [
        'type' => RoomType::class,
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
