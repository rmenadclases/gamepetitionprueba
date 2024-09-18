<div class="row justify-content-center mt-4 ligaSub" id="dv_crea_jamboree">
   <div class="col-md-5 col-sm-11">
      <div class="d-flex justify-content-center mb-3">
         <div class="col text-center my-2">
            <img id="lgimg" class="img-fluid" src="images/GamePetition Jamboree Logo NEGRO.png" />
         </div>
      </div>
      <!--Nombre Jamboree -->
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lgjamboreename" class="ligSubMenu" style="color:black"></div>
         </div>

         <div class="col-7">
            <input type="text" class="form-control input" id="jamboreename">
            <div class="line-box">
               <div class="line"></div>
            </div>
         </div>
      </div>
      <!-- Subir Imagen -->
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="imgJamboree" class="ligSubMenu" style="color:black"></div>
         </div>
         <div class="col-7">
            <input type="file" class="form-control input mt-3" id="jamboreeimg" accept="image/*">
         </div>
      </div>
      <!-- Descripción -->
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="lgdescrip" class="ligSubMenu" style="color:black"></div>
         </div>

         <div class="col-7">
            <input type="text" class="form-control input" id="jamboreedescripcion">
            <div class="line-box">
               <div class="line"></div>
            </div>
         </div>
      </div>
      <!--Dirección -->
      <div class="d-flex justify-content-center mb-3">
         <div class="col-5 my-auto">
            <div tkey="direcJamboree" class="ligSubMenu" style="color:black"></div>
         </div>

         <div class="col-7">
            <input type="text" class="form-control input" id="jamboreedireccion">
            <div class="line-box">
               <div class="line"></div>
            </div>
         </div>
      </div>


      <div class="d-flex justify-content-center mb-3" style="background-color: black">
         <div class="col-12 my-auto">
            <div class="row justify-content-between ligSubMenu  selOption text-white py-1" id="butDetails">
               <p class="col-10" tkey="anyadirJamboree" style="color: white"></p>
               <p class="col-2 text-end">
                  <i class="fas fa-plus"></i>
               </p>
            </div>
         </div>
      </div>
      <div style="display: none;" id="divDetails">
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 mb-auto">
               <div tkey="lgdescrip" class="ligSubMenu" style="color:black"></div>
            </div>
            <div class="col-7">
               <textarea class="form-control input" id="lgdescrip" rows="3"></textarea>
               <div class="line-box">
                  <div class="line"></div>
               </div>
            </div>
         </div>




         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 my-auto">
               <div tkey="descJamboree" class="ligSubMenu" style="color:black"></div>
            </div>
            <div class="col-7">
               <input type="number" class="form-control input" id="lgnumpart" min=2>
               <div class="line-box">
                  <div class="line"></div>
               </div>
            </div>
         </div>
         <div class="d-flex justify-content-center mb-3">
            <div class="col-5 my-auto">
               <div tkey="anyadir" class="ligSubMenu"></div>
            </div>
            <div class="col-7">
               <select class="form-select" id="lgtipduel" disabled>
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
               <input type="number" class="form-control input" id="lgvueltas" min=1>
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
               <select class="form-select" id="lglocal">
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
               <select class="form-select" id="lgpriva">
                  <option value="PUB" tkey="publica"></option>
                  <option value="PRI" tkey="privada"></option>
               </select>
            </div>
         </div>
      </div>

      <div class="col-12">
         <div class="d-flex justify-content-center mb-3">
            <div class="col-md-3 col-sm-6 d-grid gap-2">
               <button class="btn btn btn-outline-success" type="button" id="butCreaJamboree" lgtipo="LIG"
                  tkey="butCrea"></button>
            </div>
         </div>
      </div>
   </div>
   </div>