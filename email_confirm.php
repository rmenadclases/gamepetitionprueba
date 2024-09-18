<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include_once 'templates/header.php';
$valido = false;
$sqlCompUser = "select * from users where upper(email) = upper('" . $_GET['e'] . "') and token = '" . $_GET['t'] . "' and confirmation is null";
$resCompUser = $connection->query($sqlCompUser);
$rowCompUser = $resCompUser->fetch_array(MYSQLI_ASSOC);

if ($resCompUser->num_rows == 1) {
    $sqlConfirm = "update users set confirmation = current_timestamp where upper(email) = upper('" . $_GET['e'] . "') and token = '" . $_GET['t'] . "'";
    $resConfirm = $connection->query($sqlConfirm);
    $valido = true;
}

?>
<title>Game Petition - Liga</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center perfBg" tkey="email_conf"></div>
<div class="container pt-4" style="max-width: 1120px;">
    <?php if ($valido) { ?>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div class="text-center">
                    <img class="mt-4" src="/images/image-3.png" width="70px">
                    <div class="mt-4" tkey="msg_confirm_email_ok"></div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div class="text-center">
                    <i class="mt-4 fas fa-times-circle fa-5x text-danger"></i>
                    <div class="mt-4" tkey="msg_confirm_email_error"></div>
                </div>
            </div>
        </div>
    <?php }  ?>
</div>


<?php
include_once 'templates/footer.php';
include_once 'js/frontJs.php';
?>