<?php

namespace App\Models;

use App\Enums\LocationFeatureName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\HasUUID;

class LocationFeature extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'location_id',
        'feature',
        'value',
    ];

    protected $casts = [
        'feature' => LocationFeatureName::class,
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
