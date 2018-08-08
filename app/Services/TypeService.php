<?php

namespace App\Services;

use App\Repositories\Contracts\TypeRepositoryInterface;

class TypeService
{
    protected $type;

    public function __construct(TypeRepositoryInterface $type)
    {
        $this->type = $type;
    }

    public function get()
    {

        return $this->type->all();
    }

    public function create(array $data)
    {
        $data['name'] = $data['name'];

        return $this->type->create($data);
    }

    public function find($id)
    {
        return $this->type->find($id);
    }

    public function update(int $id, string $name)
    {

        return $this->type->update($id, compact("name"));
    }

    public function delete($id)
    {
        return $this->type->delete($id);
    }

}
