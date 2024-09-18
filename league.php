<?php
include_once 'templates/header.php';
?>

<title>Game Petition - Liga</title>
<div class="justify-content-center fontGP py-3 bannerCross text-center ligaBg" tkey="liga">LIGA</div>
<div class="container pt-4" style="max-width: 1120px;">

    <div class="d-flex justify-content-center my-1">
        <div class="col-md-8 col-sm-12 col-12">
            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alertNewLeague" style="display: none;">
                <div tkey="email_registered" style="display: none;" id="email_registered"></div>
                <div tkey="username_registered" style="display: none;" id="username_registered"></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="successNewLeague" style="display: none;">
                <div tkey="creaLeag_success" id="regist_success"></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php if ($_SESSION['logged_in']) { ?>
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
                <div class="row justify-content-between ligaBg fontMenu p-2 my-2" id="crea_league">
                    <p class="col-10" tkey="crear_liga"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
        </div>

        <?php
            include 'forms/crear_liga.php'
        ?>

        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
                <div class="row justify-content-between ligaBg fontMenu p-2 my-2" id="list_league">
                    <p class="col-10" tkey="lista_ligas"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-list-ul"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ligaSub ligaNegrita" style="display: none;" id="dv_list_league">
            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between ligSubMenu  ligaBg selOption text-white py-1 my-2" id="butListDesa" lgtipo="LIG">
                    <p class="col-10 fw-bolder" tkey="list_desa"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListDesa">

            </div>
            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between ligSubMenu ligaBg selOption text-white py-1 my-2" id="butListSol" lgtipo="LIG">
                    <p class="col-10 fw-bolder" tkey="list_sol"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListSol">

            </div>
            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between ligSubMenu  ligaBg selOption text-white py-1 my-2" id="butListFin" lgtipo="LIG">
                    <p class="col-10 fw-bolder" tkey="list_fin"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListFin">

            </div>
            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between ligSubMenu ligaBg selOption text-white py-1 my-2" id="butListPeti" lgtipo="LIG">
                    <p class="col-10 fw-bolder" tkey="list_peti"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListPeti">

            </div>

            <div class="col-md-7 col-sm-11">
                <div class="row justify-content-between ligSubMenu ligaBg selOption text-white py-1 my-2" id="butListDispo" lgtipo="LIG">
                    <p class="col-10 fw-bolder" tkey="list_dispo"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-plus"></i>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-11" style="display: none;" id="divListDispo">

            </div>

        </div>


    <?php } ?>
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
            <div class="row justify-content-between ligaBg fontMenu p-2 my-2">
                <p class="col-10" tkey="ranking">RANKING</p>
                <p class="col-2 text-end">
                    <i class="fas fa-chart-bar"></i>
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
    <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
        <div class="row justify-content-between ligaBg fontMenu p-2 my-2" id="butBuscar">
            <p class="col-10" tkey="buscar">BUSCAR</p>
            <p class="col-2 text-end">
                <i class="fas fa-search"></i>
            </p>
        </div>
        <div class="col-md-9 col-sm-11" style="display: none;" id="divListBusqueda">
            <input type="text" id="searchInput" placeholder="Introduce tu búsqueda">
            <div id="resultsContainer"></div>
        </div>
    </div>
</div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-11 pe-4 ps-4 margin-5">
            <div class="row justify-content-between ligaBg fontMenu p-2 my-2" id="game_petition">
                <p class="col-10" tkey="hacer_peticion">HACER UNA PETICIÓN</p>
                <p class="col-2 text-end">

                </p>
            </div>
        </div>
    </div>
    
    <?php
        include 'forms/game_petition.php'
    ?>

</div>


<?php
include_once 'templates/footer.php';
include_once 'js/frontJs.php';
include_once 'js/leagueJs.php';

?>