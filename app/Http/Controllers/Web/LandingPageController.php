<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\NfcQrTag;
use App\Services\VisitorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\RouteAttributes\Attributes\Get;

class LandingPageController extends Controller
{
    public function __construct(
        private readonly VisitorService $visitorService,
    )
    {
    }

    // Local example /lp/ABCD0?force=1
    #[Get('lp/{code}')]
    public function realEstateLandingPage(Request $request): JsonResponse|RedirectResponse
    {
        $visitorId = $this->visitorService->extractVidFromRequest($request);
        $hadCookieFromBeginning = !!$visitorId;
        if (!$hadCookieFromBeginning) {
            $visitorId = Str::uuid()->toString();
        }

        $this->visitorService->getOrCreateVisitorById($visitorId);
        $tagCode = $request->route('code');
        $companyCode = Str::substr($tagCode, 0, 4);
        $index = (int) Str::substr($tagCode, 4, 4);

        /** @var NfcQrTag|null $tag */
        $tag = NfcQrTag::with([
            'location.campaign',
        ])->where('code', $companyCode)->where('index', $index)->first();

        // No tag / No attached location / No attached campaign is OK to lead to error
        if (!$tag) {
            return response()->json(['message' => 'Not found tag'], 404);
        }

        $locationId = $tag->location?->id;
        $campaignId = $tag->location->campaign?->id;

        if (!$locationId) {
            return response()->json(['message' => 'Not found property'], 404);
        }

        if (!$campaignId) {
            return response()->json(['message' => 'Not found campaign'], 404);
        }

        [$sid, $accessCode] = $this->visitorService->initVisitorSession();

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
        $response = response()->redirectTo(
            '/real-estate/visit?' . http_build_query($params),
        );

        if (!$hadCookieFromBeginning) {
            $response = $response->withCookie(
                cookie(
                    'vid',
                    $visitorId,
                    525600,
                    '/',
                    null,
                    $request->isSecure(),
                    true,
                    false,
                    'Lax'
                )
            );
        }

        return $response;
    }
}
