<?php

namespace App\Services;

use App\Repositories\Contracts\UnitRepositoryInterface;

class UnitService
{
    protected $unit;

    public function __construct(UnitRepositoryInterface $unit)
    {
        $this->unit = $unit;
    }

    public function get()
    {

        return $this->unit->all();
    }

    public function create(array $data)
    {
        $data['name'] = $data['name'];

        return $this->unit->create($data);
    }

    public function find($id)
    {
        return $this->unit->find($id);
    }

    public function update(int $id, string $name)
    {

        return $this->unit->update($id, compact("name"));
    }

    public function delete($id)
    {
        return $this->unit->delete($id);
    }

}
