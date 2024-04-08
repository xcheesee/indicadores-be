@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Fonte', 'rota' => 'cadaux'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])

<div class="row containerTabela justify-content-center">
    <div class="row">
        <div class="d-flex justify-content-end">
            <div>
                <button class="btn btn-primary buttonSlide" id="criarFonte" type="button" style="display: none">Nova Fonte</button>
            </div>
        </div>
        <div class="mb-3" id="newform">
            <h4 class="mb-3">Nova Fonte</h4>
            {{ html()->form('POST', route('fonte-create'))->open() }}
                @csrf
                <div class="row">
                    <div class="form-group required col-md-6">
                        <label class="control-label" for="nome"><strong>Nome:</strong></label>
                        <input type="text" class="inputForm form-control" name="nome" id="nome">
                    </div>
                    <div class="form-group required col-md-6">
                        <label class="control-label" for="descricao"><strong>Descrição:</strong></label>
                        <input type="text" class="inputForm form-control" name="descricao" id="descricao">
                    </div>
                </div>
                <button class="btn btn-primary mt-3 me-1 btn-criar" type="submit" >Criar</button>
                <button class="btn btn-warning mt-3 buttonSlide" type="button" id="cancelarFonte">Cancelar</button>
            {{ html()->form()->close() }}
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th class="col-sm-3">Nome</th>
                    <th>Descrição</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($data as $key => $fonte)
                <tr>
                    <td>{{ $fonte->id }}</td>
                    {{ html()->form('POST', route('fonte-update', $fonte->id))->open() }}
                    @csrf
                    <td>
                        <span class="texto-{{ $fonte->id }}">{{ $fonte->nome }}</span>
                        <input type="text" class="form-control campo-{{ $fonte->id }}" style="display: none" id="nome" name="nome" value="{{ $fonte->nome }}">
                    </td>
                    <td>
                        <span class="texto-{{ $fonte->id }}">{{ $fonte->descricao }}</span>
                        <input type="text" class="form-control campo-{{ $fonte->id }}" style="display: none" id="descricao" name="descricao" value="{{ $fonte->descricao }}">
                    </td>
                    <td>
                        <div>
                            @can('role-edit')
                                <button class="btn btn-primary btn-editar-{{ $fonte->id }}" onclick="editarFonte({{$fonte->id}})" type="button"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-success btn-save-{{ $fonte->id }}" type="submit" style="display: none"><i class="fas fa-check"></i></button>
                                <button class="btn btn-warning btn-cancelar-{{ $fonte->id }}" onclick="cancelarEditarFonte({{$fonte->id}})" type="button" style="display: none"><i class="fas fa-xmark"></i></button>
                            @endcan
                            @can('role-delete')
                                <span id="btn-delete-{{ $fonte->id }}">
                                    <a class="btn btn-danger" href="{{ route('fonte-destroy', $fonte->id) }}" onclick="return confirm('Tem certeza que deseja remover esse registro?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </span>
                            @endcan
                        </div>
                    </td>
                    {{ html()->form()->close() }}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
$( "#newform" ).hide();
$( "#criarFonte" ).show()

if({{ $errors->count() }} > 0){
    $( "#newform" ).show();
    $( "#criarFonte" ).hide();
} 

$( ".buttonSlide" ).on( "click", function() {
    $( "#criarFonte" ).hide(500);
    $( "#newform" ).slideToggle( "slow" );
});

$( "#cancelarFonte" ).on( "click", function() {
    $( "#criarFonte" ).show(500);
});

var flagId = null
function editarFonte(Id){
    if (flagId != Id && flagId != null) {
        cancelarEditarFonte(flagId)
    }

    $( `.btn-editar-${Id}` ).hide();
    $( `#btn-delete-${Id}` ).hide();
    $( `.btn-save-${Id}` ).show();
    $( `.btn-cancelar-${Id}` ).show();
    $( `.campo-${Id}` ).show();
    $( `.texto-${Id}` ).hide();

    flagId = Id
}

function cancelarEditarFonte(Id){
    $( `.btn-editar-${Id}` ).show();
    $( `#btn-delete-${Id}` ).show();
    $( `.btn-save-${Id}` ).hide();
    $( `.btn-cancelar-${Id}` ).hide();
    $( `.campo-${Id}` ).hide();
    $( `.texto-${Id}` ).show();
}

</script>
@endsection