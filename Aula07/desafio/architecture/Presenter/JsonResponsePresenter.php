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
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }
}
