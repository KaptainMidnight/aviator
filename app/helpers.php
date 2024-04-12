<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('json')) {
    function json(array $data = [], int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }
}
