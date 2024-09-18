<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

$json = array();
//$sql = utf8_decode("UPDATE versusTor set vspuntos = " . $_POST['puntos'] . " where vsidtor = " . $_POST['lgid'] . " and vsidusr = " . $_POST['usrid'] . " and vsnumvs = " . $_POST['numvs'] . ";");
$sql = mb_convert_encoding("UPDATE versusTor set vspuntos = " . $_POST['puntos'] . " where vsidtor = " . $_POST['lgid'] . " and vsidusr = " . $_POST['usrid'] . " and vsnumvs = " . $_POST['numvs'] . ";", 'ISO-8859-1');

if ($connection->query($sql)) {
    $sqlVs = "SELECT vspuntos, vsidusr, username FROM versusTor LEFT JOIN users on users.id = vsidusr WHERE vsidtor = " . $_POST['lgid'] . " and vsnumvs = " . $_POST['numvs'] . "; ";
    $resVs = $connection->query($sqlVs);
    $puntos = array();
    while ($rowVs = $resVs->fetch_array(MYSQLI_ASSOC)) {
        $puntos[] = $rowVs;
    }
    switch (true) {
        case $puntos[0]['vspuntos'] > $puntos[1]['vspuntos']:
            $winner = $puntos[0];
            $winBool = true;
            break;
        case $puntos[1]['vspuntos'] > $puntos[0]['vspuntos']:
            $winner = $puntos[1];
            $winBool = true;
            break;
        default:
            $winBool = false;
            break;
    }
    //Update
    if ($winBool) {
        $updVs = "UPDATE versusTor set vsidusr = " . $winner['vsidusr'] . " where vsidtor = " . $_POST['lgid'] . " and vswinvs = " . $_POST['numvs'] . ";";
        $nameWin = $winner['username'];
        $idWin = $winner['vsidusr'];
    } else {
        $updVs = "UPDATE versusTor set vsidusr = 0 where vsidtor = " . $_POST['lgid'] . " and vswinvs = " . $_POST['numvs'] . ";";
        $nameWin = 'Winner ' . $_POST['numvs'];
        $idWin = 0;
    }
    if ($connection->query($updVs)) {
        $json['USRNAME'] = $nameWin;
        $json['IDUSRW'] = $idWin;
        $json['RESPONSE'] = 'SUCCESS';
    } else {
        $json['RESPONSE'] = 'ERROR2';
        $json['ERROR'] = $connection->error;
    }
} else {
    $json['RESPONSE'] = 'ERROR';
    $json['ERROR'] = $connection->error;
}


echo json_encode($json);
