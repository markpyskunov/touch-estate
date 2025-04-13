<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $location_id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read Location|null $location
 */
class NfcQrTag extends Model
{
    use HasUUID;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'location_id',
        'name',
        'code',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
