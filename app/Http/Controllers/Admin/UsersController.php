<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::orderBy('id', 'desc')->paginate(30),
        ]);
    }

    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function update(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users,email,'.$user->id.',id'],
            'name' => ['required', 'string', 'min:3'],
            'phone' => ['required'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update($request->all());

        return back();
    }

    public function destroy(User $user)
    {
        dd('Delete user', $user);
    }
}
