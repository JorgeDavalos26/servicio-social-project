<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) return response()->success(Auth::user());
        else return response()->error(__("Invalid credentials"));
    }

    public function register(AuthRegisterRequest $request)
    {
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
        return response()->success(__('Successful logout'));
    }

}