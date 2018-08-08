<?php

namespace App\Repositories;

use App\Contracts\Repositories\AbstractRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }
}
