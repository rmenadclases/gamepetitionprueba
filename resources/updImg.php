<?php

ob_start();
session_start();

$json = array();

$countfiles = count($_FILES['files']['name']);

if ($_SESSION['rol'] == 'Admin') {
    $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . "/images/games/";
    # si hay algun archivo que subir
    for ($index = 0; $index < $countfiles; $index++) {
        if ($_FILES["files"]["name"]) {
            # si exsite la carpeta o se ha creado
            if (file_exists($carpetaDestino) || @mkdir($carpetaDestino)) {
                $origen = $_FILES["files"]["tmp_name"][$index];
                $destino = $carpetaDestino . $_FILES["files"]["name"][$index];
                # movemos el archivo
                if (@move_uploaded_file($origen, $destino)) {
                    $json['RESPONSE'][$index] = 'SUCCESS';
                } else {
                    $json['RESPONSE'][$index] = 'ERROR';
                    $json['ERROR'][$index] .= "No se ha podido mover el archivo: " . $_FILES["files"]["name"][$index];
                }
            } else {
                $json['RESPONSE'][$index] = 'ERROR';
                $json['ERROR'][$index] .= "No se ha podido crear la carpeta: " . $carpetaDestino;
            }
        } else {
            $json['RESPONSE'][$index] = 'ERROR';
            $json['ERROR'][$index] .= "$carpetaDestino  Esperando para subir documentos" . $_FILES["files"]["name"][$index];
        }
    }
}

echo json_encode($json);
