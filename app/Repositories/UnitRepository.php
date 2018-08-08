<?php

namespace App\Repositories;

use App\Contracts\Repositories\AbstractRepository;
use App\Repositories\Contracts\UnitRepositoryInterface;
use App\Unit;

class UnitRepository extends AbstractRepository implements UnitRepositoryInterface
{
    public function model()
    {
        return Unit::class;
    }
}
