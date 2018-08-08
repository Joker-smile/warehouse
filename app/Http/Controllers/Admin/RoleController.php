<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $role;
    private $permission;

    public function __construct(RoleRepositoryInterface $role)
    {

        $this->role = $role;

    }

    public function index()
    {
        $roles = $this->role->all();

        return view('admin.roles.index')->with('roles', $roles);
    }

    public function create()
    {

        return view('admin.roles.create');
    }

    public function store(Request $request)
    {

        $role_name = $request->validate([

            'name' => 'required|string|max:255|unique:roles',
        ]);

        $result = $this->role->create($role_name);

        return redirect()->route('roles.index')->with('status', $result);

    }

    public function edit($id)
    {
        $role = $this->role->find($id);

        return view('admin.roles.edit')->with(compact('role'));

    }

    public function update(Request $request, $id)
    {
        $role_name = $request->validate([

            'name' => 'required|string|max:255|unique:roles',
        ]);

        $result = $this->role->update($id, $role_name);

        return redirect()->route('roles.index')->with('status', $result);

    }

    public function destroy($id)
    {

        $result = $this->role->delete($id);

        return back()->with('status', $result);
    }
}
