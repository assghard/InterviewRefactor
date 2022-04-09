<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;

final class UserController extends Controller
{
    public function create()
    {
        return view('user.crreate');
    }

    public function save(UserRequest $request)
    {
        app()->make(UserService::class)->save($request);

        return redirect('/');
    }

    public function edit($id)
    {
        $user = app()->make(UserService::class)->GetById($id);
        return view('user.edit', compact('user'));
    }

    public function update(int $id)
    {
        app()->make(UserService::class)->update($id, request()->all());

        return redirect('/');
    }

    public function delete(int $id): RedirectResponse
    {
        \DB::table('users')->where('id', $id)->delete();

        return redirect('/');
    }
}
