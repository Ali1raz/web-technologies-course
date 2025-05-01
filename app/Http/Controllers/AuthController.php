<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        $fields = $req->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);
        $token = $user->createToken($req->name);
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $req->email)->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return [
                'message' => 'The provided credentials are incorrect.'
            ];
        }

        $token = $user->createToken($user->name);
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function logout(Request $req)
    {
        $req->user()->tokens()->delete();
        return [
            'message' => 'You are logged out'
        ];
    }
}
