<?php

namespace App\Services;

use App\Exceptions\Exception;
use Illuminate\Support\Facades\DB;

class WarehouseService
{
    protected $material;

    protected $department;

    protected $record;

    public function __construct(
        MaterialService $material,
        DepartmentService $department,
        RecordService $record
    ) {

        $this->department = $department;

        $this->material = $material;

        $this->record = $record;
    }

    public function in(array $data)
    {
        return DB::transaction(function () use ($data) {
            $warehouse = $this->warehouse();

            foreach ($data as $in) {
                $material_id = array_get($in, 'material_id');
                $quantity    = intval(array_get($in, 'quantity'));

                //skip if quantity less than 0 too.
                if (!$material_id || !$quantity || $quantity < 0) {
                    continue;
                }

                //if the specification doesn't exists
                if (!$material = $this->material->find($material_id)) {
                    continue;
                }

                //update existing record
                if ($existing = $this->material($warehouse, $material_id)) {
                    $new_quantity = $existing->pivot->quantity + $quantity;
                    $this->updateQuantity($warehouse, $material_id, $new_quantity);
                    $this->record($warehouse, $material_id, 'in', $existing->pivot->quantity, $new_quantity);
                } else {
                    $this->newMaterial($warehouse, $material_id, $quantity);
                    $this->record($warehouse, $material_id, 'in', 0, $quantity);
                }

            }
        });
    }

    public function out(array $data)
    {
        return DB::transaction(function () use ($data) {
            $department_id = array_get($data, 'department_id');

            if (!$department = $this->department->find($department_id)) {
                throw new Exception("找不到该车间");
            }

            $warehouse = $this->warehouse();

            $material_id = array_get($data, 'material_id');

            if (!$material = $this->material($warehouse, $material_id)) {
                throw new Exception("总仓库没有这个物料");
            }

            $number = array_get($data, 'number');

            //reduce quantity from warehouse material first
            $reduced = $material->pivot->quantity - $number;
            $this->updateQuantity($warehouse, $material_id, $reduced);
            $this->record($warehouse, $material_id, 'out', $material->pivot->quantity, $reduced);

            if ($material = $this->material($department, $material_id)) {
                $new_quantity = $material->pivot->quantity + $number;
                $this->updateQuantity($department, $material->id, $new_quantity);
                $this->record($department, $material_id, 'in', $material->pivot->quantity, $new_quantity);
            } else {
                $this->newMaterial($department, $material_id, $number);
                $this->record($department, $material_id, 'in', 0, $number);
            }
        });
    }

    public function materials()
    {
        return $this->warehouse()->materials;
    }

    public function reduce($data)
    {

        $department = $this->department->find($data['department_id']);
        $user       = auth()->user();

        if ($user->id != $department->user_id) {

            throw new Exception("请求错误,你不是该车间管理员!");
        }

        $material = $this->material($department, $data['material_id']);

        return DB::transaction(function () use ($data, $department, $material) {

            $used              = array_get($data, 'used');
            $loss              = array_get($data, 'loss');
            $existing_quantity = $material->pivot->quantity;

            if ($used > 0) {
                $existing_quantity = $existing_quantity - $used;
                $this->updateQuantity($department, $data['material_id'], $existing_quantity);
                $this->record($department, $data['material_id'], 'used', $material->pivot->quantity, $existing_quantity);

            }

            if ($loss > 0) {
                $lossed = $existing_quantity - $loss;
                $this->updateQuantity($department, $data['material_id'], $lossed);
                $this->record($department, $data['material_id'], 'loss', $existing_quantity, $lossed);
            }
        });
    }

    public function adjust(array $data)
    {
        $department = $this->department->find($data['department_id']);

        $material = $this->material($department, $data['material_id']);

        return DB::transaction(function () use ($data, $department, $material) {

            $existing_quantity           = $material->pivot->quantity;
            $last_quantity               = $existing_quantity + $data['adjust_number'];
            $department['adjust_reason'] = $data['adjust_reason'];
            $this->updateQuantity($department, $data['material_id'], $last_quantity);
            $this->record($department, $data['material_id'], 'adjust', $existing_quantity, $last_quantity);

        });
    }
    private function newMaterial($warehouse, $material_id, $quantity)
    {
        return $warehouse->materials()->attach($material_id, ['quantity' => $quantity]);
    }

    private function updateQuantity($warehouse, $material_id, $new_quantity)
    {
        $new_quantity = intval($new_quantity);

        if ($new_quantity < 0) {
            throw new Exception("数量不对");
        }

        $warehouse->materials()->updateExistingPivot($material_id, ['quantity' => $new_quantity]);
    }

    private function material($warehouse, $material_id)
    {
        return $warehouse->materials()->where("material_id", $material_id)->first();
    }

    private function warehouse()
    {
        return $this->department->warehouse();
    }

    private function record($department, $material_id, $type, $before, $after)
    {

        $record = [
            'user_id'       => auth()->user()->id,
            'department_id' => $department->id,
            'type'          => $type,
            'material_id'   => $material_id,
            'before'        => $before,
            'after'         => $after,
            'adjust_reason' => $department['adjust_reason'] ?? '',
        ];

        $this->record->create($record);
    }

}
