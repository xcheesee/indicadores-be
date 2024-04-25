@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Novo Indicador', 'rota' => 'indicadores'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<p class="form-legenda"><em>Campos com (*) são obrigatórios</em></p>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('indicador-store'), 'files')->acceptsFiles()->open() }}
    <div class="row">
        <div class="form-group required col-md-8 mb-3">
            <label for="nome" class="form-label control-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento" class="form-label control-label">Coordenação Responsável:</label>
            <select class="form-select" name="departamento" id="departamento">
                <option value="" selected>Selecione a Coordenação Responsável</option>
                @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="projeto" class="form-label control-label">Projeto:</label>
            <select class="form-select" name="projeto" id="projeto">
                <option value="" selected>Selecione o Projeto</option>
                @foreach ($projetos as $projeto)
                    <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="fonte" class="form-label control-label">Fonte:</label>
            <select class="form-select" name="fonte" id="fonte">
                <option value="" selected>Selecione a Fonte</option>
                @foreach ($fontes as $fonte)
                    <option value="{{ $fonte->id }}">{{ $fonte->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="periodicidade" class="form-label control-label">Periodicidade:</label>
            <select class="form-select" name="periodicidade" id="periodicidade">
                <option value="" selected>Selecione o Periodicidade</option>
                @foreach ($periodicidades as $periodicidade)
                    <option value="{{ $periodicidade->id }}">{{ $periodicidade->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="nota_tecnica" class="form-label">Nota Técnica:</label>
            <textarea class="form-control" id="nota_tecnica" rows="3" name="nota_tecnica"></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label for="observacao" class="form-label">Observacao:</label>
            <textarea class="form-control" id="observacao" rows="3" name="observacao"></textarea>
        </div>
        <div class="form-group col-md-3 required mb-3">
            <label for="imagem" class="form-label control-label">Imagem do Indicador:</label>
            <input class="form-control" type="file" id="imagem" name="imagem" accept=".png,.jpg,.jpeg,.gif">
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Criar</button>
        <a href="{{ route('indicadores') }}" class="btn btn-outline-info">Cancelar</a>
    </div>
    {{ html()->form()->close() }}
</div>

@endsection