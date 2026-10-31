<?php

namespace App\Traits;

use App\Consts\HttpCode;
use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * @param string $message The error message.
     * @param HttpCode $code The status code.
     */
    protected function error($message, HttpCode $code = HttpCode::BadRequest): JsonResponse
    {
        return response()->json(['errors' => ['message' => [$message]]], $code->value);
    }

    /**
     * @param string $route The route name.
     * @param mixed $parameters The route parameters.
     */
    protected function redirect($route, $parameters = []): JsonResponse
    {
        return response()->json(
            ['redirect' => route($route, $parameters)],
            HttpCode::OK->value
        );
    }
}