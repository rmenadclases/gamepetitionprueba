<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

// Verificar si se reciben los datos necesarios
if (isset($_POST['lgid'], $_POST['usrid'], $_POST['numvs'], $_POST['tipo'], $_POST['valor'])) {
    $lgid = $_POST['lgid'];
    $usrid = $_POST['usrid'];
    $numvs = $_POST['numvs'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];

    // Validar que el tipo sea 'puntos' o 'marcador' para construir la consulta adecuada
    if ($tipo === 'puntos' || $tipo === 'marcador') {
        // Determinar el tipo de dato para el parámetro 'valor'
        $param_type = $tipo === 'puntos' ? 'i' : 's';

        // Consulta preparada para actualizar el campo adecuado (enpuntos o enmarcador)
        $stmt = $connection->prepare("UPDATE versus SET " . ($tipo === 'puntos' ? "enpuntos" : "enmarcador") . " = ? WHERE enlgid = ? AND enusrid = ? AND ennumvs = ?");
        $stmt->bind_param($param_type . "iii", $valor, $lgid, $usrid, $numvs);

        if ($stmt->execute()) {
            $json['RESPONSE'] = 'SUCCESS';
        } else {
            $json['RESPONSE'] = 'ERROR';
            $json['ERROR'] = $stmt->error;
        }

        $stmt->close();
    } else {
        $json['RESPONSE'] = 'ERROR';
        $json['ERROR'] = 'Tipo de campo incorrecto';
    }
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = 'Datos insuficientes';
}

// Devolver respuesta en formato JSON
echo json_encode($json);