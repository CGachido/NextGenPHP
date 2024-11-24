<?php

namespace Architecture\Presenter;

use Illuminate\Http\JsonResponse;

interface ResponsePresenterInterface
{
    public function success($data, int $statusCode = JsonResponse::HTTP_OK): JsonResponse;

    public function error(string $message, int $statusCode): JsonResponse;
}
