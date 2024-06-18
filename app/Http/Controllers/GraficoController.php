<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.index', compact('mensagem'));
    }

    public function show(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.index', compact('mensagem'));
    }

    public function create(Request $request)
    {
        $projetos = Projeto::query()->where('ativo', '=', 1)->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.create', compact('mensagem', 'projetos'));
    }

    public function store(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.index', compact('mensagem'));
    }

    public function edit(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.index', compact('mensagem'));
    }

    public function update(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.index', compact('mensagem'));
    }

    public function destoy(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('publicacao.graficos.index', compact('mensagem'));
    }
}