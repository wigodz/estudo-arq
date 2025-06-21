<?php

namespace App\Http\Controllers;

class DuvidasController extends Controller
{
    public function index()
    {
        return view('duvidas.duvidas');
    }
}