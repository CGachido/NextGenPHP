<?php

namespace App\Http\Controllers;

use Architecture\Presenter\ResponsePresenterInterface;
use Architecture\UseCases\User\GetAllUsersUseCase;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function __construct(
        protected GetAllUsersUseCase $getAllUsersUseCase,
        protected ResponsePresenterInterface $responsePresenter
    ) {}

    public function getAll(): JsonResponse
    {
        $users = $this->getAllUsersUseCase->execute();
        return $this->responsePresenter->success(
            array_map(fn($user) => $user->toArray(), $users)
        );
    }
}
