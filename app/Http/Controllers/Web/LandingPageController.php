<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\NfcQrTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;

class LandingPageController extends Controller
{
    #[Get('lp/{code}')]
    public function realEstateLandingPage(Request $request): JsonResponse|RedirectResponse
    {
        $tagCode = $request->route('code');
        /** @var NfcQrTag|null $tag */
        $tag = NfcQrTag::query()->whereCode($tagCode)->first();

        // No tag / No attached location / No attached campaign is OK to lead to error
        if (!$tag) {
            return response()->json('Not found tag', 404);
        }

        $locationId = $tag->location?->id;
        $campaignId = $tag->location->campaigns()->first()?->id;

        if (!$locationId) {
            return response()->json('Not found property', 404);
        }

        if (!$campaignId) {
            return response()->json('Not found campaign', 404);
        }

        return redirect(
            config('app.url') . "/real-estate/visit?campaign={$campaignId}&property={$locationId}"
        );
    }
}
