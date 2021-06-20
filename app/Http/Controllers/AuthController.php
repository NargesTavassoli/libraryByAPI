<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\createUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


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

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:8',
        ]);
        $user = new  User();
        $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response('اطلاعات با موفقیت ثبت شد', 201);
    }
}
