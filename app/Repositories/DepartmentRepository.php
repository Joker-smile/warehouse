<?php

namespace App\Repositories;

use App\Contracts\Repositories\AbstractRepository;
use App\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;

class DepartmentRepository extends AbstractRepository implements DepartmentRepositoryInterface
{
    public function model()
    {
        return Department::class;
    }

}
