<?php
ob_start();
session_start();
//error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING);
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/config.php";

$json = array();
if ($_SESSION['rol'] == 'Admin') {
    //Actualizaciones tabla
    if ($_POST['tipo'] == 'update') {
        if ($_POST['id'] <> '') {

            $_POST['valor'] = $connection->real_escape_string($_POST['valor']);

            $sql = "UPDATE games set " . $_POST['field'] . " =  '" . $_POST['valor'] . "' where gaid = " . $_POST['id'];
            if (!$connection->query($sql)) {
                $json['SQL'] = $sql;
                $json['ERROR'] = $connection->error;
            } else {
                $json[] = true;
                $json[] = $sql;
            }
        }
    }
    if ($_POST['tipo'] == 'new') {

        $_POST['name'] = $connection->real_escape_string($_POST['name']);
        $_POST['alt'] = $connection->real_escape_string($_POST['alt']);

        $sql = "INSERT INTO games (ganame, ganamealt, gaimg) VALUES ('" . $_POST['name'] . "', '" . $_POST['alt'] . "', '" . $_POST['img'] . "')";
        if (!$connection->query($sql)) {
            $json['SQL'] = $sql;
            $json['ERROR'] = $connection->error;
        } else {
            $json[] = true;
            $json[] = $sql;
        }
    }

    if ($_POST['tipo'] == 'delete') {
        $sql = "DELETE from games where gaid = " . $_POST['id'];
        if (!$connection->query($sql)) {
            $json['SQL'] = $sql;
            $json['ERROR'] = $connection->error;
        } else {
            $json[] = true;
            $json[] = $sql;
        }
    }
} else {
    $json['ERROR'] = 'SESION';
}

echo json_encode($json);
