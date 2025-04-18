<?php

namespace Tests\Feature\Api;

use App\Models\Address;
use App\Models\Company;
use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('locations')]
class LocationControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;
    private Company $company;
    private Address $address;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->company = Company::factory()->create();
        $this->address = Address::factory()->create();
    }

    public function testCanListLocations(): void
    {
        Location::factory()->count(3)->create([
            'company_id' => $this->company->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson('/api/v1/locations');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'address',
                        'location_images',
                        'features',
                        'pricing',
                        'meta',
                        'rooms',
                        'campaign',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links',
                'meta',
            ]);
    }

    public function testCanFilterLocations(): void
    {
        $location = Location::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Test Location',
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson('/api/v1/locations?search=Test');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Test Location')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'address',
                        'location_images',
                        'features',
                        'pricing',
                        'meta',
                        'rooms',
                        'campaign',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function testCanSortLocations(): void
    {
        Location::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'B Location',
        ]);
        Location::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'A Location',
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson('/api/v1/locations?sort_by=name&sort_direction=asc');

        $response->assertOk()
            ->assertJsonPath('data.0.name', 'A Location')
            ->assertJsonPath('data.1.name', 'B Location')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'address',
                        'location_images',
                        'features',
                        'pricing',
                        'meta',
                        'rooms',
                        'campaign',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function testCanShowLocation(): void
    {
        $location = Location::factory()->create([
            'company_id' => $this->company->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson("/api/v1/locations/{$location->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'address',
                    'location_images',
                    'features',
                    'pricing',
                    'meta',
                    'rooms',
                    'campaign',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => [
                    'id' => $location->id,
                    'name' => $location->name,
                ],
            ]);
    }

    public function testCanCreateLocation(): void
    {
        Storage::fake('public');

        $data = [
            'company_id' => $this->company->id,
            'address_id' => Address::factory()->create()->id,
            'name' => 'Test Location',
        ];

        Passport::actingAs($this->user);
        $response = $this->postJson('/api/v1/locations', $data);

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'address',
                    'location_images',
                    'features',
                    'pricing',
                    'meta',
                    'rooms',
                    'campaign',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => [
                    'name' => 'Test Location',
                ],
            ]);

        $this->assertDatabaseHas('locations', [
            'name' => 'Test Location',
            'company_id' => $this->company->id,
        ]);
    }

    public function testCanUpdateLocation(): void
    {
        Storage::fake('public');

        $location = Location::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $data = [
            'name' => 'Updated Location',
            'company_id' => $this->company->id,
            'address' => '456 Updated St',
            'city' => 'Updated City',
            'state' => 'US',
            'zip' => '54321',
            'country' => 'Updated Country',
            'latitude' => 46.0,
            'longitude' => -76.0,
        ];

        Passport::actingAs($this->user);
        $response = $this->patchJson("/api/v1/locations/{$location->id}", $data);

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'address',
                    'location_images',
                    'features',
                    'pricing',
                    'meta',
                    'rooms',
                    'campaign',
                    'campaign',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => [
                    'name' => 'Updated Location',
                ],
            ]);

        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'name' => 'Updated Location',
            'company_id' => $this->company->id,
        ]);
    }

    public function testCanDeleteLocation(): void
    {
        $location = Location::factory()->create([
            'company_id' => $this->company->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->deleteJson("/api/v1/locations/{$location->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('locations', ['id' => $location->id]);
    }

    public function testUnauthorizedUserCannotAccessLocations(): void
    {
        $response = $this->getJson('/api/v1/locations');

        $response->assertUnauthorized();
    }

    public function testValidationErrorsOnCreate(): void
    {
        $data = [
            'company_id' => 'invalid-uuid',
            'address_id' => 'invalid-uuid',
        ];

        Passport::actingAs($this->user);
        $response = $this->postJson('/api/v1/locations', $data);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
                'company_id',
                'address_id',
            ]);
    }

    public function testValidationErrorsOnUpdate(): void
    {
        $location = Location::factory()->create([
            'company_id' => $this->company->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->patchJson("/api/v1/locations/{$location->id}", []);

        $response->assertSuccessful();
    }
}
