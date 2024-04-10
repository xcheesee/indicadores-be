@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Projeto ' . $projeto->nome, 'rota' => 'projetos'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
<div class="row containerTabela justify-content-center">
    <section class="mb-4">
        {{-- <div class="mb-2">
            <b>Nome:</b> {{ $projeto->nome }}
        </div> --}}
        <div class="mb-2">
            <b>Departamento Responsável:</b> {{ $departamento->nome }}
        </div>
        <div class="mb-2">
            <b>Descrição:</b> {{ $projeto->descricao }}
        </div>
        <div class="mb-2">
            <b>Imagem:</b> <br>
            <img src="{{ $projeto->imagem_url }}" class="img-thumbnail rounded object-fit-cover" alt="" style="max-height: 200px; max-width:200px;">
        </div>
        <div class="mb-2">
            <b>Publicado:</b> @if ($projeto->visivel == false) Não @else Sim @endif
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('projeto-edit', $projeto->id) }}">Editar</a>
        </div>
    </section>
    <section>
        <h2>Lista de Indicadores</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Indicador</th>
                    <th>Coordenação</th>
                    <th>Fonte</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                {{-- @foreach ()
                <tr>
                    <td></td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </section>
</div>
@endsection