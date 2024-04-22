@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Indicadores', 'rota' => 'publicacao'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
<div class="row containerTabela justify-content-center">
    <div class="row">
        {{ html()->form('GET', route('indicadores'))->open() }}
            <div class="row">
                <div class="form-group col-md-3 mb-3">
                    <label for="nome" class="form-label control-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $filtros['nome'] }}">
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="projeto_id" class="form-label control-label">Projeto:</label>
                    <select class="form-select" name="projeto_id" id="projeto_id" value="{{ $filtros['projeto_id'] }}">
                        <option value="" selected>Selecione o Projeto</option>
                        @foreach ($projetos as $projeto)
                            @if ($filtros['projeto_id'] != $projeto->id)
                                <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option> 
                            @else
                                <option value="{{ $projeto->id }}" selected>{{ $projeto->nome }}</option>
                            @endif    
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="departamento_id" class="form-label control-label">Coordenação Responsável:</label>
                    <select class="form-select" name="departamento_id" id="departamento_id" name="departamento_id" value="{{ $filtros['departamento_id'] }}">
                        <option value="" selected>Selecione a Coordenação Responsável</option>
                        @foreach ($departamentos as $dept)
                            @if ($filtros['departamento_id'] != $dept->id)
                                <option value="{{ $dept->id }}">{{ $dept->sigla }} - {{ $dept->nome }}</option> 
                            @else
                                <option value="{{ $dept->id }}" selected>{{ $dept->sigla }} - {{ $dept->nome }}</option>
                            @endif    
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="fonte_id" class="form-label control-label">Fonte:</label>
                    <select class="form-select" name="fonte_id" id="fonte_id" value="{{ $filtros['fonte_id'] }}">
                        <option value="" selected>Selecione a Fonte</option>
                        @foreach ($fontes as $fonte)
                            @if ($filtros['fonte_id'] != $fonte->id)
                                <option value="{{ $fonte->id }}">{{ $fonte->nome }} ({{ $fonte->descricao }})</option> 
                            @else
                                <option value="{{ $fonte->id }}" selected>{{ $fonte->nome }} ({{ $fonte->descricao }})</option>
                            @endif    
                        @endforeach
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
                    <th class="text-center">Qtd de Variáveis</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($data as $key => $indicador)
                <tr>
                    <td>{{ $indicador->id }}</td>
                    <td>{{ $indicador->nome }}</td>
                    <td>{{ $indicador->projeto->nome }}</td>
                    <td>{{ $indicador->departamento->nome }}</td>
                    <td>{{ $indicador->fonte->nome }} ({{ $indicador->fonte->descricao }})</td>
                    <td class="text-center">{{ count($indicador_variavel->where('indicador_id', '=', $indicador->id)) }}</td>
                    <td>
                        <div>
                            <a class="btn btn-primary" href="{{ route('indicador-show', $indicador->id) }}"><i class="far fa-eye"></i></a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('indicador-edit', $indicador->id) }}"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('role-delete')
                            <a class="btn btn-danger" href="{{ route('indicador-destroy',$indicador->id) }}" onclick="return confirm('Tem certeza que deseja remover este indicador?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection