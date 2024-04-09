@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Publicação', 'rota' => 'home'])
@endsection

@section('conteudo')
<div class="row d-flex justify-content-center mt-3 containerTabela">
    <div class="row d-flex justify-content-center mt-3 containerTabela">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item col-md-12 border-0">
                <div class="list-group list-group-flush">
                    <a href="{{ route('projetos') }}" class="list-group-item list-group-item-action">Projetos</a>
                    <a href="#" class="list-group-item list-group-item-action">Indicadores</a>
                    <a href="#" class="list-group-item list-group-item-action">Variáveis</a>
                    <a href="#" class="list-group-item list-group-item-action">Gráficos</a>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection