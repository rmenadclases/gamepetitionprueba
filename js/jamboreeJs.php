<script>
    let participantes = []
    let gameId = 0

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

    $("#butDetails").click(function() {
        $("#divDetails").slideToggle(500)
    })
    $("#butParticip").click(function() {
        $("#divParticip").slideToggle(500)
    })
    $("#butListDesa").click(function() {
        listCompe('DES', $(this).attr('lgtipo'), '#divListDesa')
    })
    $("#butListSol").click(function() {
        listCompe('SOL', $(this).attr('lgtipo'), '#divListSol')
    })
    $("#butListFin").click(function() {
        listCompe('FIN', $(this).attr('lgtipo'), '#divListFin')
    })
    $("#butListPeti").click(function() {
        listPeti('PET', $(this).attr('lgtipo'), '#divListPeti')
    })
    $("#butListDispo").click(function() {
        listDispo('DIS', $(this).attr('lgtipo'), '#divListDispo')
    })
    
    //Search
    $(document).ready(function() {
    // Manejar clic en el botón BUSCAR
    $("#butBuscar").click(function() {
        // Mostrar el área de búsqueda
        $("#divListBusqueda").show();
        // Poner el foco en el campo de búsqueda
        $("#searchInput").focus();
    });

    // Detectar cambios en el campo de búsqueda
    $("#searchInput").on('input', function() {
        let query = $(this).val().trim();
        if (query.length > 0) {
            // Realizar búsqueda con AJAX
            searchResults(query);
        } else {
            // Limpiar resultados si no hay texto en el campo
            $('#resultsContainer').empty();
        }
    });

    // Función para realizar la búsqueda con AJAX
    function searchResults(query) {
    $.ajax({
        url: 'app/buscar.php',  // Ruta de tu script PHP para la búsqueda
        method: 'GET',
        data: { q: query },  // Parámetros para la búsqueda (puedes añadir más según necesites)
        success: function(data) {
            displayResults(data);  // Mostrar los resultados recibidos
        },
        error: function() {
            console.error('Error fetching search results');
        }
    });
}

// Función para mostrar los resultados recibidos
function searchResults(query) {
    $.ajax({
        url: 'app/buscar.php',  // Ruta de tu script PHP para la búsqueda
        method: 'GET',
        data: { q: query },  // Parámetros para la búsqueda (puedes añadir más según necesites)
        success: function(data) {
            displayResults(data);  // Mostrar los resultados recibidos
        },
        error: function() {
            console.error('Error fetching search results');
        }
    });
}

// Función para mostrar los resultados recibidos
function displayResults(results) {
    let resultsContainer = $('#resultsContainer');
    resultsContainer.empty(); // Vacía el contenedor antes de mostrar nuevos resultados
    
    // Define el contenedor objetivo
    let target = resultsContainer;

    // Intenta parsear los resultados como JSON
    try {
        let response = JSON.parse(results);

        // Verifica si response existe y es un arreglo válido
        if (response.RESPONSE == 'SUCCESS') {
            console.log('Response SUCCESS:', response); // Check the value of response
            console.log('Leagues:', response.LEAGUES);

            // Definir valores por defecto si las variables no están definidas
            var border = typeof border !== 'undefined' ? border : 'default-border';
            var color = '#f1b70d'; 
            var subMenu = typeof subMenu !== 'undefined' ? subMenu : 'default-subMenu';

            for (var i = 0; i < response.COUNT; i++) {
                var html = `<a href="edtleague.php?id=${response.LEAGUES[i].lgid}" class="text-decoration-none">
                    <div class="row justify-content-between">
                        <div class="d-flex justify-content-center mb-3 border rounded border-warning objSkew mt-2 ${color}">
                            <div class="col-2 col-20 me-auto ${subMenu} fw-bold listImg">
                                <img class="img-fluid" src="images/games/${response.LEAGUES[i].gaimg}" />
                            </div>
                            <div class="col my-auto fw-bold text-center fs-3" style="color: ${color};">
                                <p>${response.LEAGUES[i].lgname}</p>
                            </div>
                            <div class="col-3 my-auto text-center" style="color: ${color};">
                                <p>${response.LEAGUES[i].ganame}<br>${response.LEAGUES[i].lgtipduel} ${response.LEAGUES[i].participant_count}<br>Ad: ${response.LEAGUES[i].creator_username}</p>
                            </div>
                        </div>
                    </div>
                </a>`;
                $(target).append(html);
            }
        } else {
            console.error('Response ERROR:', response);
        }
    } catch (error) {
        console.error('Error al parsear JSON:', error);
        resultsContainer.append(`<p>Error al procesar los resultados.</p>`);
    }
}






    });

    //Peti
    function listPeti(tipo, tipoCom, target) {
        $(target).empty();
        $.ajax({
            url: 'app/getPetitions.php',
            type: 'post',
            data: {
                tipo: tipo,
                tipoCom: tipoCom
            },
            dataType: 'json',
            success: function(response) {
                let color = ''
                let subMenu = ''
                let border = ''
                switch (tipoCom) {
                    case 'LIG':
                        color = 'ligaColor'
                        subMenu = 'ligSubMenu'
                        border = 'border-warning'
                        break;
                    case 'TOR':
                        color = 'tornColor'
                        subMenu = 'tornSubMenu'
                        border = 'border-danger'
                        break;
                }
                if (response['RESPONSE'] == 'SUCCESS') {
                    for (var i = 0; i < response['COUNT']; i++) {
                        var html = `<a href="edtleague.php?id=` + response['LEAGUES'][i]['lgid'] + `" class="text-decoration-none">
                            <div class="row justify-content-between">
                                <div class="d-flex justify-content-center mb-3 border rounded ` + border + ` objSkew mt-2 ` + color + `">
                                    <div class="col-2 col-20 me-auto ` + subMenu + ` fw-bold listImg">
                                        <img class="img-fluid"  src="images/games/` + response['LEAGUES'][i]['gaimg'] + `" />
                                    </div>
                                    <div class="col my-auto fw-bold text-center fs-3">
                                        <p>` + response['LEAGUES'][i]['lgname'] + `</p>
                                    </div>
                                    <div class="col-3 my-auto text-center ">
                                        <p>` + response['LEAGUES'][i]['ganame'] + `<br>` + response['LEAGUES'][i]['lgtipduel'] + ` ` + response['LEAGUES'][i]['lgnumpart'] + `<br>Ad: ` + response['LEAGUES'][i]['username'] + `</p>
                                    </div>
                                </div>
                            </div>
                        </a>`
                        $(target).append(html);
                    }
                }
            }
        });
        $(target).slideToggle(500)
    }


    function listCompe(tipo, tipoCom, target) {
        $(target).empty();
        $.ajax({
            url: 'app/getLigas.php',
            type: 'post',
            data: {
                tipo: tipo,
                tipoCom: tipoCom
            },
            dataType: 'json',
            success: function(response) {
                let color = ''
                let subMenu = ''
                let border = ''
                switch (tipoCom) {
                    case 'LIG':
                        color = 'ligaColor'
                        subMenu = 'ligSubMenu'
                        border = 'border-warning'
                        break;
                    case 'TOR':
                        color = 'tornColor'
                        subMenu = 'tornSubMenu'
                        border = 'border-danger'
                        break;
                }
                if (response['RESPONSE'] == 'SUCCESS') {
                    for (var i = 0; i < response['COUNT']; i++) {
                        var html = `<a href="edtleague.php?id=` + response['LEAGUES'][i]['lgid'] + `" class="text-decoration-none">
                            <div class="row justify-content-between">
                                <div class="d-flex justify-content-center mb-3 border rounded ` + border + ` objSkew mt-2 ` + color + `">
                                    <div class="col-2 col-20 me-auto ` + subMenu + ` fw-bold listImg">
                                        <img class="img-fluid"  src="images/games/` + response['LEAGUES'][i]['gaimg'] + `" />
                                    </div>
                                    <div class="col my-auto fw-bold text-center fs-3">
                                        <p>` + response['LEAGUES'][i]['lgname'] + `</p>
                                    </div>
                                    <div class="col-3 my-auto text-center ">
                                        <p>` + response['LEAGUES'][i]['ganame'] + `<br>` + response['LEAGUES'][i]['lgtipduel'] + ` ` + response['LEAGUES'][i]['lgnumpart'] + `<br>Ad: ` + response['LEAGUES'][i]['username'] + `</p>
                                    </div>
                                </div>
                            </div>
                        </a>`
                        $(target).append(html);
                    }
                }
            }
        });
        $(target).slideToggle(500)
    }
