<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;
    private $role;

    public function __construct(UserRepositoryInterface $user, RoleRepositoryInterface $role)
    {
        $this->user = $user;
        $this->role = $role;

    }

    public function index(Request $request)
    {
        $users = $this->user->paginate(15);
        return view('admin.users.index')->with(compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.users.create')->with(compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user             = $request->only(['password', 'name', 'email']);
        $user['password'] = bcrypt($user['password']);
        $result           = $this->user->create($user);
        $roles            = $request['roles'] ? $request['roles'] : [];
        $result->syncRoles($roles);
        return redirect()->route('users.index')->with('status', $result);

    }

    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles  = $this->role->all();
        return view('admin.users.edit')->with(compact('user','roles'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user             = $request->only(['password', 'name', 'email']);
        $user['password'] = bcrypt($user['password']);
        $result           = $this->user->update($id, $user);
        $roles            = $request['roles'] ? $request['roles'] : [];
        $result->syncRoles($roles);
        return redirect()->route('users.index')->with('status', $result);
    }

    public function destroy($id)
    {
        $result = $this->user->delete($id);
        return back()->with('status', $result);
    }

}
