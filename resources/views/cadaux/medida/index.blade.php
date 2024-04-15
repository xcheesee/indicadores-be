@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Tipo de Medida', 'rota' => 'cadaux'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])

<div class="row containerTabela justify-content-center">
    <div class="row">
        <div class="d-flex justify-content-end">
            <div>
                <button type="button" class="btn btn-primary buttonSlide" id="criarMedida" style="display: none">Novo Tipo de Medida</button>
            </div>
        </div>
        <div class="mb-3" id="newform"> 
            <h4 class="mb-3">Novo Tipo de Medida</h4>
            {{ html()->form('POST', route('medida-create'))->open() }}
                @csrf
                <div class="row">
                    <div class="form-group required col-md">
                        <label class="control-label" for="nome"><strong>Nome:</strong></label>
                        <input type="text" class="inputForm form-control" name="nome" id="nome">
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
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($data as $key => $tipo_medida)
                <tr>
                    <td>{{ $tipo_medida->id }}</td>
                    {{ html()->form('POST', route('medida-update', $tipo_medida->id))->open() }}
                    <td>
                        <span class="texto-{{ $tipo_medida->id }}">{{ $tipo_medida->nome }}</span>
                        <input type="text" class="form-control campo-{{ $tipo_medida->id }}" style="display: none" id="nome" name="nome" value="{{ $tipo_medida->nome }}">
                    </td>
                    <td>
                        <div>
                            @can('role-edit')
                                <button class="btn btn-primary btn-editar-{{ $tipo_medida->id }}" onclick="editarMedida({{$tipo_medida->id}})" type="button"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-success btn-save-{{ $tipo_medida->id }}" type="submit" style="display: none"><i class="fas fa-check"></i></button>
                                <button class="btn btn-warning btn-cancelar-{{ $tipo_medida->id }}" onclick="cancelarEditarMedida({{$tipo_medida->id}})" type="button" style="display: none"><i class="fas fa-xmark"></i></button>
                            @endcan
                            @can('role-delete')
                            <span id="btn-delete-{{ $tipo_medida->id }}">
                                <a class="btn btn-danger" href="{{ route('medida-destroy', $tipo_medida->id) }}" onclick="return confirm('Tem certeza que deseja remover esse registro?')">
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
    $( "#criarMedida" ).show();
    
    if({{ $errors->count() }} > 0){
        $( "#newform" ).show();
        $( "#criarMedida" ).hide();
    } 
    
    $( ".buttonSlide" ).on( "click", function() {
        $( "#criarMedida" ).hide(500);
        $( "#newform" ).slideToggle( "slow" );
    });
    
    $( "#cancelarFonte" ).on( "click", function() {
        $( "#criarMedida" ).show(500);
    });
    
    var flagId = null
    function editarMedida(Id){
        if (flagId != Id && flagId != null) {
            cancelarEditarMedida(flagId);
        }
    
        $( `.btn-editar-${Id}` ).hide();
        $( `#btn-delete-${Id}` ).hide();
        $( `.btn-save-${Id}` ).show();
        $( `.btn-cancelar-${Id}` ).show();
        $( `.campo-${Id}` ).show();
        $( `.texto-${Id}` ).hide();
    
        flagId = Id
    }
    
    function cancelarEditarMedida(Id){
        $( `.btn-editar-${Id}` ).show();
        $( `#btn-delete-${Id}` ).show();
        $( `.btn-save-${Id}` ).hide();
        $( `.btn-cancelar-${Id}` ).hide();
        $( `.campo-${Id}` ).hide();
        $( `.texto-${Id}` ).show();
    }  
</script>
@endsection