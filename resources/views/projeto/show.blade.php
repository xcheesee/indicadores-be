@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Projeto ' . $projeto->nome, 'rota' => 'projeto'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
<div class="row containerTabela justify-content-center">
    <div class="mb-2">
        <b>Nome:</b> {{ $projeto->nome }}
    </div>
    <div class="mb-2">
        <b>Departamento Responsável:</b> {{ $departamento->nome }}
    </div>
    <div class="mb-2">
        <b>Descrição:</b> {{ $projeto->descricao }}
    </div>
    <div class="mb-2">
        <b>Imagem:</b> {{ $projeto->imagem }}
    </div>
    <div class="mb-2">
        <b>Publicado:</b> @if ($projeto->ativo == false) Não @else Sim @endif
    </div>
    <div>
        <a class="btn btn-primary" href="{{ route('projeto-edit', $projeto->id) }}">Editar</a>
    </div>
</div>
@endsection