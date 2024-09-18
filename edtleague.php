 <?php
include_once 'templates/header.php';

// Verificar si el usuario está autenticado (solo un ejemplo, ajusta según tu sistema de autenticación)
if (!isset($_SESSION['id'])) {
    // Redirigir o mostrar mensaje de error si no está autenticado
    header('Location: login.php');
    exit();
}

$sql = "SELECT league.*, games.*, users.*, 
                (SELECT COUNT(*) FROM participantes WHERE ptleagid = lgid) AS partAdd 
        FROM league 
        LEFT JOIN games ON games.gaid = league.lggame 
        LEFT JOIN users ON league.lgcreaid = users.id 
        WHERE lgid = " . $_GET['id'];
$result = $connection->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);

// Verificar si el usuario actual es el creador de la liga
$isCreator = ($_SESSION['id'] == $row['lgcreaid']);

// Función para verificar si el usuario ya está inscrito en la liga
function isUserRegistered($userId, $leagueId, $connection)
{
    $sqlCheckUser = "SELECT COUNT(*) AS count FROM participantes WHERE ptusrid = ? AND ptleagid = ?";
    $stmt = $connection->prepare($sqlCheckUser);
    $stmt->bind_param("ii", $userId, $leagueId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

$userAlreadyRegistered = isUserRegistered($_SESSION['id'], $row['lgid'], $connection);

switch ($row['lgtipo']) {
    case 'LIG':
        $Bg = 'ligaBg';
        $subMenu = 'ligSubMenu';
        break;
    case 'TOR':
        $Bg = 'tornBg';
        $subMenu = 'tornSubMenu';
        break;
    default:
        $Bg = 'ligaBg';
        $subMenu = 'ligSubMenu';
        break;
}
?>
<title>GamePetition - Liga</title>
<div class="row justify-content-center fontGP py-3 bannerCross <?php echo $Bg; ?>">
    <div class="col-md-2 col-sm-11 margin-5 ms-auto">
        <img class="img-fluid" src="images/games/<?php echo $row['gaimg']; ?>" />
    </div>
    <div class="col-md-4 col-sm-11 ps-4 ms-4 me-auto">
        <?php echo $row['lgname']; ?>
    </div>
</div>
<div class="container pt-4" style="max-width: 1120px; margin-top: 50px;">

    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-11 margin-5">
            <div class="row justify-content-between <?php echo $Bg; ?> fontMenuOpen p-2 my-2 selMenuStatic" id="info">
                <p class="col-10" tkey="info"></p>  
                <p class="col-2 text-end">
                    <i class="fas fa-info"></i>
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center ligaSub text-justify" id="dv_info">
        <div class="col-md-10 col-sm-11 margin-5 my-2">
            <p class="<?php echo $subMenu; ?>" tkey="masinfo"></p>
            <?php // Determinar si es Online o Presencial
            $lglocal_text = ($row['lglocal'] === 'ONL') ? 'Online' : 'Presencial';

            // Determinar si es Pública o Privada
            $lgpriva_text = ($row['lgpriva'] === 'Pub') ? 'Pública' : 'Privada';
            ?>
            <h3 style="font-weight: bold; color: #f1b70d; font-style: italic;">
                <?php echo $row['lgnumpart']; ?> <span tkey="participantes"></span> -
                <?php echo $row['lgtipduel'] . ' - ' . $lglocal_text . ' - ' . $lgpriva_text; ?>
            </h3>
        </div>

        <div class="col-md-10 col-sm-11 margin-5 my-2">
            <p class="<?php echo $subMenu; ?>" tkey="lgdescrip"></p>
            <p><?php echo $row['lgdescrip']; ?></p>
        </div>
        <div class="col-md-10 col-sm-11 margin-5 my-2">
            <p class="<?php echo $subMenu; ?>" tkey="lgmarcad"></p>
            <p><?php echo $row['lgmarcad']; ?></p>
        </div>
        <div class="col-md-10 col-sm-11 margin-5 my-2">
            <p class="<?php echo $subMenu; ?>" tkey="lgdesemp"></p>
            <p><?php echo $row['lgdesemp']; ?></p>
        </div>
        <div class="col-md-10 col-sm-11 margin-5 my-2">
            <p class="<?php echo $subMenu; ?>" tkey="lgpremio"></p>
            <p><?php echo $row['lgpremio']; ?></p>
        </div>
        <div class="col-md-10 col-sm-11 margin-5 my-2">
            <p class="<?php echo $subMenu; ?>" tkey="particip" id="listaPart"></p>
            <p><span id="lblPartAdd"><?php echo $row['partAdd']; ?></span> / <span
                    id="lblNumPart"><?php echo $row['lgnumpart']; ?></span></p>
            <div class="row justify-content-center text-justify" id="divListaPart">
                <?php
                $sqlPart = "SELECT participantes.*, users.username 
                            FROM participantes 
                            LEFT JOIN users ON users.id = participantes.ptusrid 
                            WHERE ptleagid = " . $_GET['id'];
                $resultPart = $connection->query($sqlPart);
                while ($rowPart = $resultPart->fetch_array(MYSQLI_ASSOC)) {
                    $currentUser = $_SESSION['username'];
                    $currentUserId = $_SESSION['id'];
                    ?>
                    <div class="col-lg-4">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" readonly value="<?php echo $rowPart['username']; ?>">
                            <?php if ($isCreator || ($rowPart['username'] == $currentUser && $rowPart['ptusrid'] == $currentUserId)) { ?>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-danger btnDelPart" usrid="<?php echo $rowPart['ptusrid']; ?>"
                                        lgid="<?php echo $rowPart['ptleagid']; ?>" type="button"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="row justify-content-center text-justify" id="">
                <?php if ($isCreator) { ?>
                    <div class="col-lg-4">
                        <p class="text-center">Usuarios Registrados</p>
                        <div class="input-group">
                            <input class="form-control" type="text" list="lgpartlist" id="lgpart">
                            <datalist id="lgpartlist">
                                <?php
                                $sqlGames = "SELECT * FROM users ORDER BY name";
                                $resGames = $connection->query($sqlGames);
                                while ($rowGames = $resGames->fetch_array(MYSQLI_ASSOC)) {
                                    echo '<option data-id="' . $rowGames['id'] . '" value="' . $rowGames['username'] . '">';
                                }
                                ?>
                            </datalist>
                            <button class="btn btn-outline-success" type="button" id="butAddPartCrea" <?php echo ($row['partAdd'] >= $row['lgnumpart'] || $userAlreadyRegistered ? 'disabled' : ''); ?>
                                lgid="<?php echo $row['lgid']; ?>"><i class="fas fa-plus"></i></button>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <p class="text-center">Usuarios No Registrados</p>
                        <div class="input-group">
                            <input class="form-control" type="text" id="lgpartnoreg">
                            <button class="btn btn-outline-success" type="button" id="butAddPartNoregCrea" <?php echo ($row['partAdd'] >= $row['lgnumpart'] ? 'disabled' : ''); ?>
                                lgid="<?php echo $row['lgid']; ?>"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-4">
                        <p class="text-center">Añadir Usuario</p>
                        <div class="input-group">
                            <input type="text" class="form-control" id="lgpart" value="<?php echo $_SESSION['username']; ?>"
                                readonly>
                            <button class="btn btn-outline-success" type="button" id="butAddPartCrea"
                                lgid="<?php echo $row['lgid']; ?>" usrid="<?php echo $_SESSION['id']; ?>" <?php echo $userAlreadyRegistered ? 'disabled' : ''; ?>><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php if ($row['lgtipo'] == 'LIG') { ?>
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-11 margin-5">
                <div class="row justify-content-between <?php echo $Bg; ?> fontMenu p-2 my-2" id="classif">
                    <p class="col-10" tkey="classif"></p>
                    <p class="col-2 text-end">
                        <i class="fas fa-chart-bar"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ligaSub" style="display: none;" id="dv_classif"
            data-id="<?php echo $row['lgid']; ?>">

        </div>
    <?php } ?>
    <div class="row justify-content-center" style="display: none;">
        <div class="col-md-10 col-sm-11 margin-5">
            <div class="row justify-content-between <?php echo $Bg; ?> fontMenu p-2 my-2" id="enfrent">
                <p class="col-10" tkey="enfrent"></p>
                <p class="col-2 text-end">
                    <i class="fas fa-fist-raised"></i>
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center ligaSub" style="display: none;" id="dv_enfrent">
        <?php
        
            switch ($row['lgtipo']) {
                case 'LIG':
                    include_once 'resources/incVersus.php';
                    break;
                case 'TOR':
                    include_once 'resources/incVersusTOR.php';
                    break;
            }
        
        ?>
    </div>
    <?php if ($isCreator && !$row['lgend']) { ?>
        <div class="row justify-content-center" style="display: none;">
            <div class="col-md-10 col-sm-11 margin-5">
                <div class="row justify-content-between <?php echo $Bg; ?> fontMenu p-2 my-2" id="admin">
                    <p class="col-10" tkey="admin">Administración</p>
                    <p class="col-2 text-end">
                        <i class="fas fa-tools"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ligaSub text-justify" style="display: none;" id="dv_admin">
            <div class="col-md-3 col-sm-6 d-grid gap-2">
                <button class="btn btn-outline-danger mt-3" type="button" id="endLeague"
                    data-id="<?php echo $row['lgid']; ?>" tkey="end_league">Terminar Liga</button>
            </div>
        </div>
    <?php } ?>
</div>

<?php
include_once 'templates/footer.php';
include_once 'js/frontJs.php';
include_once 'js/edtleagueJs.php';
?>