<?php
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

use PHPMailer\PHPMailer\PHPMailer;

//print_r($_SESSION['id']);

$json = array();

// Escapar caracteres especiales para prevenir inyecciones SQL
$lgid = mysqli_real_escape_string($connection, $_POST['leagueId']);

// Construir la consulta SQL
$sql = "UPDATE league SET lgtipo = 'LIG', lgcreaid = '" . $_SESSION['id'] . "' WHERE lgid = '" . $lgid . "'";

if ($connection->query($sql)) {
    if (count($_POST['participantes']) > 0) {
        foreach ($_POST['participantes'] as $value) {
            //$sqlPart = utf8_decode("INSERT INTO participantes(ptusrid, ptleagid)
            //VALUES (" . $value . ", " . $lgid . ");");

            $sqlPart = mb_convert_encoding("INSERT INTO participantes(ptusrid, ptleagid)
            VALUES (" . $value . ", " . $lgid . ");", 'ISO-8859-1');
            $connection->query($sqlPart);
        }
    }
    $json['ID'] = $lgid;
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
}

echo json_encode($json);