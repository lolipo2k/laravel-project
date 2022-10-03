<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user(),
            'title' => 'Profil',
        ]);
    }

    public function edit(Request $request)
    {
        if ($request->method() == "POST")
        {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id.',id'],
                'name' => ['required', 'string', 'min:3'],
                'phone' => ['required'],
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->input('password') && $request->input('repeatpassword'))
            {
                if(Hash::check($request->input('password'), Hash::make($request->input('repeatpassword'))))
                {
                    $hashPass = Hash::make($request->input('password'));
                } else {
                    return redirect()->back()->withErrors([
                        'password' => 'Пароли не совпадают',
                    ])->withInput();
                }
            }

            $user = Auth::user();
            $user->update([
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'password' => $hashPass ?? $user->password,
            ]);

            return redirect()->route('profile.index');
        }

        return view('profile.edit', [
            'user' => Auth::user(),
            'title' => 'Edytuj konto',
        ]);
    }
}
