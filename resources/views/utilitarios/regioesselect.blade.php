<script>
    if({{ $errors->count() }} > 0){
        const modal = new bootstrap.Modal('#exampleModal');
        modal.show();
    } 

    var flagId = null;
    async function editarValor(Id, valor_regiao){
        if (flagId != Id && flagId != null) {
            cancelarEditarValor(flagId)
            $(`.campo-${Id}.tipo-regiao option`).prop("selected", function () {
                return this.defaultSelected;
            });
        }

        const value = $(`.campo-${Id}.tipo-regiao`).val();

        $(`.campo-${Id}.regiao`).empty('<option>')
        $(`.campo-${Id}.regiao`).append($('<option>', {
            value: '',
            text: 'Selecione a Região',
            selected: false
        }))

        await mudaCampoEditar(Id, value, valor_regiao);

        $(`.campo-${Id}.tipo-regiao`).on("change", async function() {
            const valueTipoRegiao = $(`.campo-${Id}.tipo-regiao`).val();
            await mudaCampoEditar(Id, valueTipoRegiao);
        })

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

    async function mudaCampoEditar(Id, valor_tipoRegiao, valor_regiao=0){

        if(valor_regiao != 0){
            $(`.campo-${Id}.regiao`).empty('<option>')
            $(`.campo-${Id}.regiao`).append($('<option>', {
                value: '',
                text: 'Selecione a Região',
                selected: false
            }))
        } else {
            $(`.campo-${Id}.regiao`).empty('<option>')
            $(`.campo-${Id}.regiao`).append($('<option>', {
                value: '',
                text: 'Selecione a Região',
                selected: true
            }))
        }

        

        await $.ajax({
            url: `{{ env('APP_FOLDER', 'indicadores_be') }}/cadaux/regiao/${valor_tipoRegiao}/filtrar`,
            type: 'GET',
            dataType: 'json',
            success: function(res){
                let lista = res.data
                lista.forEach(element => {
                    if(element.id == valor_regiao) {
                        $(`.campo-${Id}.regiao`).append($('<option>', {
                            value: element.id,
                            text: element.nome,
                            selected: true
                        }))
                    } else {
                        $(`.campo-${Id}.regiao`).append($('<option>', {
                            value: element.id,
                            text: element.nome,
                            selected: false
                        }))
                    }
                });
                // console.log(res.data)
            },
            error: function(status, error){
                console.log(error);
            }
        })
        
    }

    $(".tipo_regiao-create").on("change", function() {
        $(".regiao-create").empty('<option>')
        $(".regiao-create").append($('<option>', {
            value: '',
            text: 'Selecione a Região',
            selected: true
        }))

        $.ajax({
            url: `{{ env('APP_FOLDER', 'indicadores_be') }}/cadaux/regiao/${this.value}/filtrar`,
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