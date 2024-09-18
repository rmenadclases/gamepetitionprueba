<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

use PHPMailer\PHPMailer\PHPMailer;

$json = array();

$sqlCompUser = "select * from  users where upper(username) = upper('" . $_POST['username'] . "') or upper(email) = upper('" . $_POST['email'] . "')";
$resCompUser = $connection->query($sqlCompUser);
$rowCompUser = $resCompUser->fetch_array(MYSQLI_ASSOC);
if ($resCompUser->num_rows > 0) {
    $json['SQL'] = $sqlCompUser;
    if (strtoupper($rowCompUser['email']) == strtoupper($_POST['email'])) {
        $json['RESPONSE'] = 'ERROR';
        $json['ERROR'] = 'email_registered';
    } else {
        if (strtoupper($rowCompUser['username']) == strtoupper($_POST['username'])) {
            $json['RESPONSE'] = 'ERROR';
            $json['ERROR'] = 'username_registered';
        }
    }
} else {
    $token = md5(date("Y-m-d h:i:s"));
    $email = $_POST['email'];
    //$sql = utf8_decode("INSERT INTO users(username, name, email, pass, address, phone, news, token)
    //VALUES ('" . $_POST['username'] . "', '" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . md5($_POST['pass']) . "', '" . $_POST['domicilio'] . "', '" . $_POST['telefono'] . "', " . ($_POST['newsCheck'] == 'true' ? 'current_date' : 'null') . ", '$token');");

    $sql = mb_convert_encoding("INSERT INTO users(username, name, email, pass, address, phone, news, token)
    VALUES ('" . $_POST['username'] . "', '" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . md5($_POST['pass']) . "', '" . $_POST['domicilio'] . "', '" . $_POST['telefono'] . "', " . ($_POST['newsCheck'] == 'true' ? 'current_date' : 'null') . ", '$token');", 'ISO-8859-1');
    include_once '../resources/body_confirm_email.php';
    try {
        $mail = new PHPMailer;
        $mail->isSMTP();
        /* $mail->SMTPDebug = 3; */
        $mail->CharSet  = 'UTF-8';
        $mail->Host = 'localhost';
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPAuth = true;
        $mail->Username = 'info@thegamepetition.com';
        $mail->Password = 'Mk@c5f77';
        $mail->setFrom('info@thegamepetition.com', 'GamePetition');
        $mail->AddAddress($_POST['email']);
        $mail->IsHTML(true);
        $mail->Subject = 'Confirmation Email - DO NOT REPLY';
        $mail->Body = $body;

        if (!$mail->Send()) {
            throw new Exception($mail->ErrorInfo);
        } else {
            $json['MSG'] = 'SUCCESS';
        }
    } catch (Exception $ex) {
        $error = $ex;
    }

    if ($connection->query($sql)) {
        $json['RESPONSE'] = 'SUCCESS';
    } else {
        $json['RESPONSE'] = 'ERROR';
        $json['ERROR'] = $connection->error;
    }
}

echo json_encode($json);
