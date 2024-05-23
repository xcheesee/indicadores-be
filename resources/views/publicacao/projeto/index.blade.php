@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Projeto', 'rota' => 'publicacao'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<div class="row containerTabela justify-content-center">
    <div class="row">
        {{ html()->form('GET', route('projetos'))->open() }}
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="nome" class="form-label control-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{$filtros['nome']}}" placeholder="Nome do Projeto">
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="departamento" class="form-label control-label">Unidade Responsável:</label>
                    <select class="form-select" name="departamento" id="departamento">
                        <option value="" selected>Selecione a Unidade Responsável</option>
                        @foreach ($departamentos as $dept)
                            @if ($filtros['departamento_id'] != $dept->id)
                                <option value="{{ $dept->id }}">{{ $dept->sigla }} - {{ $dept->nome }}</option> 
                            @else
                                <option value="{{ $dept->id }}" selected>{{ $dept->sigla }} - {{ $dept->nome }}</option>
                            @endif    
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="visivel" class="form-label control-label">Publicado:</label>
                    <select class="form-select" name="visivel" id="visivel">
                        @if (!$filtros['visivel'])
                            <option value="0" selected>Não</option>
                            <option value="1">Sim</option>
                        @else
                            <option value="0">Não</option>
                            <option value="1" selected>Sim</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filtrar</button>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('projeto-create') }}">Novo Projeto</a>
                </div>
            </div>
        {{ html()->form()->close() }}
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th class="col-sm-2">Nome</th>
                        <th>Responsável</th>
                        <th class="text-center">Qtd de Indicadores</th>
                        <th class="text-center">Publicado</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($data as $key => $projeto)
                    <tr>
                        <td>{{ $projeto->id }}</td>
                        <td><img src="{{ Storage::url($projeto->imagem) }}" alt="" class="rounded" style="max-height: 100px; max-width: 100px;"></td>
                        <td>{{ $projeto->nome }}</td>
                        <td>{{ $projeto->departamento->nome }}</td>
                        <td class="text-center">{{ count($indicadores->where('projeto_id', '=', $projeto->id)) }}</td>
                        <td class="text-center">
                            @if ($projeto->visivel == 0)
                                <i class="fa-solid fa-circle-xmark text-danger" style="font-size: 1.3em"></i>
                            @else
                                <i class="fa-solid fa-circle-check text-success" style="font-size: 1.3em"></i>
                            @endif
                        </td>
                        <td>
                            <div>
                                <a class="btn btn-primary" href="{{ route('projeto-show', $projeto->id) }}"><i class="far fa-eye"></i></a>
                                @can('role-edit')
                                    <a class="btn btn-primary" href="{{ route('projeto-edit', $projeto->id) }}"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('role-delete')
                                <a class="btn btn-danger" href="{{ route('projeto-destroy',$projeto->id) }}" onclick="return confirm('Tem certeza que deseja remover este projeto?')">
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
        {{ $data->appends($_GET)->links() }}
    </div>
</div>

@endsection