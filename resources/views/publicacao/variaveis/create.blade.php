@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Criar Variável', 'rota' => 'variaveis'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<div class="d-flex justify-content-between mb-2 align-items-center">
    <p class="form-legenda" style="margin: 0"><em>Campos com (*) são obrigatórios</em></p>
    <button class="btn btn-primary buttonSlide" type="button">Metadados</button>
</div>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('variavel-store'))->open() }}
    @csrf
    <section class="row mb-3">
        <div class="form-group required col-md-2 mb-3">
            <label for="codigo" class="form-label control-label">Código:</label>
            <input type="text" class="form-control codigo" id="codigo" name="codigo">
        </div>
        <div class="form-group col-md-6 mb-3">
            <label for="nome" class="form-label control-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="indicador" class="form-label control-label">Indicador:</label>
            <select class="form-select" name="indicador" id="indicador">
                <option value="" selected>Selecione o Indicador</option>
                @foreach ($indicadores as $indicador)
                    <option value="{{ $indicador->id }}">{{ $indicador->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento" class="form-label control-label">Departamento:</label>
            <select class="form-select" name="departamento" id="departamento">
                <option value="" selected>Selecione o Departamento</option>
                @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }} - {{ $dept->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="tipo_dado" class="form-label control-label">Tipo da Dado:</label>
            <select class="form-select" name="tipo_dado" id="tipo_dado">
                <option value="" selected>Selecione o Tipo do Dado</option>
                @foreach ($tipo_dados as $dado)
                    <option value="{{ $dado->id }}">{{ $dado->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="fonte" class="form-label control-label">Fonte do Dado:</label>
            <select class="form-select" name="fonte" id="fonte">
                <option value="" selected>Selecione a Fonte</option>
                @foreach ($fontes as $fonte)
                    <option value="{{ $fonte->id }}">{{ $fonte->nome }}</option>  
                @endforeach
            </select>
        </div>
    </section>
    <section class="row" id="newform">
        <h2 class="fs-4">Metadados</h2>
        <div class="form-group col-md-4 mb-3">
            <label for="tipo_medida" class="form-label control-label">Unidade de Medida:</label>
            <select class="form-select" name="tipo_medida" id="tipo_medida">
                <option value="" selected>Selecione a Unidade de Medida</option>
                @foreach ($fontes as $fonte)
                    <option value="{{ $fonte->id }}">{{ $fonte->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="inicio_serie_historica" class="form-label control-label">Início da Série Histórica:</label>
            <input type="text" class="form-control" id="inicio_serie_historica" name="inicio_serie_historica">
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="tipo_medida" class="form-label control-label">Fim da Série Histórica:</label>
            <input type="text" class="form-control" id="inicio_serie_historica" name="inicio_serie_historica">
        </div>
        <div class="form-group col-md-12 mb-3">
            <label for="nota_tecnica" class="form-label control-label">Nota Técnica:</label>
            <textarea class="form-control" name="nota_tecnica" id="nota_tecnica" cols="30" rows="5"></textarea>
        </div>
        <div class="form-group col-md-12 mb-3">
            <label for="observacao" class="form-label control-label">Observação:</label>
            <textarea class="form-control" name="observacao" id="observacao" cols="30" rows="5"></textarea>
        </div>
        <div class="form-group col-md-4 mb-3">
            <label for="organizacao" class="form-label control-label">Organização:</label>
            <input type="text" class="form-control" id="organizacao" name="organizacao">
        </div>
    </section>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Criar</button>
        <a href="{{ route('variaveis') }}" class="btn btn-outline-info">Cancelar</a>
    </div>
    {{ html()->form()->close() }}
</div>
<script>
    $( "#newform" ).hide();
    $( ".buttonSlide" ).on( "click", function () {
        $( "#newform" ).slideToggle( "slow" ); 
    });
</script>

@include('utilitarios.scripts')
@endsection