<?php

include_once 'templates/header.php';

$sqlInboxNot = "SELECT * FROM participantes 
left JOIN league on league.lgid = participantes.ptleagid
WHERE participantes.ptview = 0 and participantes.ptusrid = " . $_SESSION['id'] . " and league.lgid is not null;";
$resInboxNot = $connection->query($sqlInboxNot);

?>
<title>GamePetition - Inbox</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center perfBg" tkey="inbox"></div>
<div class="container text-center" style="max-width: 1120px;">
    <?php if ($_SESSION['logged_in'] && $_SESSION['app'] == 'GamePetition') { ?>
        <div class="h4 pb-2 mb-4 mt-4 text-success border-bottom border-success">
            Peticiones Pendientes
        </div>
        <div class="row justify-content-center mb-3 border rounded border-warning mx-3 mt-2 ligaColor">
            <div class="col-lg-2 col-sm-5 me-auto ligSubMenu fw-bold listImg">
                <img class="img-fluid" src="images/games/CALLOFDUTYWARZONE.png" />
            </div>
            <div class="col-lg-5 col-sm-5 my-auto fw-bold text-center fs-3">
                <p>Test Ximo</p>
            </div>
            <div class="col-lg-3 col-sm-5 my-auto text-center ">
                <p>Call of Duty Warzone<br>CMP 8<br>Ad: XimboX</p>
            </div>
            <div class="col-lg-2 col-sm-5 my-auto">
                <div class="input-group">
                    <button class="btn btn-outline-success" type="button"><i class="fa-solid fa-check"></i></button>
                    <button class="btn btn-outline-danger" type="button"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
        </div>

    <?php }  ?>
</div>


<?php
include_once 'templates/footer.php';
include_once 'js/inboxJs.php';

?>