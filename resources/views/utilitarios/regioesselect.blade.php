<script>
    if({{ $errors->count() }} > 0){
        const modal = new bootstrap.Modal('#exampleModal');
        modal.show();
    } 

    var flagId = null;
    async function editarValor(Id){
        if (flagId != Id && flagId != null) {
            cancelarEditarValor(flagId)
        }

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