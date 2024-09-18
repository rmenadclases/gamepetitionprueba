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

// Escapar caracteres especiales para prevenir inyecciones SQL
$lgname = mysqli_real_escape_string($connection, $_POST['lgname']);
$lggame = mysqli_real_escape_string($connection, $_POST['lggame']);
$lgnumpart = mysqli_real_escape_string($connection, $_POST['lgnumpart']);
$lgtipduel = mysqli_real_escape_string($connection, $_POST['lgtipduel']);
$lgvueltas = mysqli_real_escape_string($connection, $_POST['lgvueltas']);
$lgpriva = mysqli_real_escape_string($connection, $_POST['lgpriva']);
$lglocal = mysqli_real_escape_string($connection, $_POST['lglocal']);
$lgdescrip = mysqli_real_escape_string($connection, $_POST['lgdescrip']);
$lgmarcad = mysqli_real_escape_string($connection, $_POST['lgmarcad']);
$lgdesemp = mysqli_real_escape_string($connection, $_POST['lgdesemp']);
$lgpremio = mysqli_real_escape_string($connection, $_POST['lgpremio']);
$lgtipo = mysqli_real_escape_string($connection, $_POST['lgtipo']);

// Construir la consulta SQL
$sql = "INSERT INTO league (lgcreaid, lgname, lggame, lgnumpart, lgtipduel, lgvueltas, lgpriva, lglocal, lgdescrip, lgmarcad, lgdesemp, lgpremio, lgtipo)
    VALUES ('" . $_SESSION['id'] . "', '$lgname', '$lggame', '$lgnumpart', '$lgtipduel', '$lgvueltas', '$lgpriva', '$lglocal', '$lgdescrip', '$lgmarcad', '$lgdesemp', '$lgpremio', '$lgtipo');";

if ($connection->query($sql)) {
    $leagId = $connection->insert_id;
    if (count($_POST['participantes']) > 0) {
        foreach ($_POST['participantes'] as $value) {
            //$sqlPart = utf8_decode("INSERT INTO participantes(ptusrid, ptleagid)
            //VALUES (" . $value . ", " . $leagId . ");");

            $sqlPart = mb_convert_encoding("INSERT INTO participantes(ptusrid, ptleagid)
            VALUES (" . $value . ", " . $leagId . ");", 'ISO-8859-1');
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
