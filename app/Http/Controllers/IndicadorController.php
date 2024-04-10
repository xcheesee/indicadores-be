<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndicadorController extends Controller
{
    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.index', compact('mensagem'));
    }

    public function create(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.create', compact('mensagem'));
    }

    public function store(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.index', compact('mensagem'));
    }

    public function edit(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.index', compact('mensagem'));
    }

    public function update(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        
        return view('publicacao.indicadores.index', compact('mensagem'));
    }
}
