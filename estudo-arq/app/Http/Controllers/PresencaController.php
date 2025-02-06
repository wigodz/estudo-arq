<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PresencaController extends Controller
{
    public function index() 
    {
        $userLogado = auth()->user();
        $users = User::paginate(15);
        return view('presenca.index', compact('users', 'userLogado'));
    }

    public function save($request)
    {
        $user = auth()->user;

        $user->presenca = $request->confirmacao = true? true : false;

        return response()->json('presenca confirmada');
    }

    public function updateConvidado(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'convidado' => 'required|boolean'
        ]);

        $user = User::find($request->user_id);

        $user->convidado = $request->convidado;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso']);
    }

    public function updatePresenca(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'presenca' => 'required|boolean'
        ]);
        $user->presenca = $request->presenca;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso']);
    }
}
