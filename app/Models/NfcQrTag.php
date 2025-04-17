<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $location_id
 * @property string $name
 * @property string $code
 * @property int $index
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read Location|null $location
 * @property-read string $fullCode
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
        'index',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (NfcQrTag $nfcQrTag) {
            $nfcQrTag->code = $nfcQrTag->location->company->code;
            $numeric = NfcQrTag::query()
                ->where('code', $nfcQrTag->location->company->code)
                ->max('index') ?? -1;
            $nfcQrTag->index = $numeric + 1;
        });
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function fullCode(): Attribute
    {
        $numeric = str_pad($this->index, 4, '0', STR_PAD_LEFT);
        return new Attribute(
            get: fn() => "{$this->code}{$numeric}",
        );
    }
}
