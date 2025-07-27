<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MensagensController extends Controller
{
    public function enviaMensagens(Request $request)
    {
        $url = 'http://67.205.128.65:3000/send-mass';
        $mensagem = $request->get('mensagem');
        $convidados = User::all();
        $guests = [];

        foreach ($convidados as $convidado) {
            $guests[] = [
                    'nome' => $convidado->name,
                    'email' => $convidado->email,
                    'senha' => 'casamento',
                    'numero' => (int) $convidado->telefone,
            ];
        }

        $data = [
            'message' => $mensagem,
            'guests' => $guests,
        ];

        Http::post($url, $data);

        return route('wpp.index');
    }
}