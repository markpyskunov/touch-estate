<?php

namespace Tests\Feature\Api;

use App\Models\Address;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\Location;
use App\Models\NfcQrTag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('visitors')]
class VisitorControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;
    private Company $company;
    private Address $address;
    private Campaign $campaign;
    private Location $location;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->address = Address::factory()->create();
        $this->company = Company::factory()->create(['address_id' => $this->address->id]);
        $this->location = Location::factory()->create(['address_id' => $this->address->id]);
        $this->campaign = Campaign::factory()->create(['location_id' => $this->location->id]);
        $this->nfcQrTag = NfcQrTag::factory()->create(['location_id' => $this->location->id]);
    }
}
