<?php

namespace App\Http\Controllers;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Material;
use App\Services\MaterialService;
use App\Services\TypeService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    private $material;
    private $unit;
    private $type;

    public function __construct(MaterialService $material,
        TypeService $type, UnitService $unit) {

        $this->material = $material;
        $this->unit     = $unit;
        $this->type     = $type;
    }

    public function index(Request $request)
    {
        $args=$request->all();

        $materials = $this->material->get($args);

        return view('materials.index')->with(compact('materials'));
    }

    public function create()
    {
        $materials = $this->material->get();
        $types     = $this->type->get();
        $units     = $this->unit->get();

        return view('materials.create')->with(compact('materials', 'types', 'units'));
    }

    public function store(Request $request)
    {
        $data = $request->get("data");

        //only save material with name filled.
        $data = array_filter($data, function ($v) {
            return filled(array_get($v, 'name'));
        });

        try {

            foreach ($data as $material) {
                $this->material->create($material);
            }

        } catch (Exception $e) {
            return back()->withErrors($e);
        }

        return redirect()->route('materials.index')->withSuccess("Done!");
    }

    public function edit($id)
    {
        $types     = $this->type->get();
        $units     = $this->unit->get();

        try {
            $material = $this->material->find($id);

        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return view('materials.edit')->with(compact('material', 'types', 'units'));

    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name'     => 'required|string|max:255',
            'remark'   => 'string|nullable',
            'supplier' => 'string|nullable',
            'type'     => 'string|nullable',
            'unit'     => 'string|nullable',
            'price'    => 'numeric|nullable',
        ]);

        try {
            $result = $this->material->update($id, $data);

        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('materials.index')->withSuccess("Done!");
    }

    public function destroy($id)
    {
        $result = $this->material->delete($id);

        return back()->withSuccess("done");
    }

}
