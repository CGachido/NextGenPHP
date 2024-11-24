<?php

namespace Architecture\Infraestructure;

use Architecture\Domain\Entities\User;

interface UserRepositoryInterface
{
    /**     
     * @return User[]
     */
    public function getAll(): array;

    /**     
     * @return User
     */
    public function findById(int $userId): ?User;
}
