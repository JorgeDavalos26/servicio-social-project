<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            return response()->success(Auth::user());
        }
        
        return response()->error('Invalid credentials');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(User::where('email', $request->email)->exists()) {
            return response()->error('Email repeated');
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        Auth::login($user);

        return response()->success(Auth::user());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->success(null);
    }

}