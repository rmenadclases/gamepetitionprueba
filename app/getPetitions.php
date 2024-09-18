<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';


/* $sql = utf8_decode("select gaimg, lgname, ganame, lgtipduel, lgnumpart, username, lgid 
from participantes 
left JOIN league on lgid = ptleagid 
LEFT JOIN games on games.gaid = league.lggame 
left join users on league.lgcreaid = users.id 
where participantes.ptusrid = " . $_SESSION['id'] . " $where;");

if ($result = $connection->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $json['LEAGUES'][] = $row;
    }
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
} */

$sql = utf8_decode("select gaimg, lgname, ganame, lgtipduel, lgnumpart, username, lgid 
from petitions 
LEFT JOIN games on games.gaid = petitions.lggame 
left join users on petitions.lgcreaid = users.id 
where lgcreaid = " . $_SESSION['id'] . "
union all 
select gaimg, lgname, ganame, lgtipduel, lgnumpart, username, lgid 
from participantes
lef join petitions on petitions.lgid = ptleagid
LEFT JOIN games on games.gaid = petitions.lggame 
left join users on petitions.lgcreaid = users.id 
where ptusrid = " . $_SESSION['id'] . " and lgcreaid <> " . $_SESSION['id'] . "
;");

if ($result = $connection->query($sql)) {
    $json['COUNT'] = $result->num_rows;
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        /* $row = array_map('utf8_encode', $row); */
        $json['LEAGUES'][] = $row;
    }
    $json['RESPONSE'] = 'SUCCESS';
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
    $json['SQL'] = $sql;
}




echo json_encode($json);
