@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Periodicidades', 'rota' => 'cadaux'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])

<div class="row containerTabela justify-content-center">
    <div class="row">
        <div class="d-flex justify-content-end">
            <div>
                <button type="button" class="btn btn-primary buttonSlide" id="criarPeriodicidade" style="display: none">Nova Periodicidade</button>
            </div>
        </div>
        <div class="mb-3" id="newform"> 
            <h4 class="mb-3">Nova Periodicidade</h4>
            {{ html()->form('POST', route('periodicidade-create'))->open() }}
                @csrf
                <div class="row">
                    <div class="form-group required col-md-6">
                        <label class="control-label" for="nome"><strong>Nome:</strong></label>
                        <input type="text" class="inputForm form-control" name="nome" id="nome">
                    </div>
                    <div class="form-group required col-md-6">
                        <label class="control-label" for="qtd_meses"><strong>Quantidade de Meses:</strong></label>
                        <input type="number" class="inputForm form-control" name="qtd_meses" id="qtd_meses">
                    </div>
                </div>
                <button class="btn btn-primary mt-3 me-1 btn-criar" type="submit" >Criar</button>
                <button class="btn btn-warning mt-3 buttonSlide" type="button" id="cancelarPeriodicidade">Cancelar</button>
            {{ html()->form()->close() }}
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th class="col-sm-3">Nome</th>
                    <th>Qtd de Meses</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($data as $key => $periodicidade)
                <tr>
                    <td>{{ $periodicidade->id }}</td>
                    {{ html()->form('POST', route('periodicidade-update', $periodicidade->id))->open() }}
                    <td>
                        <span class="texto-{{ $periodicidade->id }}">{{ $periodicidade->nome }}</span>
                        <input type="text" class="form-control campo-{{ $periodicidade->id }}" style="display: none" id="nome" name="nome" value="{{ $periodicidade->nome }}">
                    </td>
                    <td>
                        <span class="texto-{{ $periodicidade->id }}">{{ $periodicidade->qtd_meses }}</span>
                        <input type="text" class="form-control campo-{{ $periodicidade->id }}" style="display: none" id="qtd_meses" name="qtd_meses" value="{{ $periodicidade->qtd_meses }}">
                    </td>
                    <td>
                        <div>
                            @can('role-edit')
                                <button class="btn btn-primary btn-editar-{{ $periodicidade->id }}" onclick="editarPeriodicidade({{$periodicidade->id}})" type="button"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-success btn-save-{{ $periodicidade->id }}" type="submit" style="display: none"><i class="fas fa-check"></i></button>
                                <button class="btn btn-warning btn-cancelar-{{ $periodicidade->id }}" onclick="cancelarEditarPeriodicidade({{$periodicidade->id}})" type="button" style="display: none"><i class="fas fa-xmark"></i></button>
                            @endcan
                            @can('role-delete')
                            <span id="btn-delete-{{ $periodicidade->id }}">
                                <a class="btn btn-danger" href="{{ route('periodicidade-destroy', $periodicidade->id) }}" onclick="return confirm('Tem certeza que deseja remover esse registro?')">
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
    $( "#criarPeriodicidade" ).show()
    
    if({{ $errors->count() }} > 0){
        $( "#newform" ).show();
        $( "#criarPeriodicidade" ).hide();
    } 
    
    $( ".buttonSlide" ).on( "click", function() {
        $( "#criarPeriodicidade" ).hide(500);
        $( "#newform" ).slideToggle( "slow" );
    });
    
    $( "#cancelarFonte" ).on( "click", function() {
        $( "#criarPeriodicidade" ).show(500);
    });
    
    var flagId = null
    function editarPeriodicidade(Id){
        if (flagId != Id && flagId != null) {
            cancelarEditarPeriodicidade(flagId)
        }
    
        $( `.btn-editar-${Id}` ).hide();
        $( `#btn-delete-${Id}` ).hide();
        $( `.btn-save-${Id}` ).show();
        $( `.btn-cancelar-${Id}` ).show();
        $( `.campo-${Id}` ).show();
        $( `.texto-${Id}` ).hide();
    
        flagId = Id
    }
    
    function cancelarEditarPeriodicidade(Id){
        $( `.btn-editar-${Id}` ).show();
        $( `#btn-delete-${Id}` ).show();
        $( `.btn-save-${Id}` ).hide();
        $( `.btn-cancelar-${Id}` ).hide();
        $( `.campo-${Id}` ).hide();
        $( `.texto-${Id}` ).show();
    }  
</script>
@endsection