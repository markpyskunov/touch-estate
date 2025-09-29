<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustHaveVidCookie
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasCookie('vid')) {
            return $next($request);
        }

        return response()->json(['message' => 'Must have vid cookie in order to use this endpoint'], 403);
    }
}
