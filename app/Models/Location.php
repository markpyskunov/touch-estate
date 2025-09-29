<?php

namespace App\Models;

use App\Enums\VisitorActivityAggregationType;
use App\Enums\VisitorActivityEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\HasUUID;
use App\Models\Traits\HasSorting;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $address_id
 * @property string $company_id
 * @property string|null $campaign_id
 * @property string|null $nfc_qr_tag_id
 * @property string|null $realtor_id
 * @property int|null $area_sqft
 * @property string $description
 * @property string $name
 * @property string $mls
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Address $address
 * @property-read Collection<LocationImage> $locationImages
 * @property-read Collection<LocationFeature> $locationFeatures
 * @property-read Collection<\App\Models\LocationPricing> $locationPricings
 * @property-read Collection<\App\Models\LocationRoom> $locationRooms
 * @property-read Collection<\App\Models\LocationMeta> $locationMetas
 * @property-read Collection<\App\Models\LocationDocument> $locationDocuments
 * @property-read \App\Models\Campaign|null $campaign
 * @property-read \App\Models\NfcQrTag|null $nfcQrTag
 * @property-read \App\Models\Company $company
 * @property-read Collection<LocationNote> $locationNotes
 * @property-read User|null $realtor
 * @property-read Collection<VisitorActivity> $visitorActivities
 * @property-read Collection<VisitorActivityAggregation> $visitorActivityAggregations
 */
class Location extends Model
{
    use HasFactory;
    use HasUUID;
    use HasSorting;

    protected $fillable = [
        'company_id',
        'campaign_id',
        'address_id',
        'realtor_id',
        'area_sqft',
        'description',
        'name',
        'mls',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
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

    public function locationDocuments(): HasMany
    {
        return $this->hasMany(LocationDocument::class);
    }

    public function locationMetas(): HasMany
    {
        return $this->hasMany(LocationMeta::class);
    }

    public function locationRooms(): HasMany
    {
        return $this->hasMany(LocationRoom::class);
    }

    public function nfcQrTag(): BelongsTo
    {
        return $this->belongsTo(NfcQrTag::class);
    }

    public function locationNotes(): HasMany
    {
        return $this->hasMany(LocationNote::class);
    }

    public function inVisitorFavorites(): BelongsToMany
    {
        return $this->belongsToMany(Visitor::class, 'visitors_favorite_locations');
    }

    public function inVisitorSubscription(): BelongsToMany
    {
        return $this->belongsToMany(Visitor::class, 'visitors_subscribed_to_locations');
    }

    public function realtor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visitorActivities(): HasMany
    {
        return $this->hasMany(VisitorActivity::class);
    }

    public function visitorActivityAggregations(): HasMany
    {
        return $this->hasMany(VisitorActivityAggregation::class);
    }

    public function getStats(string $visitorId): array
    {
        return [
            'stats' => [
                'visitors' => (int) VisitorActivityAggregation::query()
                        ->where('aggregation_type', VisitorActivityAggregationType::ALL_TIME)
                        ->where('event', VisitorActivityEvent::VISIT)
                        ->first('value')
                        ?->value ?? 0,
                'favorites' => (int) VisitorActivityAggregation::query()
                        ->where('aggregation_type', VisitorActivityAggregationType::ALL_TIME)
                        ->where('event', VisitorActivityEvent::LIKE)
                        ->first('value')
                        ?->value ?? 0,
            ],
            'is_favorite' => VisitorActivity::query()
                ->where('location_id', $this->id)
                ->where('visitor_id', $visitorId)
                ->where('event', VisitorActivityEvent::LIKE)
                ->latest()
                ->first()
                ?->metadata['state'] ?? false,
            'is_subscribed' => VisitorActivity::query()
                ->where('location_id', $this->id)
                ->where('visitor_id', $visitorId)
                ->where('event', VisitorActivityEvent::SUBSCRIBE)
                ->latest()
                ->first()
                ?->metadata['state'] ?? false,
        ];
    }
}
