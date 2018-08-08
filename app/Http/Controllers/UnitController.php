<?php

namespace App\Http\Controllers;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    private $unit;

    public function __construct(UnitService $unit)
    {
        $this->unit = $unit;
    }

    public function index(Request $request)
    {
        $units = $this->unit->get();

        return view('units.index')->with(compact('units'));
    }

    public function create(Request $request)
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name'     => 'string|required|unique:units',
        ]);
        try {
            $this->unit->create($data);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('units.index')->withSuccess('Done!');
    }

    public function edit($id)
    {
        try {
            $unit = $this->unit->find($id);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return view('units.edit')->with(compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'string|required|unique:units',
        ]);

        try {

            $this->unit->update($id, $data['name']);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('units.index')->withSuccess('Done!');
    }

}
