<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

$json = array();

if ($_POST['gameid'] > 0) {
    //$sql = utf8_decode("select * from games where gaid = " . $_POST['gameid'] . ";");
    $sql = mb_convert_encoding("select * from games where gaid = " . $_POST['gameid'] . ";", 'ISO-8859-1');

    if ($result = $connection->query($sql)) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $json['IMG'] = $row['gaimg'];
        $json['RESPONSE'] = 'SUCCESS';
    } else {
        $json['RESPONSE'] = 'ERROR';
        $json['ERROR'] = $connection->error;
    }
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = 'NO GAME SELECTED';
}



echo json_encode($json);
