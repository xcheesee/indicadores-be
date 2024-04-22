@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Indicador: '.$indicador->nome, 'rota' => 'indicadores'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
<div class="row containerTabela justify-content-center">
    <section class="mb-4">
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
        <div class="mb-3">
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
    <section>
        <h2>Lista de Variáveis</h2>
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
                @foreach ($variaveis as $ind_variavel)
                <tr>
                    <td>{{ $ind_variavel->variavel->id }}</td>
                    <td>{{ $ind_variavel->variavel->nome }}</td>
                    <td>{{ $ind_variavel->variavel->departamento->nome }}</td>
                    <td>{{ $ind_variavel->variavel->fonte->nome }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('variavel-show', $ind_variavel->variavel->id) }}"><i class="far fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $variaveis->appends($_GET)->links() }}
    </section>
</div>
@endsection