//Ligas DISPONIBLES:
function listDispo(tipo, tipoCom, target) {
    $(target).empty();
    $.ajax({
        url: 'app/getLigasDispo.php',
        type: 'post',
        data: {
            tipo: tipo,
            tipoCom: tipoCom
        },
        dataType: 'json',
        success: function(response) {
            let color = '';
            let subMenu = '';
            let border = '';

            switch (tipoCom) {
                case 'LIG':
                    color = 'ligaColor';
                    subMenu = 'ligSubMenu';
                    border = 'border-warning';
                    break;
                // Agrega otros casos si es necesario
                default:
                    console.error('TipoCom no reconocido:', tipoCom);
                    return; // Sal del success si tipoCom no es reconocido
            }

            if (response.RESPONSE == 'SUCCESS') {
                console.log('Response SUCCESS:', response); // Check the value of response
                console.log('Leagues:', response.LEAGUES);

                for (var i = 0; i < response.COUNT; i++) {
                    var html = `<a href="edtleague.php?id=${response.LEAGUES[i].lgid}" class="text-decoration-none">
                        <div class="row justify-content-between">
                            <div class="d-flex justify-content-center mb-3 border rounded ${border} objSkew mt-2 ${color}">
                                <div class="col-2 col-20 me-auto ${subMenu} fw-bold listImg">
                                    <img class="img-fluid" src="images/games/${response.LEAGUES[i].gaimg}" />
                                </div>
                                <div class="col my-auto fw-bold text-center fs-3">
                                    <p>${response.LEAGUES[i].lgname}</p>
                                </div>
                                <div class="col-3 my-auto text-center">
                                <p>` + response['LEAGUES'][i]['ganame'] + `<br>` + response['LEAGUES'][i]['lgtipduel'] + ` ` + response['LEAGUES'][i]['participant_count'] + `<br>Ad: ` + response['LEAGUES'][i]['creator_username'] + `</p>
                                </div>
                            </div>
                        </div>
                    </a>`;
                    $(target).append(html);
                }
            } else {
                console.error('Response ERROR:', response);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Ajax Error:', textStatus, errorThrown);
            console.error('Response Text:', jqXHR.responseText);
        }
    });
    $(target).slideToggle(500);
}


    //Add Participante
    $("#butAddPart").click(function() {
        console.log('Entro')
        var val = $("#lgpart").val();
        var obj = $("#lgpartlist").find("option[value='" + val + "']");
        if (obj != null && obj.length > 0) {
            var userId = obj.attr("data-id");

            if (participantes.indexOf(userId) < 0) {
                participantes.push(userId)

                var html = `
                <div class="d-flex justify-content-center mb-3 partAdded">
                    <div class="col-1 me-auto ligSubMenu fw-bold">
                        <p id="posPart" class="posPart">` + ($('.partAdded').length + 1) + ` .</p>
                    </div>
                    <div class="col my-auto fw-bold text-center">
                        <p id="namePart">` + val + `</p>
                    </div>
                    <div class="col-1 ms-auto">
                        <button class="btn btn-outline-danger delPart" data-id="` + userId + `" type="button" id="butDelPart"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                `;
                $('#dipPartAdded').append(html);
                $("#lgpart").val('')
            }
        }
    })
    $("#butAddPartNoreg").click(function() {
        var val = $("#lgpartnoreg").val();
        $.ajax({
            url: 'app/setNewUsrNoReg.php',
            type: 'post',
            data: {
                username: val,
            },
            dataType: 'json',
            success: function(response) {
                if (response['RESPONSE'] == 'SUCCESS') {
                    if (response['ID'] > 0) {
                        if (participantes.indexOf(response['ID'] ) < 0) {
                            participantes.push(response['ID'] )

                            var html = `
                            <div class="d-flex justify-content-center mb-3 partAdded">
                                <div class="col-1 me-auto ligSubMenu fw-bold">
                                    <p id="posPart" class="posPart">` + ($('.partAdded').length + 1) + ` .</p>
                                </div>
                                <div class="col my-auto fw-bold text-center">
                                    <p id="namePart">` + val + `</p>
                                </div>
                                <div class="col-1 ms-auto">
                                    <button class="btn btn-outline-danger delPart" data-id="` + response['ID']  + `" type="button" id="butDelPart"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            `;
                            $('#dipPartAdded').append(html);
                            $("#lgpart").val('')
                        }
                    }
                }
                if (response['RESPONSE'] == 'ERROR') {

                }
            }
        });
    })
    //Del Participante

    $(document).on('click', ".delPart", function() {
        userId = $(this).attr("data-id")
        participantes.splice(participantes.indexOf(userId), 1)
        $(this).closest('.partAdded').remove();
        reorderPart()
    });

    //Reordenar Particip
    function reorderPart() {
        let count = 1
        $(".posPart").each(function() {
            $(this).text(count + ' .')
            count++
        });
    }

    //Crear Liga

    $("#butCreaJamboree").click(function() {
        if (validLeag()) {
            $.ajax({
                url: 'app/setNewLeag.php',
                type: 'post',
                data: {
                    lgname: $("#lgname").val(),
                    lggame: $("#lggameSel").val(),
                    lgnumpart: $("#lgnumpart").val(),
                    lgtipduel: $("#lgtipduel").val(),
                    lgvueltas: $("#lgvueltas").val(),
                    lglocal: $("#lglocal").val(),
                    lgpriva: $("#lgpriva").val(),
                    lgdescrip: $("#lgdescrip").val(),
                    lgmarcad: $("#lgmarcad").val(),
                    lgdesemp: $("#lgdesemp").val(),
                    lgpremio: $("#lgpremio").val(),
                    lgtipo: $(this).attr('lgtipo'),
                    participantes: participantes,
                },
                dataType: 'json',
                success: function(response) {
                    if (response['RESPONSE'] == 'SUCCESS') {
                        console.log('ENTRO')
                        borrarCamposCreaLega()
                        $("#successNewLeague").show();
                    }
                    if (response['RESPONSE'] == 'ERROR') {
                        $("#alertNewLeague").show();
                        $("#" + response['ERROR']).show()
                    }
                }
            });
        }
    });

    //Crear Peticion

    /*$("#butCreaPeti").click(function() {
        if (validLeag()) {
            $.ajax({
                url: 'app/setNewPeti.php',
                type: 'post',
                data: {
                    lgname: $("#lgname").val(),
                    lggame: $("#lggameSel").val(),
                    lgnumpart: $("#lgnumpart").val(),
                    lgtipduel: $("#lgtipduel").val(),
                    lgvueltas: $("#lgvueltas").val(),
                    lglocal: $("#lglocal").val(),
                    lgpriva: $("#lgpriva").val(),
                    lgdescrip: $("#lgdescrip").val(),
                    lgmarcad: $("#lgmarcad").val(),
                    lgdesemp: $("#lgdesemp").val(),
                    lgpremio: $("#lgpremio").val(),
                    lgtipo: $(this).attr('lgtipo'),
                    participantes: participantes,
                },
                dataType: 'json',
                success: function(response) {
                    if (response['RESPONSE'] == 'SUCCESS') {
                        console.log('ENTRO')
                        borrarCamposCreaLega()
                        $("#successNewLeague").show();
                    }
                    if (response['RESPONSE'] == 'ERROR') {
                        $("#alertNewLeague").show();
                        $("#" + response['ERROR']).show()
                    }
                }
            });
        }
    })*/

    function borrarCamposCreaLega() {
        $("#lgname").val('')
        $("#lgimg").attr("src", 'images/gamepetition.png');
        $("#lggameSel").val('')
        $("#lgnumpart").val('')
        $("#lgtipduel").val('')
        $("#lgvueltas").val('')
        $("#lgdescrip").val('')
        $("#lgmarcad").val('')
        $("#lgdesemp").val('')
        $("#lgpremio").val('')
        participantes = []
        $('#dipPartAdded').empty()
        $("#dv_crea_league").slideToggle(500)
    }

    function borrarCamposCreaPeti() {
        $("#lgnameP").val('')
        $("#lgimgP").attr("src", 'images/gamepetition.png');
        $("#lggameSel2").val('')
        $("#lgnumpartP").val('')
        $("#lgtipduelP").val('')
        $("#lgvueltasP").val('')
        $("#lgdescrip").val('')
        $("#lgmarcadP").val('')
        $("#lgdesempP").val('')
        $("#lgpremioP").val('')
        participantes = []
        $('#dipPartAddedP').empty()
        $("#dv_crea_peti").slideToggle(500)
    }

    function validLeag() {
        valido = true
        return valido
    }

    //Imagenes Juegos
    new TomSelect("#lggameSel", {
        sortField: {
            field: "text",
            direction: "asc"
        },
        searchField: ['text', 'alt', 'src'],
        onChange: function() {
            chgImg2($("#lggameSel").val())
        },
    });

    new TomSelect("#lggameSel2", {
        sortField: {
            field: "text",
            direction: "asc"
        },
        searchField: ['text', 'alt', 'src'],
        onChange: function() {
            chgImg2($("#lggameSel2").val())
        },
    });


    function chgImg2(gameid) {
        $.ajax({
            url: 'app/getGameImg.php',
            type: 'post',
            data: {
                gameid: gameid,
            },
            dataType: 'json',
            success: function(response) {
                if (response['RESPONSE'] == 'SUCCESS') {
                    $("#lgimg").attr("src", 'images/games/' + response['IMG']);
                }
                if (response['RESPONSE'] == 'ERROR') {
                    $("#lgimg").attr("src", 'images/gamepetition.png');
                }
            }
        });
    }

    //Modo versus
    $("#lgnumpart").change(function() {
    if ($("#lgnumpart").val() > 0) {
        $("#lgtipduel").prop('disabled', false);
        $('#lgtipduel').empty();
        $('#lgtipduel').append('<option tkey="select"></option>');

        // 1 Vs 1
        if ($("#lgnumpart").val() > 1) {
            $('#lgtipduel').append('<option value="1VS">Liga Simple (1 Vs 1)</option>');
        }

        // 3 Vs
        if ($("#lgnumpart").val() == 4 || $("#lgnumpart").val() == 6 || $("#lgnumpart").val() == 7) {
            $('#lgtipduel').append('<option value="3VS">3 Vs</option>');
        }

        // 4 Vs
        if ($("#lgnumpart").val() == 7 || $("#lgnumpart").val() == 8) {
            $('#lgtipduel').append('<option value="4VS">4 Vs</option>');
        }

        // Campeón de la pista
        if ($("#lgnumpart").val() > 1) {
            $('#lgtipduel').append('<option value="CMP">Campeón de la pista</option>');
        }
    }
});

</script>