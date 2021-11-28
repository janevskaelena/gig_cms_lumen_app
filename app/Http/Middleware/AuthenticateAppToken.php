<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthenticateAppToken
{
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            if (!$request->header('Authorization')) {
                return response()->json(['error' => 'Authorisation data is missing.'], Response::HTTP_UNAUTHORIZED);
            }
            if ($request->header('Authorization') === env('GIG_AUTH_TOKEN')) {
                return $next($request);
            }
            return response()->json(['error' => 'Unauthorized.'], Response::HTTP_FORBIDDEN);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
