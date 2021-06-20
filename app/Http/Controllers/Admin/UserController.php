<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = new  User();

            $this->validate($request, [
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|string|min:8',
            ]);

            $user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => $request->role,
            ]);

            return redirect()->route('user')->with("successCreate", true);
        }
        return view('admin.user');
    }
}
