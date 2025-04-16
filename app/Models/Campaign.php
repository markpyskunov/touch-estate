<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;
use App\Models\Traits\HasSorting;

/**
 * @property string $id
 * @property string $location_id
 * @property string $name
 * @property array $payload
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\Location $location
 */
class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUUID;
    use HasSorting;

    protected $fillable = [
        'location_id',
        'name',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
