@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Criar Usuário', 'rota' => 'users.index'])
@endsection

@section('conteudo')
@include('layouts.erros', ['errors' => $errors])
<div class="container containerTabela justify-content-center">
    <div class="container">
        {{ html()->form('POST', route('users.store'))->attribute('autocomplete','off')->open() }}
            <div class="form-group mb-3">
                <strong>Nome:</strong>
                {{ html()->text('name')->class('form-control')->placeholder('Nome do Usuário') }}
            </div>
            <div class="form-group mb-3">
                <strong>Login:</strong>
                {{ html()->text('login')->class('form-control')->placeholder('Login') }}
            </div>
            <div class="form-group mb-3">
                <strong>Email:</strong>
                {{ html()->text('email')->class('form-control')->placeholder('Email')->attribute('autocomplete','off') }}
            </div>
            <div class="form-group mb-3">
                <strong>Senha:</strong>
                {{ html()->password('password')->class('form-control')->placeholder('Senha')->attribute('autocomplete','new-password') }}
            </div>
            <div class="form-group mb-3">
                <strong>Confirmação Senha:</strong>
                {{ html()->password('password_confirmation')->class('form-control')->placeholder('Confirmar Senha')->attribute('autocomplete','off') }}
            </div>
            <div class="form-group mb-3">
                <strong>Perfis de Usuário:</strong>
                {!! html()->select('roles[]', $roles,[])->class('form-control')->multiple() !!}
            </div>
            <button type="submit" class="btn btn-dark">Salvar</button>
        {{ html()->form()->close() }}
    </div>
</div>
@endsection
