<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InputValidator
{
    /**
     * Handle an incoming request validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $fullyQualifiedNameOfModel)
    {
        $model = app($fullyQualifiedNameOfModel);

        $validator = app('validator')->make($request->input(), $model->rules($request));

        if ($validator->fails()) {
            return new JsonResponse([
                'error' => $validator->errors()
            ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $next($request);
    }
}
