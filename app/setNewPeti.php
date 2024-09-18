<?php
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

use PHPMailer\PHPMailer\PHPMailer;

$json = array();

$sql = "INSERT INTO petitions(lgcreaid, lgname, lggame, lgnumpart, lgtipduel, lgvueltas, lgpriva, lglocal, lgdescrip, lgmarcad, lgdesemp, lgpremio, lgtipo)
    VALUES (" . $_SESSION['id'] . ", '" . $_POST['lgname'] . "', '" . $_POST['lggame'] . "', '" . $_POST['lgnumpart'] . "', '" . $_POST['lgtipduel'] . "', '" . $_POST['lgvueltas'] . "', '" . $_POST['lgpriva'] . "', '" . $_POST['lglocal'] . "', '" . $_POST['lgdescrip'] . "', '" . $_POST['lgmarcad'] . "', '" . $_POST['lgdesemp'] . "', '" . $_POST['lgpremio'] . "', '" . $_POST['lgtipo'] . "');";

if ($connection->query($sql)) {
    $leagId = $connection->insert_id;
    if (count($_POST['participantes']) > 0) {
        foreach ($_POST['participantes'] as $value) {
            $sqlPart = utf8_decode("INSERT INTO participantes(ptusrid, ptleagid)
            VALUES (" . $value . ", " . $leagId . ");");
            $connection->query($sqlPart);
        }
    }
    $json['ID'] = $leagId;
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
}


echo json_encode($json);
