@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Editar Permissão', 'rota' => 'permissions.index'])
@endsection

@section('conteudo')
@include('layouts.erros', ['errors' => $errors])
<div class="container containerTabela justify-content-center">
    <div class="container">
        {{ html()->form('PATCH', route('permissions.update', $permission->id))->open() }}
        <?php html()->model($permission); ?>
            <div class="form-group mb-3">
                <strong>Nome:</strong>
                {{ html()->text('name')->class('form-control')->placeholder('Nome da Permissão') }}
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        {{ html()->form()->close() }}
    </div>
</div>
@endsection
