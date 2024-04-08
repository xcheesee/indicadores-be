@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Projeto', 'rota' => 'home'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])

<div class="row containerTabela justify-content-center">
    <div class="row">
        <div class="d-flex justify-content-end">
            <div>
                <a class="btn btn-primary" href="{{ route('projeto-create') }}">Novo Projeto</a>
            </div>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th class="col-sm-3">Nome</th>
                    <th>Responsável</th>
                    <th class="text-center">Publicado</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($data as $key => $projeto)
                <tr>
                    <td>{{ $projeto->id }}</td>
                    <td>{{ $projeto->nome }}</td>
                    <td>{{ $projeto->departamento->nome }}</td>
                    <td class="text-center">
                        @if ($projeto->ativo == 0)
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
                                {{-- {{ html()->form('DELETE', route('roles.destroy', $role->id))->attributes(['style'=>'display:inline','onsubmit'=>'return confirm("Tem certeza que deseja remover \''.$role->name.'\'?")'])->open() }} --}}
                                <a class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                {{-- {{ html()->form('DELETE') }}
                                {{ html()->button('<i class="far fa-trash-alt"></i>','submit')->class('btn btn-danger') }}
                                {{ html()->form()->close() }} --}}
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

@endsection