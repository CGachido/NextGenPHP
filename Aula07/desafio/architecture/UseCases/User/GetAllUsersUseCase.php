<?php

namespace Architecture\UseCases\User;

use Architecture\Infraestructure\UserRepositoryInterface;

class GetAllUsersUseCase
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function execute()
    {
        return $this->userRepository->getAll();
    }
}
