<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;

/**
 * @property string $id
 * @property string $location_id
 * @property string $visitor_identified_id
 * @property array $collected_data
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Location $location
 */
class Visitor extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'visitor_identified_id',
        'collected_data',
    ];

    protected $casts = [
        'collected_data' => 'json',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
