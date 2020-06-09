
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style media="screen">
fieldset {
  padding: 0 !important;
  margin: 0 !important;
  border: 0 !important;
  min-width: 0 !important;
}
main.detalle h1, main.detalle h3 {
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

<form id="desElement" action="" method="POST">
      <input type="hidden" id="id_element_des" name="id_element_des" value="">
      <input type="hidden" id="opcion" name="opcion" value="editar">
</form>
      <div class="w3-container">
          <div id="id08" class="w3-modal">
               <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                 <span onclick="document.getElementById('id08').style.display='none'"
                 class="w3-button w3-red w3-xlarge w3-display-topright"  title="Cerrar">&times;</span>

                    <header class="w3-container w3-red">
                     <h1>Desactivar</h1>
                    </header>


                    <!-- Información del Modal -->
                    <div id="desElementso" class="w3-container info">
                     <h3> <div id="elementsDes"> </div></h3>
                     <h4><div id="elementsDesInf"></div></h4>
                    </div>

                    <div class="w3-container w3-light-white w3-padding">
                      <button class="w3-btn w3-right w3-red" id="desaElement">Desactivar</button>
                     <button class="w3-btn w3-right w3-green" id="canDesaEle"
                     onclick="document.getElementById('id08').style.display='none';">Cancelar</button><dd>
                    </div>
               </div>
          </div>

      </div>
