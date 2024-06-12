@extends('layouts.base')

@section('cabecalho')
    @include('layouts.cabecalho', ['titulo' => 'Criar Gráfico', 'rota' => 'graficos'])
@endsection

@section('conteudo')
@include('layouts.mensagem', ['mensagem' => $mensagem])
@include('layouts.erros', ['errors' => $errors])

<div class="d-flex justify-content-between mb-2 align-items-center">
    <p class="form-legenda" style="margin: 0"><em>Campos com (*) são obrigatórios</em></p>
</div>
<div class="row containerTabela justify-content-center">
    {{ html()->form('POST', route('grafico-store'))->open() }}
    @csrf
    <section class="row mb-3">
        <div class="form-group required col-md-6 mb-3">
            <label for="titulo_grafico" class="form-label control-label">TÍtulo do Gráfico:</label>
            <input type="text" class="form-control" id="titulo_grafico" name="titulo_grafico" placeholder="Título do Gráfico">
        </div>
        <div class="form-group required col-md-3 mb-3">
            <label for="projeto" class="form-label control-label">Projeto:</label>
            <select class="form-select" name="projeto" id="projeto">
                <option value="null" selected>Selecione o Projeto</option>
                @foreach ($projetos as $projeto)
                    <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option>  
                @endforeach
            </select>
        </div>
        <div class="form-group required col-md-3 mb-3">
            <label for="indicador" class="form-label control-label">Indicador:</label>
            <select class="form-select" name="indicador" id="indicador">
                <option value="null" selected>Selecione o Indicador</option>
                {{-- @foreach ($indicadores as $indicador)
                    <option value="{{ $indicador->id }}">{{ $indicador->nome }}</option>  
                @endforeach --}}
            </select>
        </div>
        <section class="row">
            <div class="d-flex justify-content-between mb-3">
                <h4>Dados do Indicador</h4>
                <a href="()" class="btn btn-primary disabled" hidden>Lista de Variáveis</a>
            </div>
            <div class="col-md-6 mb-3">Nome: <span id="nome_indicador"></span></div>
            <div class="col-md-2 mb-3">Periodicidade: <span id="periodicidade"></span></div>
            <div class="col-md-4 mb-3">Departamento: <span id="departamento"></span></div>
            <div class="col-md-6 mb-3">Fonte: <span id="fonte"></span></div>
            <div class="col-md-4 mb-3">Fórmula: <span id="formula"></span></div>
            <div class="col-md-12 mb-3">Observação: <span id="observacao"></span></div>
        </section>
        <div class="form-group required col-md-4 mb-3">
            <label for="tipo_grafico" class="form-label control-label">Tipo do Gráfico:</label>
            <select class="form-select" name="tipo_grafico" id="tipo_grafico">
                <option value="" selected>Selecione o Tipo de Gráfico</option>
                <option value="area">Area</option>
                <option value="barra">Barra</option>
                <option value="linha">Linha</option>
                <option value="pizza">Pizza</option>
            </select>
        </div>
        <div class="form-group required col-md-2 mb-3">
            <label for="casas_decimais" class="form-label control-label">Casas decimais:</label>
            <select class="form-select" name="casas_decimais" id="casas_decimais">
                <option value="0" selected>0 casas</option>
                <option value="1">1 casa</option>
                <option value="2">2 casas</option>
            </select>
        </div>
        <div class="form-group required col-md-2 mb-3">
            <label for="metrica" class="form-label control-label">Métrica:</label>
            <select class="form-select" name="metrica" id="metrica">
                <option value="" selected>Selecione a Métrica</option>
            </select>
        </div>
        <div class="form-group required col-md-1 mb-3">
            <label for="fonte" class="form-label control-label">Publicado:</label>
            <select class="form-select" name="fonte" id="fonte">
                <option value="0" selected>Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
    </section>
    <section class="mb-3">
        <h4>Preview do Gráfico</h4>
        <div style="height: 50vh" class="border rounded d-flex justify-content-center align-items-center opacity-50">
            <span class="text-center"><i class="fa-solid fa-chart-line fa-10x"></i></span>
        </div>
    </section>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Criar</button>
        <a href="{{ route('graficos') }}" class="btn btn-outline-info">Cancelar</a>
    </div>
    {{ html()->form()->close() }}
</div>
<script>
    $("#projeto").on("change", function() {
        $("#indicador").empty('<option>')
        $("#indicador").append($('<option>', {
            value: 'null',
            text: 'Selecione o Indicador',
            selected: true
        }))

        if(this.value != 'null'){
            $.ajax({
                url: `http://127.0.0.1:8000/projeto/${this.value}/filtrar`,
                type: 'GET',
                dataType: 'json',
                success: function(res){
                    let lista = res.data
                    lista.forEach(element => {
                        $("#indicador").append($('<option>', {
                            value: element.id,
                            text: element.nome
                        }))
                    });
                    $("#nome_indicador").text('')
                    $("#periodicidade").text('')
                    $("#departamento").text('')
                    $("#fonte").text('')
                    // $("#formula").text('')
                    $("#observacao").text('')
                    // console.log(res.data)
                },
                error: function(status, error){
                    console.log(error);
                }
            })
        }
    })


    $("#indicador").on("change", function() {
        if(this.value != 'null'){
            $.ajax({
                url: `http://127.0.0.1:8000/indicador/${this.value}/dados`,
                type: 'GET',
                dataType: 'json',
                success: function(res){
                    console.log(res.data)
                    $("#nome_indicador").text(res.data.nome)
                    $("#periodicidade").text(res.data.periodicidade)
                    $("#departamento").text(res.data.departamento.nome)
                    $("#fonte").text(res.data.fonte.nome)
                    // $("#formula").text(res.data.formula)
                    $("#observacao").text(res.data.observacao)
                },
                error: function(status, error){
                    console.log(error);
                }
            })
        }
    })
</script>

@include('utilitarios.scripts')
@endsection