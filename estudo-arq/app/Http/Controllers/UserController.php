<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'string|max:60',
            'email'    => 'string|max:100',
            'telefone' => 'string|max:60',
            'password' => 'string|max:60',
        ]);

        $telefone = preg_replace('/\D/', '', $data['telefone']);
        $data['telefone'] = $telefone;

        User::create($data);

        return response()->json(['message' => 'Usuario criado', 'success' => true]);
    }

    public function adminView()
    {
        $user = auth()->user();

        if (! $user->is_admin) {
            return view('home.index')->with('você não possui acesso há esta página.');
        }

        return view('admin.index');
    }
}
