<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Campaigns\CampaignDestroyRequest;
use App\Http\Requests\Api\Campaigns\CampaignIndexRequest;
use App\Http\Requests\Api\Campaigns\CampaignShowRequest;
use App\Http\Requests\Api\Campaigns\CampaignStoreRequest;
use App\Http\Requests\Api\Campaigns\CampaignUpdateRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Group;
use Spatie\RouteAttributes\Attributes\Patch;
use Spatie\RouteAttributes\Attributes\Post;

#[Group(prefix: 'api/v1/campaigns', as: 'api.v1.campaigns.')]
class CampaignController extends Controller
{
    #[Get('/', name: 'index')]
    public function index(CampaignIndexRequest $request): JsonResponse
    {
        $campaigns = Campaign::query()
            ->latest()
            ->paginate($request->input('per_page', 15));

        return CampaignResource::collection($campaigns)
            ->response();
    }

    #[Post('/', name: 'store')]
    public function store(CampaignStoreRequest $request): JsonResponse
    {
        $campaign = Campaign::create($request->validated());

        return CampaignResource::make($campaign)
            ->response()
            ->setStatusCode(201);
    }

    #[Get('{campaign}', name: 'show')]
    public function show(CampaignShowRequest $request): JsonResponse
    {
        return CampaignResource::make($request->getCampaign())
            ->response();
    }

    #[Patch('{campaign}', name: 'update')]
    public function update(CampaignUpdateRequest $request): JsonResponse
    {
        $request->getCampaign()->update($request->validated());

        return CampaignResource::make($request->getCampaign()->refresh())
            ->response();
    }

    #[Delete('{campaign}', name: 'destroy')]
    public function destroy(CampaignDestroyRequest $request): JsonResponse
    {
        $request->getCampaign()->delete();

        return response()->json(null, 204);
    }
}
