<?php
//PHP 7.4.33
//phpinfo();
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
// En windows
setlocale(LC_TIME, 'spanish');
// Unix
setlocale(LC_TIME, 'es_ES.UTF-8');
require_once 'resources/config.php';
$error_log = false;
 if (isset($_POST['log_button'])) {
    
    $sqlCompUser = "select id, username, email, name, confirmation, rol from  users where pass = '" . md5($_POST['log_pass'],) . "' and upper(email) = upper('" . $_POST['log_email'] . "')";
    $resCompUser = $connection->query($sqlCompUser);
    $rowCompUser = $resCompUser->fetch_array(MYSQLI_ASSOC);

    if ($resCompUser->num_rows == 1) {
        $_SESSION = $rowCompUser;
        $_SESSION['logged_in'] = true;
        $_SESSION['app'] = 'GamePetition';
        header('Location: ../index.php');
    } else {
        $error_log = true;
    }
} 

//Inbox not viewed
$stmt = $connection->prepare("SELECT count(*) as inbxN FROM participantes 
                              LEFT JOIN league ON league.lgid = participantes.ptleagid
                              WHERE participantes.ptview = 0 
                              AND participantes.ptusrid = ? 
                              AND league.lgid IS NOT NULL;");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$resInboxCount = $stmt->get_result();
$rowInboxCount = $resInboxCount->fetch_array(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--favicon-->
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Custom fonts for this template -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- TOM SELECT -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/pricing.css" rel="stylesheet">

    <!-- datatables -->
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&display=swap" rel="stylesheet">

    <!-- Adsense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7112703853545131" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="css/styles.css" rel="stylesheet">
</head>

<body class="bgWhite">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" aria-label="Eighth navbar example">
            <div class="container-lg">
                <a class="navbar-brand" href="/">
                    <img class="img-fluid logoImg" src="images/Logo Gamepetition def.png">
                    <img class="img-fluid logoTxt" src="/images/gamepetition.png"> 
                    <img class="img-fluid logoTxt betaTxt" src="/images/beta.png">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
               
                <!-- Mapa e interrogante -->
                

                <div class="collapse navbar-collapse" id="navbarsExample07">
                <div class="d-flex justify-content-center">
                    <img class="imgCross ms-4" src="/images/COPA50PIXELES.png" id="liga" width="50" height="50">
                    <img class="imgCross ms-4" src="/images/PODIUM50PIXELES.png" id="competicion" width="50" height="50">
                    <img class=" imgCross ms-4" src="/images/BRAQUETS50PIXELES.png" id="torneo" width="50" height="50">
                    <img class="imgCross ms-4" src="/images/MANDO50PIXELES.png" id="perfil" width="50" height="50">
                </div>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if ($_SESSION['logged_in'] && $_SESSION['app'] == 'GamePetition') { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['username'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <!-- <a href="config_profile.php" class="dropdown-item btn btn-link"><i class="fas fa-cog compColor"></i> <span tkey="account_config"></span></a> -->
                                    <button type="button" id="LogoutButton" class="dropdown-item btn btn-link"><i class='fas fa-sign-out-alt ligaColor'></i> <span tkey="signout"></span></button>
                                    <?php if ($_SESSION['rol'] == 'Admin') { ?>
                                        <a href="config_profile.php" class="dropdown-item btn btn-link"><i class="fas fa-cog compColor"></i> <span tkey="account_config"></span></a>
                                        <a href="admin.php" class="dropdown-item btn btn-link"><i class="fas fa-tools tornColor"></i></i> <span>Admin</span></a>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link position-relative" href="/inbox.php" id="inboxHead" role="button" aria-expanded="false">
                                    <i class="fa-solid fa-inbox fa-lg"></i>
                                    <span class="position-absolute translate-middle badge rounded-pill bg-danger" id="lblCountInbox" style="font-size: 10px;">
                                        <?php echo $rowInboxCount['inbxN']; ?>
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Login
                                </a>
                                <div class="dropdown-menu p-3" aria-labelledby="navbarDropdownMenuLink" id="login-dp">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <form method="post">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control" id="floatingInput" name="log_email" placeholder="name@example.com">
                                                    <label for="floatingInput" tkey="email"></label>
                                                </div>
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" id="floatingPassword" name="log_pass" placeholder="Password">
                                                    <label for="floatingPassword" tkey="password"></label>
                                                </div>
                                                <button class="w-100 btn btn-secondary mt-4" type="submit" name="log_button" tkey="signin"></button>
                                            </form>

                                        </div>
                                        <div class="text-center mt-3 d-flex justify-content-center">
                                            <p class="me-2" tkey="eres_nuevo"> </p><a href="newUser.php"><b tkey="unete"></b></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                        <?php } ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropLang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-inline align-items-center">
                                    <!--span class="" tkey="es" id="txtLangHead"></span>
                                    <img src="images/lang/es.png" class="rounded " width="20px;" id="imgLangHead"-->
                                    <span class="" tkey="" id="txtLangHead"></span>
                                    <img src="" class="rounded " width="20px;" id="imgLangHead">
                                </div>
                            </a>
                            <div class="dropdown-menu p-3" aria-labelledby="dropLang" id="lang-dp">
                                <a class="dropdown-item selLanguage" lang="es" role="button">
                                    <div class="d-inline align-items-center">
                                        <span class="" tkey="es"></span>
                                        <img src="images/lang/es.png" class="rounded float-end" width="20px;">
                                    </div>
                                </a>
                                <a class="dropdown-item selLanguage" lang="en" role="button">
                                    <div class="d-inline align-items-center">
                                        <span class="" tkey="en"></span>
                                        <img src="images/lang/en.png" class="rounded float-end" width="20px;">
                                    </div>
                                </a>
                            </div>
                            
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center">
                    <a href=""><img class=" ms-4" src="/images/GEO ICONO GP.png"  width="40" height="40"></a>    
                    <a href=""><img class="ms-4" src="/images/INFORMACION ICONO GP.png"  width="40" height="40"></a>
                </div>
                </div>
                
            </div>
        </nav>