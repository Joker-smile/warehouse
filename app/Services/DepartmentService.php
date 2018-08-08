<?php

namespace App\Services;

use App\Contracts\Repositories\Criterias\WhereCriteria;
use App\Exceptions\Exception;
use App\Repositories\Contracts\DepartmentRepositoryInterface;

class DepartmentService
{
    protected $department;

    public function __construct(DepartmentRepositoryInterface $department)
    {
        $this->department = $department;
    }

    public function get(array $args = [])
    {
        if ($user_id = array_get($args, 'user_id')) {
            $this->department->pushCriteria(new WhereCriteria("user_id", $user_id));
        }

        return $this->department->with("user")->withCount('materials')->paginate();
    }

    public function find($id)
    {
        return $this->department->find($id);
    }

    public function update($id, array $data)
    {
        $department = $this->department->find($id);
        if ($department->type == 'warehouse') {

            throw new Exception("总仓库不能修改!");

        }

        return $this->department->update($id, $data);
    }

    public function store(array $data)
    {
        $data['type'] = 'workshop';

        return $this->department->create($data);
    }

    public function warehouse()
    {
        $this->department->pushCriteria(new WhereCriteria("type", "warehouse"));

        return $this->department->first();
    }

    public function workshops()
    {
        $this->department->pushCriteria(new WhereCriteria("type", "workshop"));

        return $this->department->all();
    }
}
