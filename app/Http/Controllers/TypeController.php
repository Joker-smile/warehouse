<?php

namespace App\Http\Controllers;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Services\TypeService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    private $type;

    public function __construct(TypeService $type)
    {
        $this->type = $type;
    }

    public function index(Request $request)
    {
        $types = $this->type->get();

        return view('types.index')->with(compact('types'));
    }

    public function create(Request $request)
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name'     => 'string|required|unique:types',
        ]);
        try {
            $this->type->create($data);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('types.index')->withSuccess('Done!');
    }

    public function edit($id)
    {
        try {
            $type = $this->type->find($id);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return view('types.edit')->with(compact('type'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'string|required|unique:types',
        ]);

        try {

            $this->type->update($id, $data['name']);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('types.index')->withSuccess('Done!');
    }

}
