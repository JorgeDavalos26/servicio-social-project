<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->error('Credenciales Inválidas');
        }

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            return response()->success(Auth::user());
        }
        
        return response()->error('Credenciales Inválidas');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->error('Campos inválidos, llenar correctamente');
        }

        if(User::where('email', $request->email)->exists()) {
            return response()->error('Email repetido');
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