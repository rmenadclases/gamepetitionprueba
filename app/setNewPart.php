<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

$json = array();

if ($_POST['mode'] == 'add') {
    $userId = $_POST['userId'];
    $lgid = $_POST['lgid'];
    
    // Verificar si el usuario ya está registrado en la liga
    $sqlCheckUser = "SELECT COUNT(*) AS count FROM participantes WHERE ptusrid = ? AND ptleagid = ?";
    $stmt = $connection->prepare($sqlCheckUser);
    $stmt->bind_param("ii", $userId, $lgid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        // Usuario ya está registrado, retornar error
        $json['RESPONSE'] = 'ERROR';
        $json['MESSAGE'] = 'El usuario ya está registrado en esta liga.';
    } else {
        // Insertar participante
        $sqlInsert = "INSERT INTO participantes (ptusrid, ptleagid) VALUES (?, ?)";
        $stmtInsert = $connection->prepare($sqlInsert);
        $stmtInsert->bind_param("ii", $userId, $lgid);
        
        if ($stmtInsert->execute()) {
            $json['RESPONSE'] = 'SUCCESS';
            $json['MESSAGE'] = 'Usuario añadido correctamente a la liga.';
        } else {
            $json['RESPONSE'] = 'ERROR';
            $json['MESSAGE'] = 'Error al añadir usuario a la liga.';
        }
    }
}

if ($_POST['mode'] == 'del') {
    $userId = $_POST['userId'];
    $lgid = $_POST['lgid'];
    
    // Eliminar participante
    $sqlDelete = "DELETE FROM participantes WHERE ptusrid = ? AND ptleagid = ?";
    $stmtDelete = $connection->prepare($sqlDelete);
    $stmtDelete->bind_param("ii", $userId, $lgid);
    
    if ($stmtDelete->execute()) {
        $json['RESPONSE'] = 'SUCCESS';
        $json['MESSAGE'] = 'Usuario eliminado correctamente de la liga.';
    } else {
        $json['RESPONSE'] = 'ERROR';
        $json['MESSAGE'] = 'Error al eliminar usuario de la liga.';
    }
}

echo json_encode($json);