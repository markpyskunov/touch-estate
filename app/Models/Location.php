<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;

/**
 * @property string $id
 * @property string $address_id
 * @property string $company_id
 * @property string $name
 * @property string $mls
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Address $address
 * @property-read \App\Models\LocationImage $locationMainImage
 * @property-read \App\Models\LocationImage[] $locationImages
 * @property-read \App\Models\LocationFeature[] $locationFeatures
 * @property-read \App\Models\LocationPricing[] $locationPricings
 * @property-read \App\Models\LocationRoom[] $locationRooms
 */
class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUUID;

    protected $fillable = [
        'company_id',
        'address_id',
        'location_image_id',
        'name',
        'mls',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function locationImages(): HasMany
    {
        return $this->hasMany(LocationImage::class);
    }

    public function locationFeatures(): HasMany
    {
        return $this->hasMany(LocationFeature::class);
    }

    public function locationPricings(): HasMany
    {
        return $this->hasMany(LocationPricing::class)
            ->latest('active_from');
    }

    public function visitors(): HasMany
    {
        return $this->hasMany(Visitor::class);
    }

    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'locations_campaigns');
    }

    public function locationDocuments(): HasMany
    {
        return $this->hasMany(LocationDocument::class);
    }

    public function locationRooms(): HasMany
    {
        return $this->hasMany(LocationRoom::class);
    }

    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->address->full_address,
        );
    }

    protected function streetAddress(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->address->street_address,
        );
    }

    protected function cityStateZip(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->address->city_state_zip,
        );
    }

    protected function coordinates(): Attribute
    {
        return Attribute::make(
            get: fn (): array => [
                'latitude' => $this->address->latitude,
                'longitude' => $this->address->longitude,
            ],
        );
    }
}
