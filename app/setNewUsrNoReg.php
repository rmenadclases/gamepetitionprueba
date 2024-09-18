<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

use PHPMailer\PHPMailer\PHPMailer;

$json = array();

//$sql = utf8_decode("INSERT INTO users(username, name, rol)
//    VALUES ('" . $_POST['username'] . "', '" . $_POST['username'] . "', 'NOREG') ON DUPLICATE KEY UPDATE create_date = current_timestamp;");

$sql = mb_convert_encoding("INSERT INTO users(username, name, rol)
    VALUES ('" . $_POST['username'] . "', '" . $_POST['username'] . "', 'NOREG') ON DUPLICATE KEY UPDATE create_date = current_timestamp;", 'ISO-8859-1');
if ($connection->query($sql)) {
    $sqlId = "SELECT id from users where username = '" . $_POST['username'] . "' and name = '" . $_POST['username'] . "' and rol = 'NOREG'";
    $resId = $connection->query($sqlId);
    $rowId = $resId->fetch_array(MYSQLI_ASSOC);
    $json['ID'] = $rowId['id'];
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
}


echo json_encode($json);
