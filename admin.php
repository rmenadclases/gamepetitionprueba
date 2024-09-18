<?php

include_once 'templates/header.php';
if ($_SESSION['rol'] <> 'Admin') {
    header('Location: index.php');
}
?>
<title>GamePetition - Admin</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center tornBg">ADMIN</div>
<div class="container" style="max-width: 1120px;">
    <div class="row justify-content-center my-4">
        <div class="col">
            <label for="formMultImg" class="form-label"><strong>Subir imagenes</strong></label>
            <input class="form-control" type="file" id="files" multiple name="files[]">
        </div>
        <div class="col-2 d-grid gap-2 mt-auto">
            <input type="button" value="Subir" id="subirImg" class="btn btn-block btn-outline-success">
        </div>
    </div>
    <hr class="border border-danger">
    <div class="row justify-content-between my-4">
        <div class="col">
            <label class="form-label"><strong>Nombre Juego Nuevo</strong></label>
            <input class="form-control" type="text" id="nameNewGame">
        </div>
        <div class="col">
            <label class="form-label"><strong>Nombre Alternativo</strong></label>
            <input class="form-control" type="text" id="nameNewGameAlt">
        </div>
        <div class="col">
            <label class="form-label"><strong>Nombre imagen</strong></label>
            <input class="form-control" type="text" id="nameNewImgGame">
        </div>
        <div class="col-2 d-grid gap-2 mt-auto">
            <input type="button" value="Nuevo" id="newGame" class="btn btn-block btn-outline-success">
        </div>
    </div>
    <hr class="border border-danger">
    <div class="container-sm my-4">
        <table id="listGameTab" class="table table-striped table-hover table-sm nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="width: 30%">Name</th>
                    <th scope="col" style="width: 30%">Name Alt</th>
                    <th scope="col" style="width: 30%">img Name</th>
                    <th scope="col">img Error</th>
                    <th scope="col">Image</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>


<?php
var_dump($error);
include_once 'templates/footer.php';
include_once 'js/frontJs.php';
include_once 'js/adminJs.php';
?>