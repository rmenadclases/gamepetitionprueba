<?php
include_once 'templates/header.php';
?>
<title>GamePetition - Home</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center" id="bannerCross"></div>
<div class="justify-content-center fontGP py-3 bannerCross text-center ligaBg" id="bannerCrossLiga" tkey="liga" style="display: none;">LIGA</div>
<div class="justify-content-center fontGP py-3 bannerCross text-center compBg" id="bannerCrossComp" tkey="comp" style="display: none;">COMPETICIÓN</div>
<div class="justify-content-center fontGP py-3 bannerCross text-center tornBg" id="bannerCrossTorn" tkey="torn" style="display: none;">TORNEO</div>
<div class="justify-content-center fontGP py-3 bannerCross text-center perfBg" id="bannerCrossPerf" tkey="perf" style="display: none;">PERFIL</div>
<div>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="square squareBg">
                <div class="content">
                    <img class="mx-auto d-block imgCross" src="/images/liga.png" id="LIGA">
                    <div class="d-flex justify-content-between">
                        <img class="imgCross ms-4" src="/images/competicion.png" id="COMPETICION">
                        <img class="imgCross me-4" src="/images/torneo.png" id="TORNEO">
                    </div>
                    <img class="mx-auto mt-5 d-block imgCross" src="/images/perfil.png" id="PERFIL">
                </div>
            </div>
        </div>
    </div>

<!-- Logos Jamboree y PlayTogether-->
    <div class="content d-flex justify-content-between align-items-center" style="position: absolute; bottom: 80px; width: 100%; z-index: 1000;">
        <img class="d-block ms-5" src="/images/PLAY TOGETHER AGAIN BUTTON.png" width="100px" height="100px">
        <a href="jamboree.php" class="jamboree"><img class="d-block mr-0" src="/images/GamePetition Jamboree Logo NEGRO SANGRE.png" width="400px" height="88px"></a>
    </div>

    <?php
    include_once 'templates/footer.php';
    include_once 'js/frontJs.php';
    ?>
