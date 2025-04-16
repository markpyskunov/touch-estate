<?php

namespace Tests\Feature\Api;

use App\Models\Campaign;
use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('campaigns')]
class CampaignControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;
    private Location $location;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->location = Location::factory()->create();
    }

    public function testCanListCampaigns(): void
    {
        Campaign::factory()->count(3)->create([
            'location_id' => $this->location->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson('/api/v1/campaigns');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'payload',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links',
                'meta',
            ]);
    }

    public function testCanFilterCampaigns(): void
    {
        $campaign = Campaign::factory()->create([
            'location_id' => $this->location->id,
            'name' => 'Test Campaign',
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson('/api/v1/campaigns?search=Test');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Test Campaign')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'payload',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function testCanSortCampaigns(): void
    {
        Campaign::factory()->create([
            'location_id' => $this->location->id,
            'name' => 'B Campaign',
        ]);
        Campaign::factory()->create([
            'location_id' => $this->location->id,
            'name' => 'A Campaign',
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson('/api/v1/campaigns?sort_by=name&sort_direction=asc');

        $response->assertOk()
            ->assertJsonPath('data.0.name', 'A Campaign')
            ->assertJsonPath('data.1.name', 'B Campaign')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'payload',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function testCanShowCampaign(): void
    {
        $campaign = Campaign::factory()->create([
            'location_id' => $this->location->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->getJson("/api/v1/campaigns/{$campaign->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'payload',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => [
                    'id' => $campaign->id,
                    'name' => $campaign->name,
                ],
            ]);
    }

    public function testCanCreateCampaign(): void
    {
        $data = [
            'location_id' => $this->location->id,
            'name' => 'Test Campaign',
            'payload' => [
                'fields' => [
                    [
                        'id' => 'name',
                        'required' => true,
                        'type' => 'text',
                    ],
                ],
                'flags' => [
                    'email_login' => true,
                    'sms_login' => true,
                ],
            ],
        ];

        Passport::actingAs($this->user);
        $response = $this->postJson('/api/v1/campaigns', $data);

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'payload',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => [
                    'name' => 'Test Campaign',
                ],
            ]);
    }

    public function testCanUpdateCampaign(): void
    {
        $campaign = Campaign::factory()->create([
            'location_id' => $this->location->id,
        ]);

        $data = [
            'name' => 'Updated Campaign',
            'payload' => [
                'fields' => [
                    [
                        'id' => 'name',
                        'required' => true,
                        'type' => 'text',
                    ],
                ],
                'flags' => [
                    'email_login' => true,
                    'sms_login' => true,
                ],
            ],
        ];

        Passport::actingAs($this->user);
        $response = $this->patchJson("/api/v1/campaigns/{$campaign->id}", $data);

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'payload',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'data' => [
                    'name' => 'Updated Campaign',
                ],
            ]);
    }

    public function testCanDeleteCampaign(): void
    {
        $campaign = Campaign::factory()->create([
            'location_id' => $this->location->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->deleteJson("/api/v1/campaigns/{$campaign->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted($campaign);
    }

    public function testUnauthorizedUserCannotAccessCampaigns(): void
    {
        $response = $this->getJson('/api/v1/campaigns');
        $response->assertUnauthorized();
    }

    public function testValidationErrorsOnCreate(): void
    {
        Passport::actingAs($this->user);
        $response = $this->postJson('/api/v1/campaigns', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'payload']);
    }

    public function testValidationErrorsOnUpdate(): void
    {
        $campaign = Campaign::factory()->create([
            'location_id' => $this->location->id,
        ]);

        Passport::actingAs($this->user);
        $response = $this->patchJson("/api/v1/campaigns/{$campaign->id}", []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'payload']);
    }
}
