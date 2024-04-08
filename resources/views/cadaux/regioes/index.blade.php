@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Região', 'rota' => 'cadaux'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem]) 

<div class="row containerTabela justify-content-center">
    <div class="row">
        <div class="d-flex justify-content-end">
            <div>
                <button type="button" class="btn btn-primary buttonSlide" id="criarRegiao" style="display: none">Nova Região</button>
            </div>
        </div>
        <div class="mb-3" id="newform"> 
            <h4 class="mb-3">Nova Região</h4>
            {{ html()->form('POST', route('regiao-create'))->open() }}
                @csrf
                <div class="row">
                    <div class="form-group required col-md-4">
                        <label class="control-label" for="nome"><strong>Nome:</strong></label>
                        <input type="text" class="inputForm form-control" name="nome" id="nome">
                    </div>
                    <div class="form-group required col-md-4">
                        <label class="control-label" for="sigla"><strong>Sigla:</strong></label>
                        <input type="text" class="inputForm form-control" name="sigla" id="sigla">
                    </div>
                    <div class="form-group required col-md-4">
                        <label class="control-label" for="tipo_regiao_id"><strong>Tipo da Região:</strong></label>
                        <select class="form-control form-select" name="tipo_regiao_id" id="tipo_regiao_id">
                            <option value="" selected>Selecione o tipo da regiao</option>
                            @foreach ($tipo_regiao as $t_regiao)
                                <option value="{{ $t_regiao->id }}">{{ $t_regiao->nome }}</option>  
                            @endforeach
                        </select>
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
                    <th>Sigla</th>
                    <th>Tipo da Região</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($data as $key => $regiao)
                <tr>
                    <td>{{ $regiao->id }}</td>
                    {{ html()->form('POST', route('regiao-update', $regiao->id))->open() }}
                    <td>
                        <span class="texto-{{ $regiao->id }}">{{ $regiao->nome }}</span>
                        <input type="text" class="form-control campo-{{ $regiao->id }}" style="display: none" id="nome" name="nome" value="{{ $regiao->nome }}">
                    </td>
                    <td>
                        <span class="texto-{{ $regiao->id }}">{{ $regiao->sigla }}</span>
                        <input type="text" class="form-control campo-{{ $regiao->id }}" style="display: none" id="sigla" name="sigla" value="{{ $regiao->sigla }}">
                    </td>
                    <td>
                        <span class="texto-{{ $regiao->id }}">{{ $regiao->tipo_regiao->sigla }}</span>
                        <select class="form-control form-select campo-{{ $regiao->id }}" style="display: none" name="tipo_regiao_id" id="tipo_regiao_id">
                            <option value="" selected>Selecione o tipo da regiao</option>
                            @foreach ($tipo_regiao as $t_regiao)
                                @if ($regiao->tipo_regiao_id == $regiao->tipo_regiao->id)
                                    <option value="{{ $t_regiao->id }}" selected>{{ $t_regiao->nome }}</option>
                                @else
                                    <option value="{{ $t_regiao->id }}">{{ $t_regiao->nome }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div>
                            @can('role-edit')
                                <button class="btn btn-primary btn-editar-{{ $regiao->id }}" onclick="editarRegiao({{$regiao->id}})" type="button"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-success btn-save-{{ $regiao->id }}" type="submit" style="display: none"><i class="fas fa-check"></i></button>
                                <button class="btn btn-warning btn-cancelar-{{ $regiao->id }}" onclick="cancelarEditarRegiao({{$regiao->id}})" type="button" style="display: none"><i class="fas fa-xmark"></i></button>
                            @endcan
                            @can('role-delete')
                            <span id="btn-delete-{{ $regiao->id }}">
                                <a class="btn btn-danger" href="{{ route('regiao-destroy', $regiao->id) }}" onclick="return confirm('Tem certeza que deseja remover esse registro?')">
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
    $( "#criarRegiao" ).show()
    
    if({{ $errors->count() }} > 0){
        $( "#newform" ).show();
        $( "#criarRegiao" ).hide();
    } 
    
    $( ".buttonSlide" ).on( "click", function() {
        $( "#criarRegiao" ).hide(500);
        $( "#newform" ).slideToggle( "slow" );
    });
    
    $( "#cancelarFonte" ).on( "click", function() {
        $( "#criarRegiao" ).show(500);
    });
    
    var flagId = null
    function editarRegiao(Id){
        if (flagId != Id && flagId != null) {
            cancelarEditarRegiao(flagId)
        }
    
        $( `.btn-editar-${Id}` ).hide();
        $( `#btn-delete-${Id}` ).hide();
        $( `.btn-save-${Id}` ).show();
        $( `.btn-cancelar-${Id}` ).show();
        $( `.campo-${Id}` ).show();
        $( `.texto-${Id}` ).hide();
    
        flagId = Id
    }
    
    function cancelarEditarRegiao(Id){
        $( `.btn-editar-${Id}` ).show();
        $( `#btn-delete-${Id}` ).show();
        $( `.btn-save-${Id}` ).hide();
        $( `.btn-cancelar-${Id}` ).hide();
        $( `.campo-${Id}` ).hide();
        $( `.texto-${Id}` ).show();
    }  
</script>
@endsection