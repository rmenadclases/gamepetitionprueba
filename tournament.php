<?php


include_once 'templates/header.php';
?>
<title>GamePetition - Torneo</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center tornBg" tkey="torn">TORNEO</div>
<div class="container pt-4" style="max-width: 1120px;">

    <div class="d-flex justify-content-center my-1">
        <div class="col-md-8 col-sm-12 col-12">
            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alertNewLeague" style="display: none;">
                <div tkey="email_registered" style="display: none;" id="email_registered"></div>
                <div tkey="username_registered" style="display: none;" id="username_registered"></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="successNewLeague" style="display: none;">
                <div tkey="creaTorn_success" id="regist_success"></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php if ($_SESSION['logged_in']) { ?>
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
                <div class="row justify-content-between tornBg fontMenu p-2 my-2" id="crea_torneo">
                    <p class="col-10" tkey="crear_torn"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>

        </div>
        <div class="row justify-content-center mt-4 ligaSub" style="display: none;" id="dv_crea_torneo">
            <div class="col-md-5 col-sm-11">
                <div class="d-flex justify-content-center mb-3">
                    <div class="col text-center my-2">
                        <img id="lgimg" class="img-fluid" src="images/gamepetition.png" />
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-5 my-auto">
                        <div tkey="toname" class="tornSubMenu"></div>
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control input" id="lgname">
                        <div class="line-box">
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-5 my-auto">
                        <div tkey="lggame" class="tornSubMenu"></div>
                    </div>
                    <div class="col-7">
                        <select id="lggameSel" autocomplete="off">
                            <option value="" tkey="select"></option>
                            <?php
                            $sqlGames = "select * from games order by ganame";
                            $resGames = $connection->query($sqlGames);
                            while ($rowGames = $resGames->fetch_array(MYSQLI_ASSOC)) {
                                echo '<option value="' . $rowGames['gaid'] . '" data-alt="' . $rowGames['ganamealt'] . '" data-src="' . $rowGames['gaimg'] . '">' . $rowGames['ganame'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-5 my-auto">
                        <div tkey="lgnumpart" class="tornSubMenu"></div>
                    </div>
                    <div class="col-7">
                        <input type="number" class="form-control input" id="lgnumpart" min=2>
                        <div class="line-box">
                            <div class="line"></div>
                        </div>
                    </div>
                    <!-- <div class="col-7">
                        <select class="form-select" id="lgnumpart">
                            <option tkey="select"></option>
                            <option>4</option>
                            <option>8</option>
                            <option>16</option>
                            <option>32</option>
                            <option>64</option>
                            <option>128</option>
                        </select>
                    </div> -->
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-5 my-auto">
                        <div tkey="lglocal" class="tornSubMenu"></div>
                    </div>
                    <div class="col-7">
                        <select class="form-select" id="lglocal">
                            <option value="ONL" tkey="online"></option>
                            <option value="PRE" tkey="presencial"></option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-5 my-auto">
                        <div tkey="lgpriva" class="tornSubMenu"></div>
                    </div>
                    <div class="col-7">
                        <select class="form-select" id="lgpriva">
                            <option value="PUB" tkey="publica"></option>
                            <option value="PRI" tkey="privada"></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-11 mx-2 my-auto">
                <!-- DETALLES -->
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-12 my-auto">
                        <div class="row justify-content-between tornSubMenu tornBg selOption text-white py-1" id="butDetails">
                            <p class="col-10" tkey="detalles"></p>
                            <p class="col-2 text-end">
                                <i class="fas fa-plus"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div style="display: none;" id="divDetails">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="col-5 mb-auto">
                            <div tkey="lgdescrip" class="tornSubMenu"></div>
                        </div>
                        <div class="col-7">
                            <textarea class="form-control input" id="lgdescrip" rows="3"></textarea>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="col-5 mb-auto">
                            <div tkey="lgmarcad" class="tornSubMenu"></div>
                        </div>
                        <div class="col-7">
                            <textarea class="form-control input" id="lgmarcad" rows="3"></textarea>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="col-5 mb-auto">
                            <div tkey="lgdesemp" class="tornSubMenu"></div>
                        </div>
                        <div class="col-7">
                            <textarea class="form-control input" id="lgdesemp" rows="3"></textarea>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="col-5 mb-auto">
                            <div tkey="lgpremio" class="tornSubMenu"></div>
                        </div>
                        <div class="col-7">
                            <textarea class="form-control input" id="lgpremio" rows="3"></textarea>
                            <div class="line-box">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PARTICIPANTES -->
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-12 my-auto">
                        <div class="row justify-content-between tornSubMenu tornBg selOption text-white py-1" id="butParticip">
                            <p class="col-10" tkey="particip"></p>
                            <p class="col-2 text-end">
                                <i class="fas fa-plus"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div style="display: none;" id="divParticip">
                    <p class="text-center">Usuarios Registrados</p>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="col-5 my-auto">
                            <div tkey="lgaddpart" class="tornSubMenu"></div>
                        </div>
                        <div class="col-7 ">
                            <div class="input-group">
                                <input class="form-control" type="text" list="lgpartlist" id="lgpart">
                                <datalist id="lgpartlist">
                                    <?php
                                    $sqlGames = "select * from users order by name";
                                    $resGames = $connection->query($sqlGames);
                                    while ($rowGames = $resGames->fetch_array(MYSQLI_ASSOC)) {
                                        echo '<option data-id="' . $rowGames['id'] . '" value="' . $rowGames['username'] . '">';
                                    }
                                    ?>
                                </datalist>
                                <button class="btn btn-outline-success" type="button" id="butAddPart"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <p class="text-center">Usuarios No Registrados</p>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="col-5 my-auto">
                            <div tkey="lgaddpart" class="tornSubMenu"></div>
                        </div>
                        <div class="col-7 ">
                            <div class="input-group">
                                <input class="form-control" type="text" id="lgpartnoreg">
                                <button class="btn btn-outline-success" type="button" id="butAddPartNoreg"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="dipPartAdded">

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center mb-3">
                    <div class="col-md-3 col-sm-6 d-grid gap-2">
                        <button class="btn btn btn-outline-success" type="button" id="butCreaLeag" lgtipo="TOR" tkey="butCrea"></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
                <div class="row justify-content-between tornBg fontMenu p-2 my-2" id="list_torneo">
                    <p class="col-10" tkey="lista_torns"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-list-ul"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ligaSub" style="display: none;" id="dv_list_torneo">
            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between tornSubMenu tornBg selOption text-white py-1 my-2" id="butListDesa" lgtipo="TOR">
                    <p class="col-10 fw-bold" tkey="list_desa"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListDesa">

            </div>
            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between tornSubMenu tornBg selOption text-white py-1 my-2" id="butListSol" lgtipo="TOR">
                    <p class="col-10 fw-bold" tkey="list_sol"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListSol">

            </div>
            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between tornSubMenu tornBg selOption text-white py-1 my-2" id="butListFin" lgtipo="TOR">
                    <p class="col-10 fw-bold" tkey="list_fin"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListFin">

            </div>
        </div>


    <?php } ?>
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
            <div class="row justify-content-between tornBg fontMenu p-2 my-2">
                <p class="col-10" tkey="ranking">RANKING</p>
                <p class="col-2 text-end">
                    <i class="fas fa-chart-bar"></i>
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
            <div class="row justify-content-between tornBg fontMenu p-2 my-2">
                <p class="col-10" tkey="buscar">BUSCAR</p>
                <p class="col-2 text-end">
                    <i class="fas fa-search"></i>
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
            <div class="row justify-content-between tornBg fontMenu p-2 my-2">
                <p class="col-10" tkey="hacer_peticion">HACER UNA PETICIÓN</p>
                <p class="col-2 text-end">

                </p>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'templates/footer.php';
include_once 'js/frontJs.php';
include_once 'js/leagueJs.php';

?>