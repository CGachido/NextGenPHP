<?php

namespace Architecture\Infraestructure\Repository\Eloquent;

use App\Models\User as EloquentUser;
use Architecture\Domain\Entities\User;
use Architecture\Infraestructure\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentUserRepository implements UserRepositoryInterface
{
    protected ?Model $model;
    public function __construct()
    {
        $this->model = new EloquentUser();
    }

    /**     
     * @return User[]
     */
    public function getAll(): array
    {
        $usersData = $this->model::all();
        $users = [];
        foreach ($usersData as $user) {
            array_push($users, User::fromArray($user->toArray()));
        }
        return $users;
    }

    public function findById(int $userId): ?User
    {
        $userData = $this->model::find($userId);
        if (!$userData) {
            return null;
        }
        return User::fromArray($userData->toArray());
    }
}
