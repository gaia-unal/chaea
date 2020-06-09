
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style media="screen">
fieldset {
  padding: 0 !important;
  margin: 0 !important;
  border: 0 !important;
  min-width: 0 !important;
}
main.detalle h1 {
    color: #ffffff;

}

button {
    margin: 2px !important;
}

.borrar {display:none;}

.w3-modal-content {
  margin: auto;
  background-color: #171717;
  color: white;
  position: relative;
  padding: 0;
  outline: 0;
  width: 900px;
}

</style>
<style media="screen">
fieldset {
  padding: 0 !important;
  margin: 0 !important;
  border: 0 !important;
  min-width: 0 !important;
}
main.detalle h1 {
    color: #ffffff;

}

button {
    margin: 2px !important;
}
</style>
<style>
.borrar {display:none}
</style>
    <div class="w3-container">
        <div id="id16" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                <span onclick="document.getElementById('id16').style.display='none'"
                  class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Cerrar">&times;
                </span>
                <header class="w3-container w3-red">
                     <h1>Advertencia <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h1>
                </header>

          <!--Este div contendra toda la info que se requiera -->
                <div id="warningInfos" class="w3-container InfoWarning"></div>

                <div class="w3-container w3-light-white w3-padding">
                     <button class="w3-btn w3-right w3-green"
                     id = "confirmYes">Aceptar</button><dd>
                     <button class="w3-btn w3-right w3-green"
                     onclick="document.getElementById('id16').style.display='none';"
                     id = "close">Cancelar</button><dd>
                </div>
             </div>
        </div>
    </div>


</form>
