<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

$json = array();

$sql = "select username, sum(enpuntos) as puntos
from versus
left join users on id = enusrid
where enlgid = " . $_POST['leagueId'] . "
GROUP by enusrid
ORDER by 2 desc, 1 asc;";


if ($result = $connection->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $json['CLAS'][] = $row;
    }
    $json['ROW_CNT'] = $result->num_rows;
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
}




echo json_encode($json);
