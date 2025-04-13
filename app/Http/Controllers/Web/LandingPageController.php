<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\NfcQrTagResource;
use App\Models\NfcQrTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;

class LandingPageController extends Controller
{
    #[Get('go')]
    public function landingPage(Request $request): JsonResponse
    {
        $tagCode = $request->query('code');
        /** @var NfcQrTag|null $tag */
        $tag = NfcQrTag::query()->whereCode($tagCode)->first();

        if (!$tag) {
            return response()->json('Not found', 404);
        }

        // No tag / No attached location / No attached campaign is OK to lead to error

        $tagId = $tag->id;
        $locationId = $tag->location?->id;
        $campaignId = $tag->location->campaigns()->first()?->id;

        // Need to redirect to vue SPA with Tag ID, location ID, campaign ID
        return response()->json(
            NfcQrTagResource::make($tag)
        );
    }
}
