<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WarehouseService;
use App\Services\DepartmentService;
use App\Exceptions\Exception;

class OutController extends Controller
{
    protected $warehouse;

    protected $department;

    public function __construct(WarehouseService $warehouse, DepartmentService $department)
    {
        $this->department = $department;
        $this->warehouse = $warehouse;
    }

    public function index()
    {
        $workshops = $this->department->workshops();

        $materials = $this->warehouse->materials();

        return view("out.index", compact("workshops", 'materials'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'material_id' => 'required|integer',
            'department_id' => 'required|integer',
            'number' => 'required|integer|min:1',
        ]);

        try {
            $this->warehouse->out($data);
        } catch (Exception $e) {
            return back()->withErrors($e);
        }

        return back()->withSuccess("Done!");

    }
}
