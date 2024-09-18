<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $.fn.dataTable.ext.order['dom-text'] = function(settings, col) {
        return this.api().column(col, {
            order: 'index'
        }).nodes().map(function(td, i) {
            return $('input', td).val();
        });
    };
    var listGameTab = $('#listGameTab').DataTable({
        columnDefs: [{
            targets: [1, 2, 3],
            orderDataType: "dom-text",
            type: "text"
        }],
        ajax: {
            url: "Json/gameImgJson.php",
            type: "post"
        },
        order: [
            [0, 'asc']
        ],
        processing: true,
        columns: [{
            "data": "gaid"
        }, {
            "data": "ganame"
        }, {
            "data": "ganamealt"
        }, {
            "data": "gaimg"
        }, {
            "data": "IMGEXIST"
        }, {
            "data": "IMG"
        }, {
            "data": "DEL"
        }],
        "drawCallback": function(settings) {
            $(function() {
                $('[data-bs-toggle="tooltip"]').tooltip()
            })
            $(".updImg").change(function() {
                $.ajax({
                    url: 'resources/setImgGame.php',
                    type: 'post',
                    data: {
                        tipo: 'update',
                        field: $(this).attr('field'),
                        id: $(this).attr('id'),
                        valor: $(this).val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response["ERROR"] === 'SESION') {
                            window.location.href = '/logout.php'
                        } else {
                            listGameTab.ajax.reload();
                        }
                    }
                });
            });
            $(".delImg").click(function() {
                $.ajax({
                    url: 'resources/setImgGame.php',
                    type: 'post',
                    data: {
                        tipo: 'delete',
                        id: $(this).attr('id')
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response["ERROR"] === 'SESION') {
                            window.location.href = '/logout.php'
                        } else {
                            listGameTab.ajax.reload();
                        }
                    }
                });
            });
        }
    });

    $("#subirImg").click(function() {
        var fd = new FormData();
        var totalfiles = document.getElementById('files').files.length;
        for (var index = 0; index < totalfiles; index++) {
            fd.append("files[]", document.getElementById('files').files[index]);
        }
        $.ajax({
            url: 'resources/updImg.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response["ERROR"] === 'SESION') {
                    window.location.href = '/logout.php'
                } else {
                    listGameTab.ajax.reload();
                }
            },
        });
    });

    $("#newGame").click(function() {
        $.ajax({
            url: 'resources/setImgGame.php',
            type: 'post',
            data: {
                tipo: 'new',
                name: $("#nameNewGame").val(),
                alt: $("#nameNewGameAlt").val(),
                img: $("#nameNewImgGame").val()
            },
            dataType: 'json',
            success: function(response) {
                if (response["ERROR"] === 'SESION') {
                    window.location.href = '/logout.php'
                } else {
                    listGameTab.ajax.reload();
                }
            }
        });
    });
</script>