<?php

namespace App\Http\Controllers;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $users = $this->user->operators();

        return view('users.index')->with(compact('users'));
    }

    public function create(Request $request)
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name'     => 'string|required|unique:users',
            'password' => 'string|required|min:6',
        ]);
        try {
            $this->user->create($data);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('users.index')->withSuccess('Done!');
    }

    public function edit($id)
    {
        try {
            $user = $this->user->find($id);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return view('users.edit')->with(compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'password' => 'string|required|min:6',
        ]);

        try {

            $this->user->updatePassword($id, $data['password']);
        } catch (Exception $e) {

            return back()->withErrors($e);
        }

        return redirect()->route('users.index')->withSuccess('Done!');
    }

    public function destroy($id)
    {
        $result = $this->user->delete($id);

        return back()->withSuccess("Done!");
    }

}
