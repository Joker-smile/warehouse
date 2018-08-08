<?php

namespace App\Http\Controllers;

use App\Services\WarehouseService;
use Illuminate\Http\Request;
use App\Exceptions\Exception;

class ReduceController extends Controller
{
    protected $warehouse;

    public function __construct(WarehouseService $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    public function reduce(Request $request, $id)
    {
        $data = $this->validate($request, [
            'used'          => 'sometimes|integer|min:0',
            'loss'          => 'required|integer|min:0',
            'department_id' => 'required|integer',
        ]);

        $data['material_id'] = $id;

        try {
            $this->warehouse->reduce($data);
        } catch (Exception $e) {
            return back()->withErrors($e);
        }

        return back()->withSuccess("Done!");
    }

}
