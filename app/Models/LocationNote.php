<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $note
 *
 * @property-read  Carbon $created_at
 * @property-read  Carbon $updated_at
 * @property-read  Location $location
 * @property-read  Visitor $visitor
 */
class LocationNote extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'note',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class);
    }
}
