<?php


include_once 'templates/header.php';
?>
<title>GamePetition - New User</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center perfBg" tkey="newUser"></div>
<div class="container" style="max-width: 1120px;">
    <form class="mt-4">
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
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
            <div class="col-md-8 col-sm-12 col-12">
                <div tkey="userName" class="prfSubMenu "></div>
                <input type="text" class="form-control input" id="userName">
                <div class="invalid-feedback" id="userNameValidate" tkey="char_invalid"></div>
                <div class="invalid-feedback" id="userNameValidateLong" tkey="long_1-30"></div>
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div tkey="nameSurname" class="prfSubMenu"></div>
                <input type="text" class="form-control input" id="nameSurname">
                <div class="invalid-feedback" id="nameSurnameValidate" tkey="char_invalid"></div>
                <div class="invalid-feedback" id="nameSurnameValidateLong" tkey="long_1-50"></div>
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div tkey="email" class="prfSubMenu "></div>
                <input type="email" class="form-control input" id="email">
                <div class="invalid-feedback" id="emailValidate" tkey="email_invalid"></div>
                <div class="invalid-feedback" id="emailValidateLong" tkey="long_1-50"></div>
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div tkey="password" class="prfSubMenu "></div>
                <input type="password" class="form-control input" id="password">
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div tkey="password2" class="prfSubMenu "></div>
                <input type="password" class="form-control input" id="password2">
                <div class="invalid-feedback" id="password2Validate" tkey="pass_not_match"></div>
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div tkey="domicilio" class="prfSubMenu "></div>
                <input type="text" class="form-control input" id="domicilio">
                <div class="invalid-feedback" id="domicilioValidate" tkey="char_invalid"></div>
                <div class="invalid-feedback" id="domicilioValidateLong" tkey="long_100"></div>
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-1">
            <div class="col-md-8 col-sm-12 col-12">
                <div tkey="telefono" class="prfSubMenu "></div>
                <input type="text" class="form-control input" id="telefono">
                <div class="invalid-feedback" id="telefonoValidate" tkey="char_invalid"></div>
                <div class="invalid-feedback" id="telefonoValidateLong" tkey="long_10"></div>
                <div class="line-box">
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <div class="col-md-8 col-sm-12 col-12">
                <div class="d-flex justify-content-between m-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="newsCheck">
                        <label class="form-check-label prfSubMenu" for="newsCheck" tkey="news_check"></label>
                    </div>
                    <div class="">
                        <button type="button" class="ms-auto btn btn-outline-success btn-block" tkey="btnNewUser" id="btnNewUser" style="min-width: 200px;"></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<?php
include_once 'templates/footer.php';
include_once 'js/newUserJs.php';
?>