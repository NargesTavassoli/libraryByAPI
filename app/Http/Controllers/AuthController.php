<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        auth()->attempt([
            'email' => $request->email,
            'password'=> $request->password
        ]);

        if (auth()->check()){
            return response([
               'token' => auth()->user()->generateToken()
            ]);
        }

        return response([
            'error'=> 'اطلاعات کاربری درست وارد نشده است'
        ], 401);
    }

    public function logout()
    {

        $user = auth('api')->user();
        $user->logout();
    }

    public function current()
    {
        return auth('api')->user();
    }
}
