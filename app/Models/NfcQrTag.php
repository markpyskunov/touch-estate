<?php

namespace App\Models;

use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $id
 * @property string $name
 * @property string $code
 * @property int $index
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read string $fullCode
 * @property-read Location|null $location
 */
class NfcQrTag extends Model
{
    use HasUUID;
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'index',
        'is_active',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (NfcQrTag $nfcQrTag) {
            $numeric = NfcQrTag::query()
                ->where('code', $nfcQrTag->code)
                ->max('index') ?? -1;
            $nfcQrTag->index = $numeric + 1;
        });
    }

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function fullCode(): Attribute
    {
        $numeric = str_pad($this->index, 4, '0', STR_PAD_LEFT);
        return new Attribute(
            get: fn() => "{$this->code}{$numeric}",
        );
    }
}
