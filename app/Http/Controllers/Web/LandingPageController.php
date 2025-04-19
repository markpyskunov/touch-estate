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
        $companyCode = Str::substr($tagCode, 0, 4);
        $index = (int) Str::substr($tagCode, 4, 4);

        /** @var NfcQrTag|null $tag */
        $tag = NfcQrTag::with([
            'location.campaign',
        ])->where('code', $companyCode)->where('index', $index)->first();

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
        ], ttl: now()->addMinutes(30));

        $params = [
            'property' => $locationId,
            'sid' => $sid,
            'access_code' => $accessCode,
            'force' => $request->query->getBoolean('force'),
            'utm_source' => $request->query('utm_source', 'qr'),
        ];
        if (!$params['force']) {
            unset($params['force']);
        }
        return redirect(
            config('app.url') . '/real-estate/visit?' . http_build_query($params),
        );
    }
}
