<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

//$connection = new mysqli("localhost", "7r3tmj", "Fpjv3^03", "shnj95");
$connection = new mysqli("localhost", "root", "", "shnj95");
if (!$connection) {
    die('Error de Conexión: ' . mysqli_connect_errno());
}
$connection->set_charset("utf8");