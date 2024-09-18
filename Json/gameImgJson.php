<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/config.php";


if ($_SESSION['rol'] == 'Admin') {
    $connection->set_charset("utf8");
    $sqlGames = "select * from games order by gaid";
    $resGames = $connection->query($sqlGames);
    while ($rowGames = $resGames->fetch_array(MYSQLI_ASSOC)) {
        
        $rowGames['IMGEXIST'] = (file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/games/' . $rowGames['gaimg']) && $rowGames['gaimg'] != '' ? '' : 'X');
        /* $rowGames['IMG'] = '<img src="images/games/' . $rowGames['gaimg'] . '" class="img-thumbnail">'; */
        $img = "<img src='images/games/" . $rowGames['gaimg'] . "' class='img-thumbnail'>";
        $rowGames['IMG'] = '<button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-html="true" title="' . $img . '">Preview</button>
        ';
        $rowGames['ganame'] = '<input class="form-control form-control-sm updImg" type="text" id="' . $rowGames['gaid'] . '" field="ganame" value="' . $rowGames['ganame'] . '">';
        $rowGames['ganamealt'] = '<input class="form-control form-control-sm updImg" type="text" id="' . $rowGames['gaid'] . '" field="ganamealt" value="' . $rowGames['ganamealt'] . '">';
        $rowGames['gaimg'] = '<input class="form-control form-control-sm updImg" type="text" id="' . $rowGames['gaid'] . '" field="gaimg" value="' . $rowGames['gaimg'] . '">';
        
        $rowGames['DEL'] = '<button type="button" class="btn btn-outline-danger delImg" id="' . $rowGames['gaid'] . '"><i class="fas fa-trash-alt"></i></button>
        ';

        $arreglo["data"][] = $rowGames;
    }
    if (count($arreglo) > 0) {
        echo json_encode($arreglo);
    } else {
        echo '{"data": []}';
    }
} else {
    echo '{"data": []}';
}
