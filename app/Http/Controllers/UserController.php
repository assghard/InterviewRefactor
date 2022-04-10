<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request, UserService $userService)
    {
        $user = $userService->createNewUser($request->name, $request->email, $request->password);

        return redirect()->route('users.index')->withSuccess('User '.$user->email.' has been created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());

        if(isset($request->button) && $request->button == 'index'){
            return redirect()->route('users.index')->withSuccess('User '.$user->email.' has been updated');
        }

        return redirect()->back()->withSuccess('User '.$user->email.' has been updated');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete($id);

        return response()->json(['success' => true, 'message' => 'User has been deleted']);
    }
}
