<?php

namespace App\Services;

use App\Contracts\Repositories\Criterias\WhereCriteria;
use App\Record;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use App\Repositories\Contracts\MaterialRepositoryInterface;
use App\Repositories\Contracts\RecordRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class RecordService
{
    protected $record;
    protected $user;
    protected $depart;
    protected $material;

    public function __construct(
        RecordRepositoryInterface $record,
        UserRepositoryInterface $user,
        DepartmentRepositoryInterface $depart,
        MaterialRepositoryInterface $material) {

        $this->record   = $record;
        $this->user     = $user;
        $this->depart   = $depart;
        $this->material = $material;
    }

    public function create(array $data)
    {
        $this->record->create($data);
    }

    public function get(array $args = [])
    {

        $record = $this->args($args);

        return $record->with(['department', 'material', 'user'])->orderBy("created_at", "desc")->paginate();
    }

    public function excelData(array $args = [])
    {
        $record  = $this->args($args);
        $records = $record->with(['department', 'material', 'user'])->all(['id', 'user_id', 'department_id', 'material_id', 'type', 'before', 'after', 'created_at', 'adjust_reason']);

        foreach ($records as $key => $record) {

            $record->user_id       = $record->user->name;
            $record->department_id = $record->department->name;
            $record->material_id   = $record->material->name;
            $record->unit          = $record->material->unit;
            $record->surplus       = $record->after - $record->before;
            $record->type          = $record->getTypeNameAttribute();

        }

        $result = $records->toArray();
        return $result;

    }

    private function args($args)
    {
        if ($user_id = array_get($args, 'user_id')) {
            $this->record->pushCriteria(new WhereCriteria("user_id", $user_id));
        }

        if ($department_id = array_get($args, 'department_id')) {
            $this->record->pushCriteria(new WhereCriteria("department_id", $department_id));
        }

        if ($type = array_get($args, 'type')) {
            $this->record->pushCriteria(new WhereCriteria("type", '=', $type));
        }

        if (array_get($args, 'start_time') && array_get($args, 'end_time')) {
            $this->record->pushCriteria(new WhereCriteria("created_at", 'between', [$args['start_time'] . ' 00:00:00', $args['end_time'] . ' 23:59:59']));
        }

        return $this->record;
    }

}
