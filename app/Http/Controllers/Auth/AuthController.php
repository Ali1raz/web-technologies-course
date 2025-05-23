<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = DB::select(
            '
            SELECT * FROM users
             WHERE email = ?',
            [$credentials['email']]
        );

        if (!empty($user) && Hash::check($credentials['password'], $user[0]->password)) {
            Session::put('user_id', $user[0]->id);
            Session::put('user_role', $user[0]->role);
            Session::put('user_name', $user[0]->name);

            return redirect()->route('products.index');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ])->onlyInput('email');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
