<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

$json = array();

// Check if search query is set
$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

// Prepare the SQL query with a search condition
/*$sql = utf8_decode("
    SELECT l.*, COALESCE(p.participant_count, 0) AS participant_count, g.ganame, g.gaimg, u.username AS creator_username, u.email AS creator_email
    FROM league l
    LEFT JOIN (
        SELECT ptleagid, COUNT(*) AS participant_count
        FROM participantes
        GROUP BY ptleagid
    ) p ON l.lgid = p.ptleagid
    INNER JOIN games g ON l.lggame = g.gaid
    INNER JOIN users u ON l.lgcreaid = u.id
      AND (g.ganame LIKE '%" . $connection->real_escape_string($searchQuery) . "%'
           OR l.lgname LIKE '%" . $connection->real_escape_string($searchQuery) . "%')
");*/

$sql = mb_convert_encoding("
    SELECT l.*, COALESCE(p.participant_count, 0) AS participant_count, g.ganame, g.gaimg, u.username AS creator_username, u.email AS creator_email
    FROM league l
    LEFT JOIN (
        SELECT ptleagid, COUNT(*) AS participant_count
        FROM participantes
        GROUP BY ptleagid
    ) p ON l.lgid = p.ptleagid
    INNER JOIN games g ON l.lggame = g.gaid
    INNER JOIN users u ON l.lgcreaid = u.id
      AND (g.ganame LIKE '%" . $connection->real_escape_string($searchQuery) . "%'
           OR l.lgname LIKE '%" . $connection->real_escape_string($searchQuery) . "%')
", 'ISO-8859-1');

if ($result = $connection->query($sql)) {
    $json['COUNT'] = $result->num_rows;
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        // Asegúrate de convertir las cadenas a UTF-8 si es necesario
        // Ejemplo: $row = array_map('utf8_encode', $row);
        $json['LEAGUES'][] = $row;
    }
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
    $json['SQL'] = $sql;
}

echo json_encode($json);
