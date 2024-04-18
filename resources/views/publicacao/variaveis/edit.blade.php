@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Editar Variável: '.$variavel->nome, 'rota' => 'variaveis'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<p class="form-legenda"><em>Campos com (*) são obrigatórios</em></p>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('variavel-update', $variavel->id))->open() }}
    @csrf
    <section class="row mb-3">
        <div class="form-group required col-md-2 mb-3">
            <label for="codigo" class="form-label control-label">Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $variavel->codigo }}">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label for="nome" class="form-label control-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $variavel->nome }}">
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento" class="form-label control-label">Departamento:</label>
            <select class="form-select" name="departamento" id="departamento">
                <option value="">Selecione o Departamento</option>
                @foreach ($departamentos as $dept)
                    @if ($dept->id != $variavel->departamento_id)
                        <option value="{{ $dept->id }}">{{ $dept->sigla }}</option> 
                    @else
                        <option value="{{ $dept->id }}" selected>{{ $dept->sigla }}</option>  
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="tipo_dado" class="form-label control-label">Tipo da Dado:</label>
            <select class="form-select" name="tipo_dado" id="tipo_dado">
                <option value="">Selecione o Tipo do Dado</option>
                @foreach ($tipo_dados as $dado)
                    @if ($dado->id != $variavel->tipo_dado_id)
                        <option value="{{ $dado->id }}">{{ $dado->nome }}</option>
                    @else
                        <option value="{{ $dado->id }}" selected>{{ $dado->nome }}</option>  
                    @endif   
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="fonte" class="form-label control-label">Fonte do Dado:</label>
            <select class="form-select" name="fonte" id="fonte">
                <option value="">Selecione a Fonte</option>
                @foreach ($fontes as $fonte)
                    @if ($fonte->id != $variavel->fonte_id)
                        <option value="{{ $fonte->id }}">{{ $fonte->nome }}</option>
                    @else
                        <option value="{{ $fonte->id }}" selected>{{ $fonte->nome }}</option>
                    @endif       
                @endforeach
            </select>
        </div>
    </section>
    <section class="row">
        <h2 class="fs-4">Metadados</h2>
        <div class="form-group col-md-4 mb-3">
            <label for="tipo_medida" class="form-label control-label">Unidade de Medida:</label>
            <select class="form-select" name="tipo_medida" id="tipo_medida">
                <option value="" selected>Selecione a Unidade de Medida</option>
                @foreach ($tipo_medidas as $medida)
                    @if ($medida->id != $metadados->tipo_medida_id)
                        <option value="{{ $medida->id }}">{{ $medida->nome }}</option> 
                    @else
                        <option value="{{ $medida->id }}" selected>{{ $medida->nome }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="inicio_serie_historica" class="form-label control-label">Início da Série Histórica:</label>
            <input type="text" class="form-control" id="inicio_serie_historica" name="inicio_serie_historica" value="{{ $metadados->serie_historica_inicio }}">
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="tipo_medida" class="form-label control-label">Fim da Série Histórica:</label>
            <input type="text" class="form-control" id="inicio_serie_historica" name="inicio_serie_historica" value="{{ $metadados->serie_historica_fim }}">
        </div>
        <div class="form-group col-md-12 mb-3">
            <label for="nota_tecnica" class="form-label control-label">Nota Técnica:</label>
            <textarea class="form-control" name="nota_tecnica" id="nota_tecnica" cols="30" rows="5">{{ $metadados->nota_tecnica }}</textarea>
        </div>
        <div class="form-group col-md-12 mb-3">
            <label for="observacao" class="form-label control-label">Observação:</label>
            <textarea class="form-control" name="observacao" id="observacao" cols="30" rows="5">{{ $metadados->observacao }}</textarea>
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="organizacao" class="form-label control-label">Organização:</label>
            <input type="text" class="form-control" id="organizacao" name="organizacao" value="{{ $metadados->organização }}">
        </div>
    </section>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Editar</button>
        <a href="{{ route('variaveis') }}" class="btn btn-outline-info">Cancelar</a>
    </div>
    {{ html()->form()->close() }}
</div>
@endsection