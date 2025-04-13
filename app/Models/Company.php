<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;

/**
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $address_id
 * @property string|null $contact_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Address $address
 * @property-read \App\Models\Contact|null $contact
 */
class Company extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'name',
        'address_id',
        'contact_id',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public static function generateUniqueCode(): string
    {
        $characters = range('A', 'Z');
        $maxAttempts = 1000;

        for ($i = 0; $i < $maxAttempts; $i++) {
            $code = '';
            $used = [];

            while (strlen($code) < 4) {
                $char = $characters[random_int(0, 25)];
                if (!in_array($char, $used)) {
                    $code .= $char;
                    $used[] = $char;
                }
            }

            if (Company::whereCode($code)->doesntExist()) {
                return $code;
            }
        }

        throw new \Exception("Unable to generate a unique company code after {$maxAttempts} attempts.");
    }
}
