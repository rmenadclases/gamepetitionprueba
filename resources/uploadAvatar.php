<?php
ob_start();
session_start();
//error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING);
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/config.php";

$dir = $_SERVER['DOCUMENT_ROOT'] . "/images/users/";
$json = array();
if ($_SESSION['logged_in']) {
    $filename = $_FILES['file']['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $json['EXT'] = $ext;
    if ($ext == 'jpg' || $ext == 'png') {
        $location =  $dir . $_SESSION['id'] . '.' . $ext;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            $sql = "update users set avatar = '" . $_SESSION['id'] . '.' . $ext . "' where id = " . $_SESSION['id'];
            $res = $connection->query($sql);
            $json['STATUS'] = 'OK';
        } else {
            $json['RESPONSE'] = 'ERROR';
            $json['ERROR'] = 'No se ha podido subir la tarifa.';
        }
    } else {
        $json['RESPONSE'] = 'ERROR';
        $json['ERROR'] = 'Extension no permitida';
    }
} else {
    $json['ERROR'] = 'SESION';
}

echo json_encode($json);
