<?php

namespace Tests\Feature\Api;

use App\Models\Campaign;
use App\Models\Location;
use App\Models\NfcQrTag;
use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tests\TestCase;

class VisitorControllerTest extends TestCase
{
    use RefreshDatabase;

    private Location $location;
    private Campaign $campaign;
    private NfcQrTag $nfcQrTag;
    private string $vid;
    private string $propertyId;
    private string $campaignId;
    private string $sid;
    private string $accessCode;

    protected function setUp(): void
    {
        parent::setUp();

        $this->location = Location::factory()->create();
        $this->campaign = Campaign::factory()->create([
            'location_id' => $this->location->id,
        ]);
        $this->nfcQrTag = NfcQrTag::factory()->create([
            'location_id' => $this->location->id,
            'code' => 'TEST',
            'index' => '1234',
        ]);

        // Set IDs for later use
        $this->vid = Str::uuid()->toString();
        $this->propertyId = $this->location->id;
        $this->campaignId = $this->campaign->id;
    }

    public function testCompleteVisitorVerificationFlow(): void
    {
        // Step 1: Visit landing page and verify redirection
        $response = $this->get("/lp/{$this->nfcQrTag->full_code}?force=1");
        $response->assertRedirect();

        $redirectUrl = $response->headers->get('Location');
        $this->assertStringContainsString('/real-estate/visit', $redirectUrl);
        $this->assertStringContainsString("property={$this->propertyId}", $redirectUrl);
        $this->assertStringContainsString('sid=', $redirectUrl);
        $this->assertStringContainsString('access_code=', $redirectUrl);
        $this->assertStringContainsString('force=1', $redirectUrl);

        // Extract visitor ID from redirect URL
        parse_str(parse_url($redirectUrl, PHP_URL_QUERY), $queryParams);
        $this->sid = $queryParams['sid'];
        $this->accessCode = $queryParams['access_code'];

        // Step 2: Check initial verification status
        $response = $this->get("/api/v1/visitors/verify-visit/{$this->vid}/{$this->propertyId}/{$this->campaignId}");
        $response->assertOk();
        $response->assertJson([
            'is_verified' => false,
            'verification_sent' => false
        ]);

        // Step 3: Submit verification data
        $response = $this->postJson("/api/v1/visitors/verify-visit/{$this->vid}/{$this->propertyId}/{$this->campaignId}");
        $response->assertOk();

        // Get verification code from cache
        $visitKey = "visits.visitor_{$this->vid}.property_{$this->propertyId}.campaign_{$this->campaignId}";
        $visitData = Cache::get($visitKey);
        $this->assertNotNull($visitData);
        $this->assertTrue($visitData['verification_sent']);

        // Step 4: Complete verification (first attempt)
        $response = $this->patchJson("/api/v1/visitors/verify-visit/{$this->vid}/{$this->propertyId}/{$this->campaignId}", [
            'code' => $visitData['code'],
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
        $response->assertOk();
        $response->assertJson([
            'is_verified' => true
        ]);

        // Verify visitor data was saved
        /** @var Visitor|null $visitor */
        $visitor = Visitor::where('vid', $this->vid)->first();
        $this->assertNotNull($visitor);
        $this->assertEquals('John Doe', $visitor->collected_data['full_name']);
        $this->assertContains('john@example.com', $visitor->collected_data['emails']);

        // Step 5: Submit verification data (second attempt with different email)
        $response = $this->postJson("/api/v1/visitors/verify-visit/{$this->vid}/{$this->propertyId}/{$this->campaignId}");
        $response->assertOk();

        // Get new verification code from cache
        $visitData = Cache::get($visitKey);
        $this->assertNotNull($visitData);
        $this->assertTrue($visitData['verification_sent']);

        // Step 6: Complete verification (second attempt)
        $response = $this->patchJson("/api/v1/visitors/verify-visit/{$this->vid}/{$this->propertyId}/{$this->campaignId}", [
            'code' => $visitData['code'],
            'full_name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
        $response->assertOk();
        $response->assertJson([
            'is_verified' => true
        ]);

        // Verify both emails are in the visitor's data
        $visitor->refresh();
        $this->assertContains('john@example.com', $visitor->collected_data['emails']);
        $this->assertContains('john.doe@example.com', $visitor->collected_data['emails']);
        $this->assertCount(2, $visitor->collected_data['emails']);
    }
}
