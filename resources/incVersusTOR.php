<?php if (!$row['lgready']) { ?>
    <div class="col-md-3 col-sm-6 d-grid gap-2 my-3">
        <button class="btn btn btn-outline-success" type="button" id="butCreaVs" <?php echo ($row['partAdd'] == $row['lgnumpart'] ? '' : 'disabled'); ?> data-id="<?php echo $row['lgid']; ?>" tkey="butCreaVs"></button>
    </div>
<?php
} else {
    $faseTot = intval(log($row['lgnumpart'], 2));
        $resto = $row['lgnumpart'] - pow(2, $faseTot);
        $asimetrico = false;
        if ($resto > 0) {
            $faseTot++;
            $asimetrico = true;
        }
?>
    <div class="row col-md-10 col-sm-11 my-2">
        <div class="accordion">
            <?php
            $fase = 1;
            while ($fase <= $faseTot) {
                switch (true) {
                    case $fase == $faseTot:
                        $txtfase = 'FINAL';
                        break;
                    case $fase == $faseTot - 1:
                        $txtfase = 'SEMIFINAL';
                        break;
                    default:
                        $txtfase = 'FASE ' . $fase;
                        break;
                }
            ?>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headFase<?php echo $fase; ?>">
                        <button class="accordion-button collapsed text-center" role="button" type="button" data-bs-toggle="collapse" data-bs-target="#divFase<?php echo $fase; ?>" aria-expanded="true" aria-controls="divFase<?php echo $fase; ?>">
                            <?php echo $txtfase; ?>
                        </button>
                    </h2>
                    <div id="divFase<?php echo $fase; ?>" class="accordion-collapse collapse" aria-labelledby="headFase<?php echo $fase; ?>">
                        <div class="accordion-body">
                            <div class="row my-2">
                                <?php
                                $numvs = 0;
                                $segundo = false;
                                $sqlVs = "SELECT * FROM versusTor LEFT JOIN users on users.id = vsidusr WHERE vsidtor = " . $row['lgid'] . " and vstfase = $fase;";
                                $resVs = $connection->query($sqlVs);
                                $dataVs = array();
                                while ($rowVs = $resVs->fetch_array(MYSQLI_ASSOC)) {
                                    if (!$segundo) {
                                        $dataVs['USR1'] = ($rowVs['username'] != '' ? $rowVs['username'] : 'Winner ' . $rowVs['vswinvs']);
                                        $dataVs['PNT1'] = $rowVs['vspuntos'];
                                        $dataVs['ID1'] = $rowVs['vsidusr'];
                                        $dataVs['W1'] = $rowVs['vswinvs'];
                                        $segundo = true;
                                    } else {
                                        $dataVs['USR2'] = ($rowVs['username'] != '' ? $rowVs['username'] : 'Winner ' . $rowVs['vswinvs']);
                                        $dataVs['PNT2'] = $rowVs['vspuntos'];
                                        $dataVs['ID2'] = $rowVs['vsidusr'];
                                        $dataVs['W2'] = $rowVs['vswinvs'];
                                        $dataVs['VS'] = $rowVs['vsnumvs'];
                                        $segundo = false;
                                        $disableVS = 'disabled';
                                        if ($dataVs['ID1'] > 0 && $dataVs['ID2'] > 0) {
                                            $disableVS = '';
                                        }
                                ?>
                                        <div class="col-lg-5 col-sm-12 fs-5 mx-auto border rounded border-danger my-2 py-2">
                                            <span class="position-absolute translate-middle badge bg-dark torBadge">
                                                <?php echo $dataVs['VS']; ?>
                                            </span>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <p class="" id="lblW<?php echo $dataVs['W1']; ?>"><?php echo $dataVs['USR1']; ?></p>
                                                </div>
                                                <div class="col-4">
                                                    <input type="number" class="form-control form-control-sm input updPuntosTor text-center" value="<?php echo $dataVs['PNT1']; ?>" vs="<?php echo $dataVs['VS']; ?>" idusr="<?php echo $dataVs['ID1']; ?>" lg="<?php echo $row['lgid']; ?>" id="inpW<?php echo $dataVs['W1']; ?>" min=0 >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <p class="" id="lblW<?php echo $dataVs['W2']; ?>"><?php echo $dataVs['USR2']; ?></p>
                                                </div>
                                                <div class="col-4">
                                                    <input type="number" class="form-control form-control-sm input updPuntosTor text-center" value="<?php echo $dataVs['PNT2']; ?>" vs="<?php echo $dataVs['VS']; ?>" idusr="<?php echo $dataVs['ID2']; ?>" lg="<?php echo $row['lgid']; ?>" id="inpW<?php echo $dataVs['W2']; ?>" min=0 >
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $fase++;
            }

            ?>

        </div>
    </div>

<?php
}
?>