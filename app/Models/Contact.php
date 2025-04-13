<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\HasUUID;

/**
 * @property string $id
 * @property string|null $phone
 * @property string|null $phone_2
 * @property string|null $phone_3
 * @property string $email
 * @property string|null $email_2
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Contact extends Model
{
    use HasUUID;
    use HasFactory;

    protected $fillable = [
        'phone',
        'phone_2',
        'phone_3',
        'email',
        'email_2',
        'avatar',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
