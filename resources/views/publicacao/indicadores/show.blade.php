@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Indicador: '.$indicador->nome, 'rota' => 'indicadores'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
<div class="row containerTabela justify-content-center">
    <section>
        <div class="mb-2">
            <b>Coordenção Responsável:</b> {{ $departamento->nome }}
        </div>
        <div class="mb-2">
            <b>Projeto:</b> {{ $projeto->nome }}
        </div>
        <div class="mb-2">
            <b>Fonte:</b> {{ $fonte->nome }}
        </div>
        <div class="mb-2">
            <b>Periodicidade:</b> {{ $periodicidade->nome }}
        </div>
        <div class="mb-2">
            <b>Nota Técnica:</b> {{ $indicador->nota_tecnica }}
        </div>
        <div class="mb-2">
            <b>Observação:</b> {{ $indicador->observacao }}
        </div>
        <div class="mb-4">
            <b>Imagem:</b> <br>
            <img src="{{ $indicador->imagem_url }}" class="img-thumbnail rounded object-fit-cover" alt="" style="max-height: 200px; max-width:200px;">
        </div>
        <div class="mb-2">
            {{-- <b>Publicado:</b> @if ($projeto->visivel == false) Não @else Sim @endif --}}
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('indicador-edit', $indicador->id) }}">Editar</a>
        </div>
    </section>
</div>
@endsection