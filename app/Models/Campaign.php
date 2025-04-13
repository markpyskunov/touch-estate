<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;

/**
 * @property string $id
 * @property string $name
 * @property array $payload
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUUID;

    protected $fillable = [
        'name',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
