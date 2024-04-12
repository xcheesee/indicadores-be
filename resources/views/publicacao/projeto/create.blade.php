@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Criar Projeto', 'rota' => 'projetos'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<p class="form-legenda"><em>Campos com (*) são obrigatórios</em></p>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('projeto-store'), 'files')->acceptsFiles()->open() }}
    <div class="row">
        <div class="form-group required col-md-8 mb-3">
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
        <div class="col-md-12 mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="descricao" rows="3" name="descricao"></textarea>
        </div>
        <div class="col-md-3 mb-3">
            <label for="imagem" class="form-label">Imagem do projeto:</label>
            <input class="form-control" type="file" id="imagem" name="imagem" accept=".png,.jpg,.jpeg,.gif">
        </div>
        <div class="form-group required col-md-2 mb-3">
            <label for="visivel" class="form-label control-label">Publicado:</label>
            <select class="form-select" name="visivel" id="visivel">
                <option value="0" selected>Não</option>
                <option value="1">Sim</option>
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