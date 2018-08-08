<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $department;
    protected $warehouse;

    public function __construct(DepartmentService $department, WarehouseService $warehouse)
    {
        $this->department = $department;
        $this->warehouse  = $warehouse;
    }

    public function index()
    {
        $departments = $this->department->get(['user_id' => auth()->user()->id]);

        return view("department.index", compact("departments"));
    }

    public function materials(Request $request, $id)
    {
        $user_id = auth()->user()->id;

        $department = $this->department->find($id);

        return view("departments.show", compact("department"));
    }

    public function adjustment(Request $request)
    {
        $data = $this->validate($request, [
            'material_id'   => 'required|integer',
            'department_id' => 'required|integer',
            'adjust_number' => 'required|integer',
            'adjust_reason' => 'required|string',
        ]);
        $result = $this->warehouse->adjust($data);

        return response()->json(['data' => $result]);
    }
}
