@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Cadastros Auxiliares', 'rota' => 'home'])
@endsection

@section('conteudo')
<div class="row d-flex justify-content-center mt-3 containerTabela">
    <div class="row d-flex justify-content-center mt-3 containerTabela">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item col-md-12 border-0">
                <div class="list-group list-group-flush">
                    <a href="{{ route('departamentos') }}" class="list-group-item list-group-item-action">Departamentos</a>
                    <a href="{{ route('fontes') }}" class="list-group-item list-group-item-action">Fontes</a>
                    <a href="{{ route('tipo_regioes') }}" class="list-group-item list-group-item-action">Tipo das Regiões</a>
                    <a href="{{ route('regioes') }}" class="list-group-item list-group-item-action">Regiões</a>
                    <a href="{{ route('periodicidades') }}" class="list-group-item list-group-item-action">Periodicidades</a>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection