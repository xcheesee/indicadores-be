<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficoController extends Controller
{
    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.index', compact('mensagem'));
    }
}