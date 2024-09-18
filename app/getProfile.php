<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

$json = array();

if ($_POST['id'] == 0) {
    $_POST['id'] = $_SESSION['id'];
}

$sql = "select * from users where id = " . $_POST['id'] . ";";

if ($result = $connection->query($sql)) {
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $json['AVATAR'] = 'images/users/' . $row['avatar'];
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
}




echo json_encode($json);
