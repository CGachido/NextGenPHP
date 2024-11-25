<?php

namespace Architecture\Presenter;

use Illuminate\Http\JsonResponse;

class JsonResponsePresenter implements ResponsePresenterInterface
{
    public function success($data, int $statusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json(
            $data,
            $statusCode
        );
    }

    public function error(string $message, int $statusCode): JsonResponse
    {
        return response()->json([
            'error' => $message,
        ], $statusCode);
    }

    public function internalError(): JsonResponse
    {
        return response()->json(
            "Internal error. Please, contact the support.",
            JsonResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
