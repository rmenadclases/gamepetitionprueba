<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';


$json = array();
if ($_POST['tipo'] == 'END') {
    $sql = "UPDATE league set lgend = 1 where lgid = " . $_POST['leagueId'] . ";";

    if ($connection->query($sql)) {
        $json['RESPONSE'] = 'SUCCESS';
    } else {
        $json['RESPONSE'] = 'ERROR';
        $json['ERROR'] = $connection->error;
    }
}

echo json_encode($json);
