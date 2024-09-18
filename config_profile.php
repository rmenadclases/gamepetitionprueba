<?php

include_once 'templates/header.php';

//Recuperar datos User

$sqlUserData = "select username, email, name, confirmation, address, phone, news from users where id = " . $_SESSION['id'] . ";";
$resUserData = $connection->query($sqlUserData);
$rowUserData = $resUserData->fetch_array(MYSQLI_ASSOC);
/* $rowUserData = array_map('utf8_encode', $rowUserData); */

?>
<title>GamePetition - Profile</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center perfBg" tkey="conf_perf"></div>
<div class="container" style="max-width: 1120px;">
    <?php if ($_SESSION['logged_in'] && $_SESSION['app'] == 'GamePetition') { ?>
        <div class="row justify-content-center mt-4">
            <span class="text-center fontMenuStatic perfColor">EN CONSTRUCCIÓN <i class="fas fa-hammer"></i></span>
        </div>
        <div class="row justify-content-start mt-4">
            <div class="col-md-2 col-sm-12 col-12">
                <img src="images/avatar.png" class="maskGP img-fluid mx-auto d-block" alt="avatar" style="max-height: 150px;" id="avatarPrf">
                <button class="btn btn-link link-secondary text-center mx-auto" onclick="document.getElementById('inputFile').click();"><i class="fas fa-pencil-alt"></i><span tkey="img_profile"></span> </button>
                <input type="file" style="display:none;" id="inputFile" />

<!--                 <img src="images/avatar.png" class="maskGP" alt="avatar" id="avatarPrf">
                <label for="inputFile"><i class="fa-solid fa-pen i_maskGP text-secondary float-end" role="button"></i> <span tkey="img_profile"></span></label>
                <div class="">
                    <input id="inputFile" type="file" style="display: none;">
                </div> -->


            </div>
            <div class="col-md-9 col-sm-12 col-12">
                <form class="mt-4">
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div class="alert alert-danger text-center" role="alert" id="alertNewUser" style="display: none;">
                                <div tkey="email_registered" style="display: none;" id="email_registered"></div>
                                <div tkey="username_registered" style="display: none;" id="username_registered"></div>
                            </div>
                            <div class="alert alert-success text-center" role="alert" id="successNewUser" style="display: none;">
                                <div tkey="regist_success" id="regist_success"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div tkey="userName" class="prfSubMenu "></div>
                            <input type="text" class="form-control input" id="userName" value="<?php echo $rowUserData['username'] ?>">
                            <div class="invalid-feedback" id="userNameValidate" tkey="char_invalid"></div>
                            <div class="invalid-feedback" id="userNameValidateLong" tkey="long_1-30"></div>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div tkey="nameSurname" class="prfSubMenu"></div>
                            <input type="text" class="form-control input" id="nameSurname" value="<?php echo $rowUserData['name'] ?>">
                            <div class="invalid-feedback" id="nameSurnameValidate" tkey="char_invalid"></div>
                            <div class="invalid-feedback" id="nameSurnameValidateLong" tkey="long_1-50"></div>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div tkey="email" class="prfSubMenu "></div>
                            <input type="email" class="form-control input" id="email" value="<?php echo $rowUserData['email'] ?>">
                            <div class="invalid-feedback" id="emailValidate" tkey="email_invalid"></div>
                            <div class="invalid-feedback" id="emailValidateLong" tkey="long_1-50"></div>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div tkey="password" class="prfSubMenu "></div>
                            <input type="password" class="form-control input" id="chgPass">
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div tkey="password2" class="prfSubMenu "></div>
                            <input type="password" class="form-control input" id="chgPass2s">
                            <div class="invalid-feedback" id="password2Validate" tkey="pass_not_match"></div>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div tkey="domicilio" class="prfSubMenu "></div>
                            <input type="text" class="form-control input" id="domicilio" value="<?php echo $rowUserData['address'] ?>">
                            <div class="invalid-feedback" id="domicilioValidate" tkey="char_invalid"></div>
                            <div class="invalid-feedback" id="domicilioValidateLong" tkey="long_100"></div>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-1">
                        <div class="col-sm-12 col-12">
                            <div tkey="telefono" class="prfSubMenu "></div>
                            <input type="text" class="form-control input" id="telefono" value="<?php echo $rowUserData['phone'] ?>">
                            <div class="invalid-feedback" id="telefonoValidate" tkey="char_invalid"></div>
                            <div class="invalid-feedback" id="telefonoValidateLong" tkey="long_10"></div>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="col-sm-12 col-12">
                            <div class="d-flex justify-content-between m-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?php echo ($rowUserData['news'] <> '' ? 'checked' : '') ?> value="" id="newsCheck">
                                    <label class="form-check-label prfSubMenu" for="newsCheck" tkey="news_check"></label>
                                </div>
                                <div class="">
                                    <button type="button" class="ms-auto btn btn-outline-success btn-block" tkey="btnUpdProfile" id="btnUpdProfile" style="min-width: 200px;"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
include_once 'js/newUserJs.php';
include_once 'js/updUserJs.php';
include_once 'js/profileJs.php';

?>