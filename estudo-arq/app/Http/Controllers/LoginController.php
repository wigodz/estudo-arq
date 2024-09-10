<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('home.index')
                 ->with('message', 'Login realizado com sucesso')
                 ->cookie('auth_token', $token, 300, '/', null, false, true);

        // return response()->json([
        //     'message' => 'Login realizado com sucesso',
        //     'access_token' => $token,
        //     'token_type' => 'Bearer',
        // ]);

       // return view('home.index');
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function register(UserRequest $request)
    {
        $data = $request->validated();

        User::create($data);

        return response()->json('usuario criado');
    }
}
