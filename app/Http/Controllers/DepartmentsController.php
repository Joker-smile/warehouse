<?php

namespace App\Http\Controllers;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentForm;
use App\Services\DepartmentService;
use App\Services\UserService;

class DepartmentsController extends Controller
{
    protected $department;

    protected $user;

    public function __construct(DepartmentService $department, UserService $user)
    {
        $this->user = $user;

        $this->department = $department;
    }

    public function index()
    {
        $departments = $this->department->get();

        return view('departments.index')->with(compact('departments'));
    }

    public function show($id)
    {
        try {

            $department = $this->department->find($id);

        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return view('departments.show')->with(compact('department'));
    }

    public function edit($id)
    {

        try {

            $department = $this->department->find($id);

            $operators = $this->user->operators();

        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return view('departments.edit')->with(compact('department', 'operators'));
    }

    public function update(DepartmentForm $request, $id)
    {
        try {
            $result = $this->department->update($id, $request->all());
        } catch (Exception $e) {
            return back()->withErrors($e);
        }

        return redirect()->route('departments.index')->withSuccess("Done!");
    }

    public function create()
    {
        $operators = $this->user->operators();

        return view('departments.create', compact("operators"));
    }

    public function store(DepartmentForm $request)
    {
        try {

            $result = $this->department->store($request->all());

        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('departments.index')->withSuccess("Done!");

    }

}
