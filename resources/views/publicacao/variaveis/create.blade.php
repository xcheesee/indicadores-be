@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Criar Variável', 'rota' => 'variaveis'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<p class="form-legenda"><em>Campos com (*) são obrigatórios</em></p>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('variavel-store'))->open() }}
    <div class="row">
        <div class="form-group required col-md-2 mb-3">
            <label for="codigo" class="form-label control-label">Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label for="nome" class="form-label control-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento" class="form-label control-label">Departamento:</label>
            <select class="form-select" name="departamento" id="departamento">
                <option value="" selected>Selecione o departamento</option>
                @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="tipo_dado" class="form-label control-label">Tipo da Dado:</label>
            <select class="form-select" name="tipo_dado" id="tipo_dado">
                <option value="" selected>Selecione o tipo do dado</option>
                @foreach ($tipo_dados as $dado)
                    <option value="{{ $dado->id }}">{{ $dado->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="fonte" class="form-label control-label">Fonte do Dado:</label>
            <select class="form-select" name="fonte" id="fonte">
                <option value="" selected>Selecione a fonte</option>
                @foreach ($fontes as $fonte)
                    <option value="{{ $fonte->id }}">{{ $fonte->nome }}</option>  
                @endforeach
            </select>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Criar</button>
        <a href="{{ route('projetos') }}" class="btn btn-outline-info">Cancelar</a>
    </div>
    {{ html()->form()->close() }}
</div>

@endsection