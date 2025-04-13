<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * @property string $place_id
 * @property string $formatted_address
 * @property string|null $street_number
 * @property string|null $route
 * @property string|null $locality
 * @property string|null $administrative_area_level_1
 * @property string|null $administrative_area_level_2
 * @property string|null $country
 * @property string|null $postal_code
 * @property float|null $latitude
 * @property float|null $longitude
 * @property array|null $address_components
 * @property array|null $types
 * @property array|null $viewport
 * @property array|null $geometry
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
class Address extends Model
{
    use SoftDeletes;
    use HasUUID;
    use HasFactory;

    protected $fillable = [
        'place_id',
        'formatted_address',
        'street_number',
        'route',
        'locality',
        'administrative_area_level_1',
        'administrative_area_level_2',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'address_components',
        'types',
        'viewport',
        'geometry',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'address_components' => 'array',
        'types' => 'array',
        'viewport' => 'array',
        'geometry' => 'array',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->formatted_address,
        );
    }

    protected function streetAddress(): Attribute
    {
        return Attribute::make(
            get: fn (): string => trim(implode(' ', array_filter([
                $this->street_number,
                $this->route,
            ]))),
        );
    }

    protected function cityStateZip(): Attribute
    {
        return Attribute::make(
            get: fn (): string => trim(implode(', ', array_filter([
                $this->locality,
                $this->administrative_area_level_1,
                $this->postal_code,
            ]))),
        );
    }
} 