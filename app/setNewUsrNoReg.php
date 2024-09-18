<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');

// Incluir configuración y autoload
require_once '../resources/config.php';

use PHPMailer\PHPMailer\PHPMailer;

$json = array();

// Configurar la conexión para usar utf8mb4
$connection->set_charset("utf8mb4");

try {
    // Preparar la consulta de inserción o actualización
    $stmt = $connection->prepare("INSERT INTO users (username, name, rol)
        VALUES (?, ?, 'NOREG') 
        ON DUPLICATE KEY UPDATE create_date = current_timestamp;");

    if (!$stmt) {
        throw new Exception($connection->error);
    }

    // Enlazar los parámetros
    $stmt->bind_param("ss", $_POST['username'], $_POST['username']);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el ID del usuario recién insertado o actualizado
        $stmtId = $connection->prepare("SELECT id FROM users WHERE username = ? AND name = ? AND rol = 'NOREG'");
        
        if (!$stmtId) {
            throw new Exception($connection->error);
        }

        // Enlazar los parámetros
        $stmtId->bind_param("ss", $_POST['username'], $_POST['username']);
        
        // Ejecutar la consulta
        $stmtId->execute();
        
        // Obtener el resultado
        $resultId = $stmtId->get_result();
        $rowId = $resultId->fetch_array(MYSQLI_ASSOC);
        
        if ($rowId) {
            $json['ID'] = $rowId['id'];
            $json['RESPONSE'] = 'SUCCESS';
        } else {
            throw new Exception("No se encontró el usuario.");
        }

        // Cerrar la segunda consulta
        $stmtId->close();
    } else {
        throw new Exception($stmt->error);
    }

    // Cerrar la primera consulta
    $stmt->close();
} catch (Exception $e) {
    // Capturar errores y preparar respuesta en JSON
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $e->getMessage();
}

// Enviar la respuesta como JSON
echo json_encode($json);
