<?php

namespace App\Services;

use App\Contracts\Repositories\Criterias\WhereCriteria;
use App\Repositories\Contracts\MaterialRepositoryInterface;

class MaterialService
{
    private $material;

    public function __construct(MaterialRepositoryInterface $material)
    {
        $this->material = $material;
    }

    public function get(array $args = [])
    {

        if ($material_name = array_get($args, 'material_name')) {
            $this->material->pushCriteria(new WhereCriteria("name", 'like', "%{$material_name}%"));
        }

        if ($supplier = array_get($args, 'supplier')) {
            $this->material->pushCriteria(new WhereCriteria("supplier", 'like', "%{$supplier}%"));
        }

        if ($department_id = array_get($args, 'type')) {
            $this->material->pushCriteria(new WhereCriteria("type", $department_id));
        }

        return $this->material->paginate();

    }

    public function inAll()
    {
        return $this->material->all();
    }

    public function find($id)
    {
        return $this->material->find($id);
    }

    public function delete($id)
    {
        return $this->material->delete($id);
    }

    public function update($id, array $data = [])
    {
        return $this->material->update($id, $data);
    }

    public function create(array $data = [])
    {
        return $this->material->create($data);
    }

}
