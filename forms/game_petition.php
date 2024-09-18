<div class="row justify-content-center mt-4 ligaSub" id="dv_game_petition" style="display:none">   
   <div class="col-md-5 col-sm-11 form">
      <div class="d-flex justify-content-center mb-3">
         <div class="col text-center my-2">
            <img id="lgimgP" class="img-fluid" src="images/gamepetition.png" />
         </div>
      </div>
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lgname" class="ligSubMenu"></div>
         </div>
         <div class="col-7">
            <input type="text" class="form-control input" id="lgnameP">
            <div class="line-box">
               <div class="line"></div>
            </div>
         </div>
      </div>
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lggame" class="ligSubMenu"></div>
         </div>
         <div class="col-7">
            <select id="lggameSel2" autocomplete="off">
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
            <div tkey="lgnumpart" class="ligSubMenu"></div>
         </div>
         <div class="col-7">
            <input type="number" class="form-control input" id="lgnumpartP" min=2>
            <div class="line-box">
               <div class="line"></div>
            </div>
         </div>
      </div>
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lgtipduel" class="ligSubMenu"></div>
         </div>
         <div class="col-7">
            <select class="form-select" id="lgtipduelP" disabled>
               <option tkey="select"></option>
               <!-- <option>2 Vs</option>
                  <option>3 Vs</option> -->
               <option>4 Vs</option>
               <!-- <option>5 Vs</option> -->
               <option>Campeón de la pista</option>
            </select>
         </div>
      </div>
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lgvueltas" class="ligSubMenu"></div>
         </div>
         <div class="col-7">
            <input type="number" class="form-control input" id="lgvueltasP" min=1>
            <div class="line-box">
               <div class="line"></div>
            </div>
         </div>
      </div>
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lglocal" class="ligSubMenu"></div>
         </div>
         <div class="col-7">
            <select class="form-select" id="lglocalP">
               <option value="ONL" tkey="online"></option>
               <option value="PRE" tkey="presencial"></option>
            </select>
         </div>
      </div>
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lgpriva" class="ligSubMenu"></div>
         </div>
         <div class="col-7">
            <select class="form-select" id="lgprivaP">
               <option value="PUB" tkey="publica"></option>
               <option value="PRI" tkey="privada"></option>
            </select>
         </div>
      </div>
   </div>
   <div class="col-md-5 col-sm-11 mx-2 my-auto form">
      <!-- DETALLES -->
      <div class="d-flex justify-content-center mb-3">
         <div class="col-12 my-auto">
            <div class="row justify-content-between ligSubMenu ligaBg selOption text-white py-1" id="butDetailsP">
               <p class="col-10" tkey="detalles"></p>
               <p class="col-2 text-end">
                  <i class="fas fa-plus"></i>
               </p>
            </div>
         </div>
      </div>
      <div style="display: none;" id="divDetailsP">
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 mb-auto">
               <div tkey="lgdescrip" class="ligSubMenu"></div>
            </div>
            <div class="col-7">
               <textarea class="form-control input" id="lgdescripP" rows="3"></textarea>
               <div class="line-box">
                  <div class="line"></div>
               </div>
            </div>
         </div>
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 mb-auto">
               <div tkey="lgmarcad" class="ligSubMenu"></div>
            </div>
            <div class="col-7">
               <textarea class="form-control input" id="lgmarcadP" rows="3"></textarea>
               <div class="line-box">
                  <div class="line"></div>
               </div>
            </div>
         </div>
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 mb-auto">
               <div tkey="lgdesemp" class="ligSubMenu"></div>
            </div>
            <div class="col-7">
               <textarea class="form-control input" id="lgdesempP" rows="3"></textarea>
               <div class="line-box">
                  <div class="line"></div>
               </div>
            </div>
         </div>
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 mb-auto">
               <div tkey="lgpremio" class="ligSubMenu"></div>
            </div>
            <div class="col-7">
               <textarea class="form-control input" id="lgpremioP" rows="3"></textarea>
               <div class="line-box">
                  <div class="line"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- PARTICIPANTES -->
      <div class="d-flex justify-content-center mb-3">
         <div class="col-12 my-auto">
            <div class="row justify-content-between ligSubMenu ligaBg selOption text-white py-1" id="butParticipP">
               <p class="col-10" tkey="particip"></p>
               <p class="col-2 text-end">
                  <i class="fas fa-plus"></i>
               </p>
            </div>
         </div>
      </div>
      <div style="display: none;" id="divParticipP">
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 my-auto">
               <div tkey="lgaddpart" class="ligSubMenu"></div>
            </div>
            <div class="col-7 ">
               <div class="input-group">
                  <input class="form-control" type="text" list="lgpartlist" id="lgpartP">
                  <datalist id="lgpartlistP">
                     <?php
                        $sqlGames = "select * from users order by name";
                        $resGames = $connection->query($sqlGames);
                        while ($rowGames = $resGames->fetch_array(MYSQLI_ASSOC)) {
                        echo '<option data-id="' . $rowGames['id'] . '" value="' . $rowGames['username'] . '">';
                        }
                        ?>
                  </datalist>
                  <button class="btn btn-outline-success" type="button" id="butAddPartP"><i class="fas fa-plus"></i></button>
               </div>
            </div>
         </div>
         <p class="text-center" tkey="usunoreg"></p>
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 my-auto">
               <div tkey="lgaddpart" class="ligSubMenu"></div>
            </div>
            <div class="col-7 ">
               <div class="input-group">
                  <input class="form-control" type="text" id="lgpartnoreg">
                  <button class="btn btn-outline-success" type="button" id="butAddPartNoreg"><i class="fas fa-plus"></i></button>
               </div>
            </div>
         </div>
         <div id="dipPartAddedP">
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="d-flex justify-content-center mb-3">
         <div class="col-md-3 col-sm-6 d-grid gap-2">
            <button class="btn btn btn-outline-success" type="button" id="butCreaPeti" lgtipoP="PET" tkey="butCrea"></button>
         </div>
      </div>
   </div>
</div>