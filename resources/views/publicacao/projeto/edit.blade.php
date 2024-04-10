@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Editar Projeto ' . $projeto->nome, 'rota' => 'projetos'])
@endsection

@section('conteudo')
{{-- @include('layouts.mensagem', ['mensagem' => $mensagem]) --}}

<p class="form-legenda"><em>Campos com (*) são obrigatórios</em></p>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('projeto-update', $projeto->id))->acceptsFiles()->open() }}
    <div class="row">
        <div class="form-group required col-md-8 mb-3">
            <label for="nome" class="control-label form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $projeto->nome }}">
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento_id" class="control-label form-label">Departamento:</label>
            <select class="form-select" name="departamento_id" id="departamento_id" name="departamento_id">
                <option value="" selected>Selecione o departamento</option>
                @foreach ($departamentos  as $dept)
                    @if ($projeto->departamento_id != $dept->id)
                        <option value="{{ $dept->id }}">{{ $dept->sigla }}</option>
                    @else
                        <option value="{{ $dept->id }}" selected>{{ $dept->sigla }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="descricao" rows="3" name="descricao">{{ $projeto->descricao }}</textarea>
        </div>
        <div class="col-md-3 mb-3">
            <label for="imagem" class="form-label">Imagem do projeto:</label>
            <input class="form-control" type="file" name="imagem" id="imagem">
        </div>
        <div class="form-group required col-md-2 mb-3">
            <label for="visivel" class="control-label form-label">Publicado:</label>
            <select class="form-select" name="visivel" id="visivel">
                @if ($projeto->visivel == 0)
                    <option value="0" selected>Não</option>
                    <option value="1">Sim</option>
                @else
                    <option value="0">Não</option>
                    <option value="1" selected>Sim</option>
                @endif
            </select>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
    {{ html()->form()->close() }}
</div>

@endsection