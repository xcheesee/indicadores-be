@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Editar Perfil de Usuário', 'rota' => 'roles.index'])
@endsection

@section('conteudo')
@include('layouts.erros', ['errors' => $errors])
<div class="container containerTabela justify-content-center">
    <div class="container">
        {{ html()->form('PATCH', route('roles.update', $role->id))->open() }}
        <?php html()->model($role); ?>
            <div class="form-group mb-3">
                <strong>Nome:</strong>
                {{ html()->text('name')->class('form-control')->placeholder('Nome do Perfil') }}
            </div>
            <div class="form-group mb-3">
                <strong>Permissão:</strong>
                <br/>
                @foreach($permission as $value)
                    <label>{{ html()->checkbox('permission[]', in_array($value->id, $rolePermissions), $value->id)->class('name') }}
                    {{ $value->name }}</label>
                <br/>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        {{ html()->form()->close() }}
    </div>
</div>
@endsection
