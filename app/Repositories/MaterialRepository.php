<?php

namespace App\Repositories;

use App\Contracts\Repositories\AbstractRepository;
use App\Material;
use App\Repositories\Contracts\MaterialRepositoryInterface;

class MaterialRepository extends AbstractRepository implements MaterialRepositoryInterface
{
    public function model()
    {
        return Material::class;
    }
}
