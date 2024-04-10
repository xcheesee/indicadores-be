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
            <select class="form-select" name="departamento_id" id="departamento_id" name="departamento_id">
                <option value="" selected>Selecione o departamento</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento_id" class="form-label control-label">Projeto:</label>
            <select class="form-select" name="departamento_id" id="departamento_id" name="departamento_id">
                <option value="" selected>Selecione o departamento</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento_id" class="form-label control-label">Fonte:</label>
            <select class="form-select" name="departamento_id" id="departamento_id" name="departamento_id">
                <option value="" selected>Selecione o departamento</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento_id" class="form-label control-label">Periodicidade:</label>
            <select class="form-select" name="departamento_id" id="departamento_id" name="departamento_id">
                <option value="" selected>Selecione o departamento</option>
                {{-- @foreach ($departamentos as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>  
                @endforeach --}}
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="descricao" class="form-label">Nota Técnica:</label>
            <textarea class="form-control" id="descricao" rows="3" name="descricao"></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label for="descricao" class="form-label">Observacao:</label>
            <textarea class="form-control" id="descricao" rows="3" name="descricao"></textarea>
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