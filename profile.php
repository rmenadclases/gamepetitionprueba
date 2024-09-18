<?php

include_once 'templates/header.php';
?>
<title>GamePetition - <?php echo $_SESSION['username'] ?></title>
<div class="justify-content-center fontGP py-3 bannerCross text-center perfBg" tkey="perf"></div>
<div class="container" style="max-width: 1120px;">
    <?php if ($_SESSION['logged_in'] && $_SESSION['app'] == 'GamePetition') { ?>
        <div class="row justify-content-center mt-4">
            <span class="text-center fontMenuStatic perfColor">EN CONSTRUCCIÓN <i class="fas fa-hammer"></i></span>
        </div>
        <div class="row justify-content-start mt-4">
            <div class="col-md-3 col-sm-12 col-12 ">
                <img src="images/avatar.png" class="maskGP" alt="avatar" id="avatarPrf">
                <label for="inputFile"><i class="fa-solid fa-pen i_maskGP text-secondary float-end" role="button"></i></label>
                <div class="">
                    <input id="inputFile" type="file" style="display: none;">
                </div>

                <!-- <input type="file" class="custom-file-input" id="inputFile" lang="en"> -->
            </div>
            <div class="col-md-9 col-sm-12 col-12">
                <div class="row align-middle">
                    <div class="col-md-7 col-sm-12 col-12 justify-content-between p-1 my-auto">
                        <div class="perfBg fontMenuStatic selMenuStatic">
                            <p class="ms-2 p-1 align-middle"><?php echo $_SESSION['username'] ?></p>
                        </div>
                    </div>
                    <div class="col justify-content-between p-1  text-end">
                        <p class="ms-4 fontMenuStatic perfColor fw-bolder" style="font-size: 40px;">7 VICTORIAS</p>
                    </div>
                </div>
                <div class="row justify-content-between ligaBg fontMenu p-2 my-2">
                    <p class="col-10" tkey="ligas_play"></p>
                    <p class="col-2 text-end">
                        10
                    </p>
                </div>
                <div class="row justify-content-between ligaBg fontMenu p-2 my-2">
                    <p class="col-10" tkey="ligas_win"></p>
                    <p class="col-2 text-end">
                        2
                    </p>
                </div>
                <div class="row justify-content-between tornBg fontMenu p-2 my-2">
                    <p class="col-10" tkey="torn_play"></p>
                    <p class="col-2 text-end">
                        23
                    </p>
                </div>
                <div class="row justify-content-between tornBg fontMenu p-2 my-2">
                    <p class="col-10" tkey="torn_win"></p>
                    <p class="col-2 text-end">
                        5
                    </p>
                </div>
                <div class="row justify-content-between compBg fontMenu p-2 my-2">
                    <p class="col-10" tkey="comp_play"></p>
                    <p class="col-2 text-end">
                        4
                    </p>
                </div>
                <div class="row justify-content-between compBg fontMenu p-2 my-2">
                    <p class="col-10" tkey="comp_win"></p>
                    <p class="col-2 text-end">
                        0
                    </p>
                </div>
                <div class="row justify-content-between perfBg fontMenu p-2 my-2">
                    <p class="col-8" tkey="top_game"></p>
                    <p class="col-4 text-end">
                        Super Smash Bros
                    </p>
                </div>
                <div class="row justify-content-between perfBg fontMenu p-2 my-2">
                    <p class="col-8" tkey="top_mode"></p>
                    <p class="col-4 text-end">
                        Liga 4Vs
                    </p>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="text-center mt-5 d-flex justify-content-center">
            <p class="me-2" tkey="prof_unete"> </p><a href="newUser.php"><b tkey="unete"></b></a>
        </div>
    <?php }  ?>
</div>


<?php
include_once 'templates/footer.php';
include_once 'js/frontJs.php';
include_once 'js/leagueJs.php';
?>
