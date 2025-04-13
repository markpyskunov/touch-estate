<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUUID;

/**
 * @property string $id
 * @property string $location_id
 * @property string $source
 * @property int|null $order
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
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
