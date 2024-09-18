<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/GamePetition/httpdocs/vendor/autoload.php';

$connection = new mysqli("localhost", "root", "", "shnj95");
if (!$connection) {
    die('Error de Conexión: ' . mysqli_connect_errno());
}
$connection->set_charset("utf8");
