@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Indicadores', 'rota' => 'publicacao'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
<div class="row containerTabela justify-content-center">
    <div class="row">
        {{ html()->form('GET', route('projetos'))->open() }}
            <div class="row">
                <div class="form-group col-md-3 mb-3">
                    <label for="nome" class="form-label control-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="projeto_id" class="form-label control-label">Projeto:</label>
                    <select class="form-select" name="projeto_id" id="projeto_id">
                        <option value="" selected>Selecione o projeto</option>
                        {{-- @foreach ($departamentos as $dept)
                            @if ($filtros['departamento_id'] != $dept->id)
                                <option value="{{ $dept->id }}">{{ $dept->sigla }} - {{ $dept->nome }}</option> 
                            @else
                                <option value="{{ $dept->id }}" selected>{{ $dept->sigla }} - {{ $dept->nome }}</option>
                            @endif    
                        @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="departamento_id" class="form-label control-label">Unidade Responsável:</label>
                    <select class="form-select" name="departamento_id" id="departamento_id" name="departamento_id">
                        <option value="" selected>Selecione o departamento</option>
                        {{-- @foreach ($departamentos as $dept)
                            @if ($filtros['departamento_id'] != $dept->id)
                                <option value="{{ $dept->id }}">{{ $dept->sigla }} - {{ $dept->nome }}</option> 
                            @else
                                <option value="{{ $dept->id }}" selected>{{ $dept->sigla }} - {{ $dept->nome }}</option>
                            @endif    
                        @endforeach --}}
                    </select>
                </div>
                {{-- <div class="form-group col-md-1 mb-3">
                    <label for="ativo" class="form-label control-label">Publicado:</label>
                    <select class="form-select" name="ativo" id="ativo">
                        @if (!$filtros['ativo'])
                            <option value="0" selected>Não</option>
                            <option value="1">Sim</option>
                        @else
                            <option value="0">Não</option>
                            <option value="1" selected>Sim</option>
                        @endif
                    </select>
                </div> --}}
                <div class="form-group col-md-3 mb-3">
                    <label for="fonte_id" class="form-label control-label">Fonte:</label>
                    <select class="form-select" name="fonte_id" id="fonte_id">
                        <option value="" selected>Selecione a Fonte</option>
                        {{-- @if (!$filtros['ativo'])
                            <option value="0" selected>Não</option>
                            <option value="1">Sim</option>
                        @else
                            <option value="0">Não</option>
                            <option value="1" selected>Sim</option>
                        @endif --}}
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('indicador-create') }}">Novo Projeto</a>
                </div>
            </div>
        {{ html()->form()->close() }}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Projeto</th>
                    <th>Responsável</th>
                    <th>Fonte</th>
                    <th>Ação</th>
                </tr>
            </thead>
            {{-- <tbody class="align-middle">
                @foreach ($data as $key => $projeto)
                <tr>
                    <td></td>
                </tr>
                @endforeach
            </tbody> --}}
        </table>
    </div>
</div>
@endsection