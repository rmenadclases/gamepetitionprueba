<?php
// Verificar si el usuario actual es el creador de la liga
$isCreator = ($_SESSION['id'] == $row['lgcreaid']);
$leagueFinalized = ($row['lgend'] == 1); // Verificar si la liga está finalizada
?>

<?php if (!$row['lgready']) { ?>
    <div class="col-md-3 col-sm-6 d-grid gap-2 my-3">
        <!-- Campos ocultos -->
        <input type="hidden" name="lgtipduel" value="<?php echo $row['lgtipduel']; ?>">
            <input type="hidden" name="lgtipo" value="<?php echo $row['lgtipo']; ?>">
            <input type="hidden" name="lgid" value="<?php echo $row['lgid']; ?>">
        <button class="btn btn-outline-success" type="button" id="butCreaVs" <?php echo ($row['partAdd'] == $row['lgnumpart'] ? '' : 'disabled'); ?> data-id="<?php echo $row['lgid']; ?>" tkey="butCreaVs">Crear Versus</button>
        
    </div>
<?php } else {
    if ($row['lgtipduel'] == '4VS') {
        $sqlNumVs = "SELECT MAX(ennumvs) AS numVS FROM versus WHERE enlgid = " . $row['lgid'] . ";";
        $resNumVs = $connection->query($sqlNumVs);
        $rowNumVs = $resNumVs->fetch_array(MYSQLI_ASSOC);

        for ($i = 1; $i <= $rowNumVs['numVS']; $i++) {
            $vs = array();
            $ids = array();
            $puntos = array();
            $marcadores = array();
            $sqlVs = "SELECT * FROM versus LEFT JOIN users ON enusrid = users.id WHERE enlgid = " . $row['lgid'] . " AND ennumvs = $i;";
            $resVs = $connection->query($sqlVs);
            while ($rowVs = $resVs->fetch_array(MYSQLI_ASSOC)) {
                $vs[] = $rowVs['username'];
                $ids[] = $rowVs['id'];
                $puntos[] = $rowVs['enpuntos'];
                // Verifica si hay marcador definido, de lo contrario, establece el valor predeterminado a 0
                $marcadores[] = isset($rowVs['enmarcador']) ? $rowVs['enmarcador'] : 0;
            }
?>
            <div class="row col-md-10 col-sm-11 my-2 border rounded p-3">
                <div class="col-1 me-auto my-auto text-center">
                    <p class="fw-bold fs-4 mb-0"><?php echo $i ?>.</p>
                </div>
                <?php for ($j = 0; $j < 4; $j++) { ?>
                    <div class="col my-auto text-center">
                        <p class="mb-2"><strong><?php echo $vs[$j] ?></strong></p>
                        <div class="mb-3">
                            <label for="updPuntos" class="form-label" tkey="puntos"></label>
                            <?php if ($isCreator) { ?>
                                <input type="number" tkey="puntos" class="form-control input updPuntos text-center" value="<?php echo $puntos[$j]; ?>" vs="<?php echo $i; ?>" id="<?php echo $ids[$j]; ?>" lg="<?php echo $row['lgid']; ?>" min="0" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                            <?php } else { ?>
                                <p class="form-control-plaintext text-center"><?php echo $puntos[$j]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="updMarcador" class="form-label" tkey="marcador"></label>
                            <?php if ($isCreator) { ?>
                                <input type="text" class="form-control input updMarcador text-center" value="<?php echo $marcadores[$j]; ?>" vs="<?php echo $i; ?>" id="<?php echo $ids[$j]; ?>" lg="<?php echo $row['lgid']; ?>" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                            <?php } else { ?>
                                <p class="form-control-plaintext text-center"><?php echo $marcadores[$j]; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
<?php
        }
    } elseif ($row['lgtipduel'] == 'CMP') {
        $sqlNumVs = "SELECT * FROM versus LEFT JOIN users ON enusrid = users.id WHERE enlgid = " . $row['lgid'] . " AND ennumvs = 1 ORDER BY username;";
        $resNumVs = $connection->query($sqlNumVs);
        while ($rowNumVs = $resNumVs->fetch_array(MYSQLI_ASSOC)) {
?>
            <div class="row col-md-10 col-sm-11 my-2 border rounded p-3">
                <div class="col me-auto my-auto text-center">
                    <p class="fw-bold fs-4 mb-0"><strong><?php echo $rowNumVs['username'] ?></strong></p>
                </div>
                <div class="col my-auto text-center">
                    <div class="mb-3">
                        <label for="updPuntos" class="form-label">Puntos</label>
                        <?php if ($isCreator) { ?>
                            <input type="number" class="form-control input updPuntos text-center" value="<?php echo $rowNumVs['enpuntos']; ?>" vs="1" id="<?php echo $rowNumVs['id']; ?>" lg="<?php echo $row['lgid']; ?>" min="0" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                        <?php } else { ?>
                            <p class="form-control-plaintext text-center"><?php echo $rowNumVs['enpuntos']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="updMarcador" class="form-label">Marcador</label>
                        <?php 
                            // Verifica si hay marcador definido, de lo contrario, establece el valor predeterminado a 0
                            $defaultMarcador = isset($rowNumVs['enmarcador']) ? $rowNumVs['enmarcador'] : 0;
                        ?>
                        <?php if ($isCreator) { ?>
                            <input type="text" class="form-control input updMarcador text-center" value="<?php echo $defaultMarcador; ?>" vs="1" id="<?php echo $rowNumVs['id']; ?>" lg="<?php echo $row['lgid']; ?>" min="0" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                        <?php } else { ?>
                            <p class="form-control-plaintext text-center"><?php echo $defaultMarcador; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
<?php
        }
    } elseif ($row['lgtipduel'] == '1VS') {
        $sqlNumVs = "SELECT MAX(ennumvs) AS numVS FROM versus WHERE enlgid = " . $row['lgid'] . ";";
        $resNumVs = $connection->query($sqlNumVs);
        $rowNumVs = $resNumVs->fetch_array(MYSQLI_ASSOC);

        for ($i = 1; $i <= $rowNumVs['numVS']; $i++) {
            $vs = array();
            $ids = array();
            $puntos = array();
            $marcadores = array();
            $sqlVs = "SELECT * FROM versus LEFT JOIN users ON enusrid = users.id WHERE enlgid = " . $row['lgid'] . " AND ennumvs = $i;";
            $resVs = $connection->query($sqlVs);
            while ($rowVs = $resVs->fetch_array(MYSQLI_ASSOC)) {
                $vs[] = $rowVs['username'];
                $ids[] = $rowVs['id'];
                $puntos[] = $rowVs['enpuntos'];
                // Verifica si hay marcador definido, de lo contrario, establece el valor predeterminado a 0
                $marcadores[] = isset($rowVs['enmarcador']) ? $rowVs['enmarcador'] : 0;
            }
?>
            <div class="row col-md-10 col-sm-11 my-2 border rounded p-3">
                <div class="col-2 me-auto my-auto text-center">
                    <p class="fw-bold fs-4 mb-0"><strong><?php echo $i."." ?></strong></p>
                </div>
                <?php for ($j = 0; $j < count($vs); $j++) { ?>
                    <div class="col my-auto text-center">
                        <p class="mb-2"><strong><?php echo $vs[$j] ?></strong></p>
                        <div class="mb-3">
                            <label for="updPuntos" class="form-label" tkey="puntos"></label>
                            <?php if ($isCreator) { ?>
                                <input type="number" class="form-control input updPuntos text-center" value="<?php echo $puntos[$j]; ?>" vs="<?php echo $i; ?>" id="<?php echo $ids[$j]; ?>" lg="<?php echo $row['lgid']; ?>" min="0" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                            <?php } else { ?>
                                <p class="form-control-plaintext text-center"><?php echo $puntos[$j]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="updMarcador" class="form-label" tkey="marcador"></label>
                            <?php if ($isCreator) { ?>
                                <input type="text" class="form-control input updMarcador text-center" value="<?php echo $marcadores[$j]; ?>" vs="<?php echo $i; ?>" id="<?php echo $ids[$j]; ?>" lg="<?php echo $row['lgid']; ?>" min="0" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                            <?php } else { ?>
                                <p class="form-control-plaintext text-center"><?php echo $marcadores[$j]; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
<?php
        }
    } elseif ($row['lgtipduel'] == '3VS') {
        $sqlNumVs = "SELECT MAX(ennumvs) AS numVS FROM versus WHERE enlgid = " . $row['lgid'] . ";";
        $resNumVs = $connection->query($sqlNumVs);
        $rowNumVs = $resNumVs->fetch_array(MYSQLI_ASSOC);

        for ($i = 1; $i <= $rowNumVs['numVS']; $i++) {
            $vs = array();
            $ids = array();
            $puntos = array();
            $marcadores = array();
            $sqlVs = "SELECT * FROM versus LEFT JOIN users ON enusrid = users.id WHERE enlgid = " . $row['lgid'] . " AND ennumvs = $i;";
            $resVs = $connection->query($sqlVs);
            while ($rowVs = $resVs->fetch_array(MYSQLI_ASSOC)) {
                $vs[] = $rowVs['username'];
                $ids[] = $rowVs['id'];
                $puntos[] = $rowVs['enpuntos'];
                // Verifica si hay marcador definido, de lo contrario, establece el valor predeterminado a 0
                $marcadores[] = isset($rowVs['enmarcador']) ? $rowVs['enmarcador'] : 0;
            }
?>
            <div class="row col-md-10 col-sm-11 my-2 border rounded p-3">
                <div class="col-1 me-auto my-auto text-center">
                    <p class="fw-bold fs-4 mb-0"><?php echo $i ?>.</p>
                </div>
                <?php for ($j = 0; $j < 3; $j++) { ?>
                    <div class="col my-auto text-center">
                        <p class="mb-2"><strong><?php echo $vs[$j] ?></strong></p>
                        <div class="mb-3">
                            <label for="updPuntos" class="form-label" tkey="puntos"></label>
                            <?php if ($isCreator) { ?>
                                <input type="number" class="form-control input updPuntos text-center" value="<?php echo $puntos[$j]; ?>" vs="<?php echo $i; ?>" id="<?php echo $ids[$j]; ?>" lg="<?php echo $row['lgid']; ?>" min="0" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                            <?php } else { ?>
                                <p class="form-control-plaintext text-center"><?php echo $puntos[$j]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="updMarcador" class="form-label" tkey="marcador"></label>
                            <?php if ($isCreator) { ?>
                                <input type="text" class="form-control input updMarcador text-center" value="<?php echo $marcadores[$j]; ?>" vs="<?php echo $i; ?>" id="<?php echo $ids[$j]; ?>" lg="<?php echo $row['lgid']; ?>" min="0" <?php echo ($leagueFinalized ? 'readonly' : ''); ?>>
                            <?php } else { ?>
                                <p class="form-control-plaintext text-center"><?php echo $marcadores[$j]; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
<?php
        }
    }
}
?>
