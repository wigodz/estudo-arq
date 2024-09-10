<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store($data)
    {
        $data->toArray;
        User::create($data);

        return response()->json('Usuario criado');
    }
}
