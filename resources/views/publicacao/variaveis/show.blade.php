@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Variável: '.$variavel->nome, 'rota' => 'variaveis'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
<div class="row flex gap-3 mb-3">
    <div class="col bg-light rounded text-center py-2">
        <b class="d-block fs-4">Indicador:</b> 
        <span class="fs-5">{{ $indicador->nome }}</span>
    </div>
    <div class="col bg-light rounded text-center py-2">
        <b class="d-block fs-4">Código:</b> 
        <span class="fs-5">{{ $variavel->codigo }}</span>
    </div>
    <div class="col bg-light rounded text-center py-2">
        <b class="d-block fs-4">Coordenação:</b> 
        <span class="fs-5">{{ $departamento->sigla }}</span>
    </div>
    <div class="col bg-light rounded text-center py-2">
        <b class="d-block fs-4">Tipo de Dado:</b> 
        <span class="fs-5">{{ $tipo_dados->nome }}</span>
    </div>
    <div class="col bg-light rounded text-center py-2">
        <b class="d-block fs-4">Fonte:</b> 
        <span class="fs-5">{{ $fontes->nome }}</span>
    </div>
</div>
<div class="row containerTabela justify-content-center">
    <section class="mb-4 row">
        <h3 class="fs-4">Metadados</h3>
        <div class="mb-2">
            <b>Unidade de Medida:</b> @if ($tipo_medida != null) {{ $tipo_medida->nome }}  @endif
        </div>
        <div class="mb-2">
            <b>Início da Série Histórica:</b> {{ $metadados->serie_historica_inicio }}
        </div>
        <div class="mb-2">
            <b>Fim da Série Histórica:</b> {{ $metadados->serie_historica_fim }}
        </div>
        <div class="mb-2">
            <b>Nota Técnica:</b> {{ $metadados->nota_tecnica }}
        </div>
        <div class="mb-2">
            <b>Organização:</b> {{ $metadados->organização }}
        </div>
        <div class="mb-2">
            <b>Observação:</b> {{ $metadados->observacao }}
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('variavel-edit', $variavel->id) }}">Editar</a>
        </div>
    </section>
    <section>
        <div class="d-flex justify-content-between">
            <h2 class="fs-4">Valores</h2>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo Valor</button>
        </div>
        <table class="table overflow-y-auto">
            <thead class="thead-dark">
                <tr>
                    <th>Região</th>
                    <th>Tipo da Regiao</th>
                    <th>Período</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($valores as $valor_variavel)
                <tr>    
                    {{ html()->form('POST', route('valor-update', [$valor_variavel->valor_id, $variavel->id]))->open() }}
                    <td>
                        <span class="valor-{{ $valor_variavel->valor_id }}">{{ $valor_variavel->valor->regiao->nome }}</span>
                        <select class="form-select campo-{{ $valor_variavel->valor_id }}" name="regiao" id="regiao" style="display: none">
                            <option value="">Selecione a Região</option>
                            @foreach ($regioes as $regiao)
                                @if ($regiao->id != $valor_variavel->valor->regiao_id)
                                    <option value="{{ $regiao->id }}">{{ $regiao->nome }}</option> 
                                @else
                                    <option value="{{ $regiao->id }}" selected>{{ $regiao->nome }}</option>  
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <span class="valor-{{ $valor_variavel->valor_id }}">{{ $valor_variavel->valor->regiao->tipo_regiao->nome }}</span>
                        <select class="form-select campo-{{ $valor_variavel->valor_id }}" name="tipo_regiao" id="tipo_regiao" style="display: none">
                            <option value="">Selecione o Tipo de Região</option>
                            @foreach ($tipo_regiao as $tipo)
                                @if ($regiao->tipo_regiao_id != $valor_variavel->valor->regiao->tipo_regiao_id)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>  
                                @else
                                    <option value="{{ $tipo->id }}" selected>{{ $tipo->nome }}</option> 
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <span class="valor-{{ $valor_variavel->valor_id }}">{{ $valor_variavel->valor->periodo }}</span>
                        <input type="text" class="form-control campo-{{ $valor_variavel->valor_id }} periodo" name="periodo" value="{{ $valor_variavel->valor->periodo }}" style="display: none">
                    </td>
                    <td>
                        <span class="valor-{{ $valor_variavel->valor_id }}">{{str_replace(".",",", $valor_variavel->valor->valor)}}</span>
                        <input type="text" class="form-control campo-{{ $valor_variavel->valor_id }} valor" name="valor" value="{{ $valor_variavel->valor->valor }}" style="display: none">
                    </td>
                    <td class="btn-acao-{{ $valor_variavel->valor_id }}">
                        @can('role-edit')
                            <button type="button" class="btn btn-primary" onclick="editarValor({{$valor_variavel->valor_id}})"><i class="fas fa-edit"></i></button>
                            {{-- <a class="btn btn-primary" href="{{ route('variavel-metadados', $projeto->id) }}"><i class="fa-regular fa-file-lines"></i></a> --}}
                        @endcan
                        @can('role-delete')
                        <a class="btn btn-danger" href="{{ route('valor-destroy', [$valor_variavel->valor_id, $variavel->id]) }}" onclick="return confirm('Tem certeza que deseja remover esta variável?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        @endcan
                    </td>
                    <td class="btn-acao-edicao-{{ $valor_variavel->valor_id }}" style="display: none">
                        @can('role-edit')
                            <button class="btn btn-success" type="submit"><i class="fas fa-check"></i></button>
                            <button class="btn btn-warning" onclick="cancelarEditarValor({{$valor_variavel->valor_id}})" type="button"><i class="fas fa-xmark"></i></button>
                        @endcan
                    </td>
                    {{ html()->form()->close() }}
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Valor</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{ html()->form('POST', route('valor-create', $variavel->id))->open() }}
        @csrf
        <div class="modal-body">
            @include('layouts.erros', ['errors' => $errors])
            <section class="row">
                <div class="form-group col-sm-12 mb-3">
                    <label for="tipo_regiao" class="form-label control-label">Tipo da Região:</label>
                    <select class="form-select tipo_regiao-create" name="tipo_regiao" id="tipo_regiao">
                        <option value="" selected>Selecione o Tipo da Região</option>
                        @foreach ($tipo_regiao as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>  
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-12 mb-3">
                    <label for="regiao" class="form-label control-label">Região:</label>
                    <select class="form-select regiao-create" name="regiao" id="regiao">
                        <option value="" selected>Selecione a Região</option>
                        {{-- @foreach ($regioes as $regiao)
                            <option value="{{ $regiao->id }}">{{ $regiao->nome }}</option>  
                        @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-sm mb-3">
                    <label for="periodo" class="form-label control-label">Período:</label>
                    <input type="text" class="form-control" id="periodo" name="periodo">
                </div>
                <div class="form-group col-sm mb-3">
                    <label for="valor" class="form-label control-label">Valor:</label>
                    <input type="text" class="form-control" id="valor" name="valor">
                </div>
            </section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Criar</button>
        </div>
        {{ html()->form()->close() }}
      </div>
    </div>
</div>

<script>
    if({{ $errors->count() }} > 0){
        const modal = new bootstrap.Modal('#exampleModal');
        modal.show();
        console.log(true)
    } 

    var flagId = null;
    function editarValor(Id){
        // if (flagId != Id && flagId != null) {
        //     cancelarEditarValor(flagId)
        // }

        $( `.btn-acao-edicao-${Id}` ).show();
        $( `.btn-acao-${Id}` ).hide();
        $( `.campo-${Id}` ).show();
        $( `.valor-${Id}` ).hide();
    
        flagId = Id
    }

    function cancelarEditarValor(Id){
        $( `.btn-acao-edicao-${Id}` ).hide();
        $( `.btn-acao-${Id}` ).show();
        $( `.campo-${Id}` ).hide();
        $( `.valor-${Id}` ).show();
    }

    $(".tipo_regiao-create").on("change", function() {
        $(".regiao-create").empty('<option>')
        $(".regiao-create").append($('<option>', {
            value: '',
            text: 'Selecione a Região',
            selected: true
        }))

        $.ajax({
            url: `http://127.0.0.1:8000/cadaux/regiao/${this.value}/filtrar`,
            type: 'GET',
            dataType: 'json',
            success: function(res){
                let lista = res.data
                lista.forEach(element => {
                    $(".regiao-create").append($('<option>', {
                        value: element.id,
                        text: element.nome
                    }))
                });
                // console.log(res.data)
            },
            error: function(status, error){
                console.log(error);
            }
        })
    })
</script>
@endsection