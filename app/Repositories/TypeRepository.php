<?php

namespace App\Repositories;

use App\Contracts\Repositories\AbstractRepository;
use App\Repositories\Contracts\TypeRepositoryInterface;
use App\Type;

class TypeRepository extends AbstractRepository implements TypeRepositoryInterface
{
    public function model()
    {
        return Type::class;
    }
}
