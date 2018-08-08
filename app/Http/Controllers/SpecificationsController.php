<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use App\Services\MaterialService;
use App\Services\SpecificationService;
use Illuminate\Http\Request;

class SpecificationsController extends Controller
{

    private $material;
    private $specification;
    private $department;

    public function __construct(
        MaterialService $material,
        SpecificationService $specification,
        DepartmentService $department) {

        $this->material      = $material;
        $this->specification = $specification;
        $this->department    = $department;

    }

    public function show(Request $request, $material_id)
    {
        $material = $this->material->find($material_id);

        if ($request->wantsJson()) {
            return $material;
        }

        return view('materials.specifications.show')->with(compact('material'));
    }

    public function update(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'id'   => 'integer',
        ]);

        $specification_data = $request->only('remark', 'supplier', 'code');

        $array              = array_collapse([$data, $specification_data]);

        $result             = $this->specification->update($data['id'], $array);

        return response()->json(['status' => 'success']);

    }

    public function destroy($id)
    {
        $result = $this->specification->delete($id);

        return back()->with('status', $result);
    }


}
