@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Edição do Indicador: '. $indicador->nome, 'rota' => 'indicadores'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<p class="form-legenda"><em>Campos com (*) são obrigatórios</em></p>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('indicador-update', $indicador->id), 'files')->acceptsFiles()->open() }}
    <div class="row">
        <div class="form-group required col-md-8 mb-3">
            <label for="nome" class="form-label control-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $indicador->nome }}">
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="departamento" class="form-label control-label">Departamento:</label>
            <select class="form-select" name="departamento" id="departamento">
                <option value="">Selecione o departamento</option>
                @foreach ($departamentos as $dept)
                    @if ($dept->id != $indicador->departamento_id)
                        <option value="{{ $dept->id }}">{{ $dept->sigla }} - {{ $dept->nome }}</option>  
                    @else
                        <option value="{{ $dept->id }}" selected>{{ $dept->sigla }} - {{ $dept->nome }}</option>  
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="projeto" class="form-label control-label">Projeto:</label>
            <select class="form-select" name="projeto" id="projeto">
                <option value="">Selecione o projeto</option>
                @foreach ($projetos as $projeto)
                    @if ($projeto->id != $indicador->projeto_id)
                        <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option>  
                    @else
                        <option value="{{ $projeto->id }}" selected>{{ $projeto->nome }}</option>  
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="fonte" class="form-label control-label">Fonte:</label>
            <select class="form-select" name="fonte" id="fonte">
                <option value="">Selecione a fonte</option>
                @foreach ($fontes as $fonte)
                    @if ($fonte->id != $indicador->fonte_id)
                        <option value="{{ $fonte->id }}">{{ $fonte->nome }} ({{ $fonte->descricao }})</option>
                    @else
                        <option value="{{ $fonte->id }}" selected>{{ $fonte->nome }} ({{ $fonte->descricao }})</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-4 mb-3">
            <label for="periodicidade" class="form-label control-label">Periodicidade:</label>
            <select class="form-select" name="periodicidade" id="periodicidade">
                <option value="" selected>Selecione o periodicidade</option>
                @foreach ($periodicidades as $periodicidade)
                    @if ($periodicidade->id != $indicador->periodicidade_id)
                        <option value="{{ $periodicidade->id }}">{{ $periodicidade->nome }}</option>
                    @else
                        <option value="{{ $periodicidade->id }}" selected>{{ $periodicidade->nome }}</option>
                    @endif 
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="nota_tecnica" class="form-label">Nota Técnica:</label>
            <textarea class="form-control" id="nota_tecnica" rows="3" name="nota_tecnica">{{ $indicador->nota_tecnica }}</textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label for="observacao" class="form-label">Observacao:</label>
            <textarea class="form-control" id="observacao" rows="3" name="observacao">{{ $indicador->observacao }}</textarea>
        </div>
        <div class="col-md-3 mb-3">
            <label for="imagem" class="form-label">Imagem do Indicador:</label>
            <input class="form-control" type="file" id="imagem" name="imagem" accept=".png,.jpg,.jpeg,.gif">
            {{-- <input type="text" value="{{ $indicador->imagem }}" name="imagem" id="imagem" hidden> --}}
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Editar</button>
        <a href="{{ route('indicadores') }}" class="btn btn-outline-info">Cancelar</a>
    </div>
    {{ html()->form()->close() }}
</div>

@endsection