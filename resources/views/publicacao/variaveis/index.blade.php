@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Variáveis', 'rota' => 'publicacao'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])

<div class="row containerTabela justify-content-center">
    <div class="row">
        {{ html()->form('GET', route('variaveis'))->open() }}
            <div class="row">
                <div class="form-group col-md-3 mb-3">
                    <label for="codigo" class="form-label control-label">Código:</label>
                    <input type="text" class="form-control codigo" id="codigo" name="codigo" value="{{$filtros['codigo']}}">
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="nome" class="form-label control-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{$filtros['nome']}}">
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="departamento" class="form-label control-label">Unidade Responsável:</label>
                    <select class="form-select" name="departamento" id="departamento">
                        <option value="" selected>Selecione o Departamento</option>
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
                    <label for="fonte" class="form-label control-label">Fonte:</label>
                    <select class="form-select" name="fonte" id="fonte">
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
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('variavel-create') }}">Nova Variável</a>
                </div>
            </div>
        {{ html()->form()->close() }}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="col-sm-1">Código</th>
                    <th>Nome</th>
                    <th class="col-sm-3">Coordenação Responsável</th>
                    <th class="col-sm-2">Tipo do Dado</th>
                    <th>Fonte</th>
                    <th class="col-sm-2">Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($data as $key => $variavel)
                <tr>
                    <td><b>{{ $variavel->codigo }}</b></td>
                    <td>{{ $variavel->nome }}</td>
                    <td>{{ $variavel->departamento->nome }}</td>
                    <td>{{ $variavel->tipo_dado->nome }}</td>
                    <td>{{ $variavel->fonte->nome }} ({{ $variavel->fonte->descricao }})</td>
                    <td>
                        <div>
                            <a class="btn btn-primary" href="{{ route('variavel-show', $variavel->id) }}"><i class="far fa-eye"></i></a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('variavel-edit', $variavel->id) }}"><i class="fas fa-edit"></i></a>
                                {{-- <a class="btn btn-primary" href="{{ route('variavel-metadados', $projeto->id) }}"><i class="fa-regular fa-file-lines"></i></a> --}}
                            @endcan
                            @can('role-delete')
                            <a class="btn btn-danger" href="{{ route('variavel-destroy', $variavel->id) }}" onclick="return confirm('Tem certeza que deseja remover esta variável?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->appends($_GET)->links() }}
    </div>
</div>

@include('utilitarios.scripts')
@endsection