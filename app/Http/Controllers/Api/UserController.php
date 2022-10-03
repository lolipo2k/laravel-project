<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function checkEmail(Request $request)
    {
        if ($request->has('email'))
        {
            $user = User::where('email', $request->input('email'))->first();

            if ($user)
            {
                return response()->json([
                    'data' => [
                        'status' => true,
                    ]
                ]);
            }
        }

        return response()->json([
            'data' => [
                'status' => false,
            ]
        ]);
    }
}
