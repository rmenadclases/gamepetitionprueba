<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Madrid');
setlocale(LC_ALL, 'es_ES');
require_once '../resources/config.php';

$jugadores = array();
$parejas = array();
$vsduelo = array();

$leagueId = $_POST['leagueId'];
$lgtipo = $_POST['lgtipo'];
$lgtipduel = $_POST['lgtipduel'];

// Iniciamos jugadores
$sql = "SELECT * FROM participantes WHERE participantes.ptleagid = " . $leagueId . ";";

if ($result = $connection->query($sql)) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($jugadores, $row['ptusrid']);
    }
}

shuffle($jugadores);
$iteraciones = count($jugadores) - 1;

$sqlLiga = "SELECT * from league where lgid = " . $leagueId . ";";
$resLiga = $connection->query($sqlLiga);
$rowLiga = $resLiga->fetch_array(MYSQLI_ASSOC);

switch ($lgtipo) {
    case 'LIG':
        switch ($lgtipduel) {
            case '4VS':
                $_POST['vsgrupo'] = 4;
                break;
            case '1VS':
                $_POST['vsgrupo'] = 2;
                break;
            case 'CMP':
                $_POST['vsgrupo'] = 1;
                break;
            case '3VS':
                $_POST['vsgrupo'] = 3;
                break;
            case 'SUIZO':
                $_POST['vsgrupo'] = 2;  // En un Sistema Suizo, normalmente es 1vs1
                break; 
                
        }
        $_POST['vsnumber'] = $rowLiga['lgnumpart'];
        $_POST['factor'] = 2;
        $grupo = $_POST['vsgrupo'];

        if ($grupo == 4) {
            // Inicio ARRAY
            $vs[] = array($jugadores[0], $jugadores[1], $jugadores[2], $jugadores[3]);
            for ($i = 0; $i <= $iteraciones; $i++) {
                for ($j = 0; $j <= $iteraciones; $j++) {
                    for ($k = 0; $k <= $iteraciones; $k++) {
                        for ($l = 0; $l <= $iteraciones; $l++) {
                            $repetido = false;
                            foreach ($vs as $keyVs => $valueVs) {
                                // comprobar repetidos
                                $previo = array($jugadores[$i], $jugadores[$j], $jugadores[$k], $jugadores[$l]);
                                $comprobado = array_unique($previo);
                                if (count($comprobado) == $grupo) {
                                    if (count(array_diff($valueVs, array($jugadores[$i], $jugadores[$j], $jugadores[$k], $jugadores[$l]))) < $_POST['factor']) {
                                        $repetido = true;
                                    }
                                } else {
                                    $repetido = true;
                                }
                            }
                            if (!$repetido) {
                                $duelo = array($jugadores[$i], $jugadores[$j], $jugadores[$k], $jugadores[$l]);
                                if (count($duelo) == $grupo) {
                                    $vs[] = $duelo;
                                }
                            }
                        }
                    }
                }
            }
            $i = 1;
            shuffle($vs);
            foreach ($vs as $value) {
                $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES ($i, " . $leagueId . ", " . $value[0] . ")";
                $connection->query($insVs);
                $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES ($i, " . $leagueId . ", " . $value[1] . ")";
                $connection->query($insVs);
                $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES ($i, " . $leagueId . ", " . $value[2] . ")";
                $connection->query($insVs);
                $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES ($i, " . $leagueId . ", " . $value[3] . ")";
                $connection->query($insVs);
                $i++;
            }
        }

        if ($grupo == 1) {
            foreach ($jugadores as $value) {
                $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (1, " . $leagueId . ", " . $value . ")";
                $connection->query($insVs);
            }
        }
        if ($grupo == 2) {
            $totalRounds  = 1;
            $totalTeams = count($jugadores);
            $vs = 1;

            // Crear una lista de todos los enfrentamientos posibles
            $enfrentamientos = array();

            for ($homeTeam = 0; $homeTeam < $totalTeams - 1; $homeTeam++) {
                for ($awayTeam = $homeTeam + 1; $awayTeam < $totalTeams; $awayTeam++) {
                    $enfrentamientos[] = array('home' => $homeTeam, 'away' => $awayTeam);
                }
            }

            // Barajar los enfrentamientos
            shuffle($enfrentamientos);

            for ($round = 1; $round < $totalRounds + 1; $round++) {
                foreach ($enfrentamientos as $enfrentamiento) {
                    $homeTeam = $enfrentamiento['home'];
                    $awayTeam = $enfrentamiento['away'];

                    $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES ($vs, " . $leagueId . ", " . $jugadores[$homeTeam] . ")";
                    $connection->query($insVs);
                    $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES ($vs, " . $leagueId . ", " . $jugadores[$awayTeam] . ")";
                    $connection->query($insVs);
                    $vs++;
                }
            }
        }

        if ($grupo == 3 && count($jugadores) == 4) {
            // Inicializa el array de duelos
            $vs = array();
            $duelosMaximos = 4;
            $maxDuelosPorJugador = 3;
            $maxDuelosContraJugador = 2;
        
            // Genera todas las combinaciones posibles de jugadores para los duelos
            for ($i = 0; $i < count($jugadores); $i++) {
                for ($j = $i + 1; $j < count($jugadores); $j++) {
                    for ($k = $j + 1; $k < count($jugadores); $k++) {
                        $vs[] = array($jugadores[$i], $jugadores[$j], $jugadores[$k]);
                    }
                }
            }
        
            $finalVs = array();
            $duelosPorJugador = array_fill(0, count($jugadores), 0);
            $duelosEntreJugadores = array();
        
            // Inicializa el array de duelos entre jugadores
            for ($i = 0; $i < count($jugadores); $i++) {
                for ($j = $i + 1; $j < count($jugadores); $j++) {
                    $duelosEntreJugadores[$i][$j] = 0;
                    $duelosEntreJugadores[$j][$i] = 0;
                }
            }
        
            shuffle($vs);
        
            foreach ($vs as $duelo) {
                $puedeAñadir = true;
                foreach ($duelo as $jugador) {
                    if ($duelosPorJugador[array_search($jugador, $jugadores)] >= $maxDuelosPorJugador) {
                        $puedeAñadir = false;
                        break;
                    }
                }
                if ($puedeAñadir) {
                    for ($i = 0; $i < count($duelo); $i++) {
                        for ($j = $i + 1; $j < count($duelo); $j++) {
                            if ($duelosEntreJugadores[array_search($duelo[$i], $jugadores)][array_search($duelo[$j], $jugadores)] >= $maxDuelosContraJugador) {
                                $puedeAñadir = false;
                                break 2;
                            }
                        }
                    }
                }
                if ($puedeAñadir) {
                    $finalVs[] = $duelo;
                    foreach ($duelo as $jugador) {
                        $duelosPorJugador[array_search($jugador, $jugadores)]++;
                    }
                    for ($i = 0; $i < count($duelo); $i++) {
                        for ($j = $i + 1; $j < count($duelo); $j++) {
                            $duelosEntreJugadores[array_search($duelo[$i], $jugadores)][array_search($duelo[$j], $jugadores)]++;
                            $duelosEntreJugadores[array_search($duelo[$j], $jugadores)][array_search($duelo[$i], $jugadores)]++;
                        }
                    }
                }
                if (count($finalVs) == $duelosMaximos) {
                    break;
                }
            }
        
            // Insertar los duelos en la base de datos
            $i = 1;
            foreach ($finalVs as $duelo) {
                foreach ($duelo as $jugador) {
                    $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES ($i, $leagueId, $jugador)";
                    $connection->query($insVs);
                }
                $i++;
            }
        }
        if ($grupo == 3 && count($jugadores) == 10) {
            // Definimos que estamos trabajando con 3VS y 10 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 10;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (30 enfrentamientos en total)
    $enfrentamientos = [
    [1, 2, 3],
    [8, 9, 0],
    [7, 5, 6],
    [0, 3, 4],
    [1, 7, 5],
    [6, 9, 8],
    [2, 4, 7],
    [1, 3, 6],
    [5, 4, 0],
    [1, 4, 6],
    [2, 5, 9],
    [3, 7, 8],
    [1, 4, 9],
    [2, 3, 0],
    [5, 8, 1],
    [6, 9, 3],
    [7, 0, 1],
    [8, 6, 4],
    [9, 1, 0],
    [2, 4, 8],
    [2, 5, 6],
    [3, 7, 8],
    [2, 6, 0],
    [3, 4, 5],
    [2, 7, 9],
    [3, 5, 9],
    [7, 4, 9],
    [8, 5, 0],
    [6, 0, 7],
    [1, 2, 8]

    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //3 VS 12
        if ($grupo == 3 && count($jugadores) == 12) {
            // Definimos que estamos trabajando con 3VS y 12 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 12;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (44 enfrentamientos en total)
    $enfrentamientos = [
    [3, 7, 11],
    [1, 2, 0],
    [8, 11, 6],
    [1, 3, 4],
    [0, 7, 5],
    [2, 9, 10],
    [6, 4, 0],
    [1, 5, 9],
    [5, 7, 8],
    [1, 7, 11],
    [2, 6, 10],
    [1, 10, 11],
    [2, 11, 9],
    [4, 3, 0],
    [2, 8, 6],
    [5, 8, 3],
    [4, 9, 1],
    [3, 5, 11],
    [4, 7, 10],
    [3, 6, 9],
    [1, 8, 10],
    [3, 6, 0],
    [3, 7, 10],
    [9, 4, 5],
    [2, 7, 4],
    [1, 8, 0],
    [6, 4, 11],
    [4, 8, 10],
    [6, 1, 7],
    [3, 9, 10],
    [4, 8, 11],
    [2, 7, 0],
    [5, 6, 10],
    [7, 9, 8],
    [2, 5, 11],
    [6, 7, 9],
    [8, 9, 0],
    [1, 6, 5],
    [11, 0, 9],
    [2, 5, 4],
    [10, 11, 0],
    [1, 2, 3],
    [5, 0, 10],
    [3, 2, 8]
    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //3 VS 13
        if ($grupo == 3 && count($jugadores) == 13) {
            // Definimos que estamos trabajando con 3VS y 13 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 13;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (52 enfrentamientos en total)
    $enfrentamientos = [
    [1, 2, 3],
    [11, 12, 0],
    [8, 7, 10],
    [5, 9, 11],
    [2, 4, 6],
    [1, 3, 0],
    [2, 9, 12],
    [1, 8, 10],
    [6, 7, 8],
    [4, 9, 11],
    [3, 5, 0],
    [1, 2, 11],
    [5, 10, 12],
    [1, 6, 7],
    [4, 8, 12],
    [5, 9, 3],
    [2, 7, 0],
    [4, 10, 11],
    [1, 6, 11],
    [8, 12, 9],
    [3, 4, 7],
    [2, 5, 8],
    [6, 0, 10],
    [9, 1, 7],
    [6, 11, 12],
    [3, 8, 4],
    [2, 5, 7],
    [3, 9, 10],
    [8, 11, 0],
    [1, 5, 12],
    [4, 5, 6],
    [3, 7, 11],
    [2, 6, 9],
    [5, 10, 0],
    [1, 8, 9],
    [4, 7, 12],
    [8, 3, 11],
    [2, 4, 10],
    [6, 0, 9],
    [7, 5, 11],
    [1, 10, 12],
    [8, 2, 0],
    [3, 6, 10],
    [4, 9, 0],
    [1, 4, 5],
    [7, 9, 10],
    [11, 2, 10],
    [7, 12, 0],
    [5, 6, 8],
    [6, 12, 3],
    [1, 0, 4],
    [3, 2, 12]
    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //3 VS 7
        if ($grupo == 3 && count($jugadores) == 7) {
            // Definimos que estamos trabajando con 3VS y 7 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 7;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (14 enfrentamientos en total)
    $enfrentamientos = [
    [1, 4, 3],
    [1, 3, 0],
    [4, 5, 6],
    [1, 4, 6],
    [2, 1, 5],
    [2, 4, 0],
    [4, 5, 0],
    [1, 2, 5],
    [6, 7, 1],
    [2, 3, 6],
    [3, 2, 4],
    [3, 5, 0],
    [5, 6, 3],
    [2, 6, 7]
    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //3 VS 6
        if ($grupo == 3 && count($jugadores) == 6) {
            // Definimos que estamos trabajando con 3VS y 6 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 6;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (10 enfrentamientos en total)
    $enfrentamientos = [
    [1, 2, 3],
    [1, 4, 5],
    [2, 1, 0],
    [3, 5, 0],
    [2, 4, 3],
    [2, 5, 0],
    [4, 1, 0],
    [4, 2, 5],
    [3, 4, 0],
    [1, 3, 5]
    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //3 VS 9
        if ($grupo == 3 && count($jugadores) == 9) {
            // Definimos que estamos trabajando con 3VS y 9 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 9;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (24 enfrentamientos en total)
    $enfrentamientos = [
    [1, 2, 3],
    [6, 4, 5],
    [8, 1, 0],
    [3, 6, 7],
    [2, 4, 1],
    [3, 5, 8],
    [7, 1, 0],
    [4, 2, 6],
    [5, 6, 8],
    [7, 0, 5],
    [8, 2, 3],
    [1, 6, 7],
    [4, 8, 0],
    [2, 5, 7],
    [3, 4, 0],
    [1, 8, 6],
    [2, 5, 0],
    [7, 4, 8],
    [1, 5, 3],
    [2, 6, 0],
    [4, 3, 7],
    [1, 4, 5],
    [2, 7, 8],
    [6, 0, 3]
    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //3 VS 15
        if ($grupo == 3 && count($jugadores) == 15) {
            // Definimos que estamos trabajando con 3VS y 15 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 15;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (70 enfrentamientos en total)
    $enfrentamientos = [
    [1, 2, 3],
    [0, 4, 5],
    [8, 6, 7],
    [1, 9, 14],
    [10, 11, 0],
    [2, 9, 12],
    [3, 5, 13],
    [4, 14, 6],
    [3, 11, 8],
    [8, 9, 12],
    [1, 7, 14],
    [2, 5, 8],
    [7, 10, 9],
    [12, 13, 0],
    [2, 4, 10],
    [12, 3, 6],
    [2, 11, 1],
    [5, 10, 14],
    [0, 9, 8],
    [4, 7, 12],
    [1, 6, 11],
    [3, 14, 0],
    [6, 10, 13],
    [8, 11, 14],
    [1, 13, 4],
    [2, 3, 12],
    [5, 6, 0],
    [14, 9, 7],
    [8, 10, 1],
    [6, 11, 12],
    [7, 13, 0],
    [4, 2, 14],
    [9, 0, 1],
    [4, 0, 6],
    [14, 11, 13],
    [9, 6, 2],
    [1, 8, 0],
    [3, 9, 10],
    [2, 10, 0],
    [3, 4, 7],
    [13, 5, 10],
    [4, 3, 8],
    [12, 0, 7],
    [3, 6, 10],
    [2, 13, 7],
    [8, 4, 12],
    [11, 7, 5],
    [4, 10, 11],
    [1, 13, 3],
    [9, 11, 5],
    [8, 13, 2],
    [1, 6, 7],
    [12, 14, 5],
    [6, 9, 13],
    [7, 10, 8],
    [1, 12, 10],
    [0, 11, 2],
    [3, 9, 5],
    [8, 14, 13],
    [11, 4, 9],
    [1, 5, 12],
    [3, 11, 7],
    [12, 14, 10],
    [11, 12, 13],
    [2, 6, 14],
    [5, 4, 1],
    [14, 0, 3],
    [5, 2, 7],
    [13, 4, 9],
    [6, 5, 8]
    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //3 VS 16
        if ($grupo == 3 && count($jugadores) == 16) {
            // Definimos que estamos trabajando con 3VS y 16 jugadores
$grupo = 3;  // Tamaño de grupo para cada enfrentamiento (3 jugadores)
$totalJugadores = 16;  // Total de jugadores en la liga

// Recuperar los jugadores de la tabla de participantes
$sqlJugadores = "SELECT users.id, users.username FROM participantes
                LEFT JOIN users ON participantes.ptusrid = users.id
                WHERE participantes.ptleagid = $leagueId";
$resultJugadores = $connection->query($sqlJugadores);

$jugadores = array();  // Aquí almacenamos los jugadores registrados
while ($rowJugador = $resultJugadores->fetch_array(MYSQLI_ASSOC)) {
    $jugadores[] = array('id' => $rowJugador['id'], 'username' => $rowJugador['username']);
}

// Verificamos que el número de jugadores sea correcto
if (count($jugadores) == $totalJugadores) {
    // Lista predefinida de enfrentamientos de 3 jugadores cada uno (80 enfrentamientos en total)
    $enfrentamientos = [
    [1, 3, 2],
    [0, 14, 15],
    [4, 9, 11],
    [5, 6, 8],
    [7, 12, 15],
    [10, 13, 5],
    [2, 1, 11],
    [0, 14, 3],
    [4, 11, 10],
    [6, 9, 13],
    [8, 7, 0],
    [2, 15, 10],
    [5, 14, 12],
    [1, 13, 3],
    [6, 4, 15],
    [5, 11, 9],
    [13, 8, 14],
    [4, 7, 12],
    [0, 3, 15],
    [2, 4, 14],
    [6, 10, 13],
    [5, 15, 4],
    [1, 7, 6],
    [8, 9, 12],
    [11, 0, 13],
    [3, 4, 7],
    [14, 2, 6],
    [5, 12, 1],
    [7, 0, 10],
    [15, 3, 14],
    [4, 9, 13],
    [8, 10, 1],
    [12, 11, 6],
    [2, 7, 5],
    [0, 1, 4],
    [10, 3, 6],
    [13, 11, 14],
    [1, 15, 9],
    [3, 4, 8],
    [2, 9, 12],
    [14, 1, 7],
    [15, 5, 6],
    [8, 0, 10],
    [11, 3, 7],
    [1, 4, 13],
    [2, 8, 5],
    [7, 10, 9],
    [11, 12, 0],
    [4, 14, 6],
    [7, 13, 15],
    [1, 10, 12],
    [11, 3, 8],
    [6, 2, 0],
    [14, 10, 5],
    [8, 9, 15],
    [4, 10, 2],
    [7, 11, 5],
    [8, 2, 13],
    [14, 1, 9],
    [3, 6, 12],
    [0, 5, 4],
    [2, 12, 3],
    [11, 15, 10],
    [2, 7, 13],
    [8, 4, 12],
    [1, 6, 11],
    [3, 9, 10],
    [11, 14, 8],
    [3, 5, 13],
    [6, 9, 0],
    [2, 11, 15],
    [6, 7, 8],
    [0, 12, 13],
    [1, 8, 15],
    [2, 0, 9],
    [15, 12, 13],
    [14, 9, 7],
    [1, 5, 0],
    [10, 12, 14],
    [3, 5, 9]
    ];

    // Insertar los enfrentamientos en la base de datos utilizando los IDs de los jugadores
    foreach ($enfrentamientos as $i => $duelo) {
        foreach ($duelo as $jugadorIndex) {
            $jugadorId = $jugadores[$jugadorIndex]['id'];
            $insVs = "INSERT INTO versus (ennumvs, enlgid, enusrid) VALUES (" . ($i + 1) . ", " . $leagueId . ", " . $jugadorId . ")";
            $connection->query($insVs);
        }
    }
} else {
    echo "Error: el número de jugadores no coincide con el total esperado de $totalJugadores.";
}
            
        
        }
        //      
        break;

    case 'COM':
        break;
    case 'TOR':
        $vsTot = $rowLiga['lgnumpart'] - 1;
        $fasesTot = intval(log($rowLiga['lgnumpart'], 2));
        $resto = $rowLiga['lgnumpart'] - pow(2, $fasesTot);
        $asimetrico = false;
        if ($resto > 0) {
            $fasesTot++;
            $asimetrico = true;
            $jugadoresFase1 = array_slice($jugadores, 0, $resto * 2);
            $jugadoresFase2 = array_slice($jugadores, $resto * 2);
        }
        $vs = 1;
        $fase = 1;
        $segundo = false;
        while ($fase <= $fasesTot) {
            if ($fase == 1) {
                if ($asimetrico) {
                    foreach ($jugadoresFase1 as $value) {
                        $insVs = "INSERT INTO versusTor (vsidtor, vsnumvs, vswinvs, vsidusr, vstxtvs, vstfase) VALUES (" . $leagueId . ", $vs, 0, " . $value . ", 'FASE " . $fase . "', $fase)";
                        $connection->query($insVs);
                        if ($segundo) {
                            $jugadoresFase2["VS$vs"] = $vs;
                            $vs++;
                            $segundo = false;
                        } else {
                            $segundo = true;
                        }
                    }
                } else {
                    foreach ($jugadores as $value) {
                        $insVs = "INSERT INTO versusTor (vsidtor, vsnumvs, vswinvs, vsidusr, vstxtvs, vstfase) VALUES (" . $leagueId . ", $vs, 0, " . $value . ", 'FASE " . $fase . "', $fase)";
                        $connection->query($insVs);
                        if ($segundo) {
                            $vsFase[$fase + 1][] = $vs;
                            $vs++;
                            $segundo = false;
                        } else {
                            $segundo = true;
                        }
                    }
                }
            } else {
                if ($asimetrico && $fase == 2) {
                    foreach ($jugadoresFase2 as $key => $value) {
                        if (strpos($key, 'VS') === false) {
                            $insVs = "INSERT INTO versusTor (vsidtor, vsnumvs, vswinvs, vsidusr, vstxtvs, vstfase) VALUES (" . $leagueId . ", $vs, 0, " . $value . ", 'FASE " . $fase . "', $fase)";
                        } else {
                            $insVs = "INSERT INTO versusTor (vsidtor, vsnumvs, vswinvs, vsidusr, vstxtvs, vstfase) VALUES (" . $leagueId . ", $vs, " . $value . ", 0, 'FASE " . $fase . "', $fase)";
                        }
                        $connection->query($insVs);
                        if ($segundo) {
                            $vsFase[$fase + 1][] = $vs;
                            $vs++;
                            $segundo = false;
                        } else {
                            $segundo = true;
                        }
                    }
                } else {
                    foreach ($vsFase[$fase] as $value) {
                        $insVs = "INSERT INTO versusTor (vsidtor, vsnumvs, vswinvs, vsidusr, vstxtvs, vstfase) VALUES (" . $leagueId . ", $vs, " . $value . ", 0, 'FASE " . $fase . "', $fase)";
                        $connection->query($insVs);
                        if ($segundo) {
                            $vsFase[$fase + 1][] = $vs;
                            $vs++;
                            $segundo = false;
                        } else {
                            $segundo = true;
                        }
                    }
                }
            }
            $fase++;
        }
        break;
}

$updLea = "UPDATE league set lgready = 1 where lgid = " . $leagueId . ";";
$connection->query($updLea);
$json['RESPONSE'] = 'SUCCESS';

echo json_encode($json);