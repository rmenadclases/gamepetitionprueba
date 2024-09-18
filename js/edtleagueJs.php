<script>
    $(".fontMenu").click(function() {
        if ($(this).hasClass('selMenuStatic')) {
            $(this).removeClass('selMenuStatic')
            $(".ligaSub").slideUp(500)
        } else {
            $(".fontMenu").removeClass('selMenuStatic')
            $(this).addClass('selMenuStatic')
            $(".ligaSub").slideUp(500)
            var idMen = $(this).attr('id')
            $("#dv_" + idMen).slideDown(500);
        }
    });

    //Crear versus
    $("#butCreaVs").click(function() {
    var leagueId = $("#butCreaVs").attr('data-id');
    var lgtipo = $("input[name='lgtipo']").val();
    var lgtipduel = $("input[name='lgtipduel']").val();

    console.log("leagueId: " + leagueId);
    console.log("lgtipo: " + lgtipo);
    console.log("lgtipduel: " + lgtipduel);

    $.ajax({
        url: 'app/setVersus.php',
        type: 'post',
        data: {
            leagueId: leagueId,
            lgtipo: lgtipo,
            lgtipduel: lgtipduel,
        },
        dataType: 'json',
        success: function(response) {
            location.reload();
        }
    });
});


    //Finalizar Liga
    $("#endLeague").click(function() {
        $.ajax({
            url: 'app/setLiga.php',
            type: 'post',
            data: {
                leagueId: $("#endLeague").attr('data-id'),
                tipo: 'END'
            },
            dataType: 'json',
            success: function(response) {
                location.reload();
            }
        });
    })

    $(document).ready(function() {
    $(document).on('change', '.updPuntos, .updMarcador', function() {
        // Obtener valores necesarios del elemento actual
        var lgid = $(this).attr('lg');
        var usrid = $(this).attr('id');
        var numvs = $(this).attr('vs');
        var puntos = $(this).val(); // Obtener el valor actual del elemento cambiado

        // Verificar si es updPuntos o updMarcador
        var tipoCampo = $(this).hasClass('updPuntos') ? 'puntos' : 'marcador';

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'app/setPuntos.php',
            type: 'post',
            data: {
                lgid: lgid,
                usrid: usrid,
                numvs: numvs,
                tipo: tipoCampo, // Enviar el tipo de campo (puntos o marcador)
                valor: puntos // Enviar el valor del campo cambiado
            },
            dataType: 'json',
            success: function(response) {
                // Manejar la respuesta del servidor si es necesario
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Manejar errores de AJAX si ocurre alguno
                console.error(error);
            }
        });
    });
});




    //update puntos torneo
    $(document).on('change', ".updPuntosTor", function() {
        let numvs = $(this).attr('vs')
        $.ajax({
            url: 'app/setPuntosTor.php',
            type: 'post',
            data: {
                lgid: $(this).attr('lg'),
                usrid: $(this).attr('idusr'),
                numvs: $(this).attr('vs'),
                puntos: $(this).val(),
            },
            dataType: 'json',
            success: function(response) {
                if (response['RESPONSE'] == 'SUCCESS') {
                    let lbl = "#lblW" + numvs
                    let inp = "#inpW" + numvs
                    console.log(lbl)
                    $(lbl).text(response['USRNAME'])
                    $(inp).attr('idusr', response['IDUSRW'])
                    $(inp).attr('disabled', false)
                }
            }
        });
    });

    //Mostrar Class
    $("#classif").click(function() {
        $('#dv_classif').empty();
        $.ajax({
            url: 'app/getClass.php',
            type: 'post',
            data: {
                leagueId: $("#dv_classif").attr('data-id')
            },
            dataType: 'json',
            success: function(response) {
                if (response['RESPONSE'] == 'SUCCESS') {
                    if (response['ROW_CNT'] > 0) {
                        for (var i = 0; i < response['CLAS'].length; i++) {
                            var html = `<div class="row col-md-7 col-sm-11 my-2">
                                <div class="col-2 me-auto my-auto fw-bolder fs-3">
                                    <p id="posPart" class="posPart">` + (i + 1) + ` .</p>
                                </div>
                                <div class="col my-auto fw-bolder fs-2 text-center">
                                    <p id="namePart" class="namePart">` + response['CLAS'][i]['username'] + `</p>
                                </div>
                                <div class="col-2 my-auto fs-4 ms-auto">
                                    <p id="namePart">` + response['CLAS'][i]['puntos'] + ` pts</p>
                                </div>
                            </div>`
                            $('#dv_classif').append(html);
                        }
                    }
                }
            }
        });
    })

    //Add Participante
    $(document).ready(function() {
    $("#butAddPartCrea").click(function() {
        var val = $("#lgpart").val();
        var lgid = $(this).attr('lgid');
        
        // Encuentra el usuario seleccionado del datalist
        var obj = $("#lgpartlist option").filter(function() {
            return this.value === val;
        });
        
        var userId;
        
        if (obj.length > 0) {
            userId = obj.attr("data-id");
        } else {
            userId = <?php echo $_SESSION['id']; ?>;
        }
        
        $.ajax({
            url: 'app/setNewPart.php',
            type: 'post',
            data: {
                userId: userId,
                lgid: lgid,
                mode: 'add'
            },
            dataType: 'json',
            success: function(response) {
                if (response['RESPONSE'] == 'SUCCESS') {
                    var html = `<div class="col-lg-4" id="${lgid}-${userId}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" readonly value="${val}">
                            <button class="btn btn-outline-danger btnDelPart" usrid="${userId}" lgid="${lgid}" type="button"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>`;
                    $("#divListaPart").append(html);
                    $("#lblPartAdd").text(Number($("#lblPartAdd").text()) + 1);
                    enableButtons();
                }
            }
        });
    });
});



    //Delete Participante
    $(document).on('click', ".btnDelPart", function() {
        let lgid = $(this).attr('lgid')
        let usrid = $(this).attr('usrid')
        console.log(lgid)
        console.log(usrid)
        $.ajax({
            url: 'app/setNewPart.php',
            type: 'post',
            data: {
                userId: usrid,
                lgid: lgid,
                mode: 'del'
            },
            dataType: 'json',
            success: function(response) {
                if (response['RESPONSE'] == 'SUCCESS') {
                    let div = $("#" + lgid + '-' + usrid)
                    div.remove()
                    $("#lblPartAdd").text(Number($("#lblPartAdd").text()) - 1)
                    enableButtons()
                }
            }
        });
    });

    function enableButtons() {
        if (Number($("#lblPartAdd").text()) >= Number($("#lblNumPart").text())) {
            $("#butAddPartCrea").attr('disabled', true)
            $("#butAddPartNoregCrea").attr('disabled', true)
        } else {
            $("#butAddPartCrea").attr('disabled', false)
            $("#butAddPartNoregCrea").attr('disabled', false)
        }
        if (Number($("#lblPartAdd").text()) == Number($("#lblNumPart").text())) {
            $("#butCreaVs").attr('disabled', false)
        } else {
            $("#butCreaVs").attr('disabled', true)
        }
    }
</script>