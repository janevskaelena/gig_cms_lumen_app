<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthenticateAppToken
{
    /**
     * Handle an incoming request fixed token authentication
     *
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
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
