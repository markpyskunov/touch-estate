<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\NfcQrTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\RouteAttributes\Attributes\Get;

class LandingPageController extends Controller
{
    #[Get('lp/{code}')]
    public function realEstateLandingPage(Request $request): JsonResponse|RedirectResponse
    {
        $tagCode = $request->route('code');
        /** @var NfcQrTag|null $tag */
        $tag = NfcQrTag::with([
            'location.campaign',
        ])->whereCode($tagCode)->first();

        // No tag / No attached location / No attached campaign is OK to lead to error
        if (!$tag) {
            return response()->json('Not found tag', 404);
        }

        $locationId = $tag->location?->id;
        $campaignId = $tag->location->campaign?->id;

        if (!$locationId) {
            return response()->json('Not found property', 404);
        }

        if (!$campaignId) {
            return response()->json('Not found campaign', 404);
        }

        $sid = Str::uuid()->toString();
        $accessCode = Str::uuid()->toString();

        Cache::put("visitor_session.{$sid}", [
            'access_code' => $accessCode,
        ], ttl: now()->addMinutes(10));

        $params = [
            'property' => $locationId,
            'sid' => $sid,
            'access_code' => $accessCode,
            'force' => $request->query->getBoolean('force'),
        ];
        return redirect(
            config('app.url') . '/real-estate/visit?' . http_build_query($params),
        );
    }
}
