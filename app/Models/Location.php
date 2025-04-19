<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUUID;
use App\Models\Traits\HasSorting;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $address_id
 * @property string $company_id
 * @property string $user_id
 * @property int|null $area_sqft
 * @property string $description
 * @property string $name
 * @property string $mls
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @property-read \App\Models\Address $address
 * @property-read Collection<LocationImage> $locationImages
 * @property-read Collection<LocationFeature> $locationFeatures
 * @property-read Collection<\App\Models\LocationPricing> $locationPricings
 * @property-read Collection<\App\Models\LocationRoom> $locationRooms
 * @property-read Collection<\App\Models\LocationMeta> $locationMetas
 * @property-read Collection<\App\Models\LocationDocument> $locationDocuments
 * @property-read Collection<\App\Models\NfcQrTag> $nfcQrTags
 * @property-read null|\App\Models\Campaign $campaign
 * @property-read \App\Models\Company $company
 * @property-read Collection<LocationNote> $locationNotes
 * @property-read User|null $realtor
 */
class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUUID;
    use HasSorting;

    protected $fillable = [
        'company_id',
        'address_id',
        'user_id',
        'area_sqft',
        'description',
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

    public function locationDocuments(): HasMany
    {
        return $this->hasMany(LocationDocument::class);
    }

    public function locationMetas(): HasMany
    {
        return $this->hasMany(LocationMeta::class);
    }

    public function campaign(): HasOne
    {
        return $this->hasOne(Campaign::class);
    }

    public function locationRooms(): HasMany
    {
        return $this->hasMany(LocationRoom::class);
    }

    public function nfcQrTags(): HasMany
    {
        return $this->hasMany(NfcQrTag::class);
    }

    public function locationNotes(): HasMany
    {
        return $this->hasMany(LocationNote::class);
    }

    public function inVisitorFavorites(): BelongsToMany
    {
        return $this->belongsToMany(Visitor::class, 'visitors_favorite_locations');
    }

    public function realtor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStats(): array
    {
        return [
            'visitors' => Visitor::query()->where('location_id', $this->id)->count(),
            'favorites' => $this->inVisitorFavorites()->count(),
        ];
    }
}
