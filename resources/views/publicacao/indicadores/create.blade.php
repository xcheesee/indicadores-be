@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Novo Indicador', 'rota' => 'publicacao'])
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
            <label for="departamento_id" class="form-label control-label">Departamento:</label>
            <select class="form-select" name="departamento_id" id="departamento_id">
                <option value="" selected>Selecione o departamento</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="projeto_id" class="form-label control-label">Projeto:</label>
            <select class="form-select" name="projeto_id" id="projeto_id">
                <option value="" selected>Selecione o projeto</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="fonte_id" class="form-label control-label">Fonte:</label>
            <select class="form-select" name="fonte_id" id="fonte_id">
                <option value="" selected>Selecione a fonte</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="periodicidade_id" class="form-label control-label">Periodicidade:</label>
            <select class="form-select" name="periodicidade_id" id="periodicidade_id">
                <option value="" selected>Selecione o periodicidade</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
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
        <div class="col-md-3 mb-3">
            <label for="imagem" class="form-label">Imagem do Indicador:</label>
            <input class="form-control" type="file" id="imagem" name="imagem" accept=".png,.jpg,.jpeg,.gif">
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Criar</button>
    </div>
    {{ html()->form()->close() }}
</div>

@endsection