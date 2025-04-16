<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Locations\LocationDestroyRequest;
use App\Http\Requests\Api\Locations\LocationIndexRequest;
use App\Http\Requests\Api\Locations\LocationShowRequest;
use App\Http\Requests\Api\Locations\LocationStoreRequest;
use App\Http\Requests\Api\Locations\LocationUpdateRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Group;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Patch;
use Spatie\RouteAttributes\Attributes\Post;

#[Group(prefix: 'api/v1/locations', as: 'api.v1.locations.')]
#[Middleware(['auth:api'])]
class LocationController extends Controller
{
    #[Get('/', name: 'index')]
    public function index(LocationIndexRequest $request): JsonResponse
    {
        $locations = Location::sortByDTO($request->toDto())
            ->paginate($request->input('per_page', 15));

        return LocationResource::collection($locations)
            ->response();
    }

    #[Post('/', name: 'store')]
    public function store(LocationStoreRequest $request): JsonResponse
    {
        $location = Location::create($request->validated());

        return LocationResource::make($location)
            ->response()
            ->setStatusCode(201);
    }

    #[Get('{location}', name: 'show')]
    public function show(LocationShowRequest $request): JsonResponse
    {
        return LocationResource::make($request->getLocation())
            ->response();
    }

    #[Patch('{location}', name: 'update')]
    public function update(LocationUpdateRequest $request): JsonResponse
    {
        $request->getLocation()->update($request->validated());

        return LocationResource::make($request->getLocation()->refresh())
            ->response();
    }

    #[Delete('{location}', name: 'destroy')]
    public function destroy(LocationDestroyRequest $request): JsonResponse
    {
        $request->getLocation()->delete();

        return response()->json(null, 204);
    }
}
