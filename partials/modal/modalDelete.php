
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

<form id="deletElement" action="" method="POST">
      <input type="hidden" id="id_element" name="id_element" value="">
      <input type="hidden" id="opcion" name="opcion" value="eliminar">
</form>
      <div class="w3-container">
          <div id="id01" class="w3-modal">
               <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                 <span onclick="document.getElementById('id01').style.display='none'"
                 class="w3-button w3-red w3-xlarge w3-display-topright">&times;</span>
                    <header class="w3-container w3-red">
                     <h1>Eliminar</h1>
                    </header>
                    <button class="tablink w3-bar-item w3-button" onclick="modalElim(event, 'deletElementso')"></button>


                    <div id="deletElementso" class="w3-container borrar">
                     <h3> <div id="elements"> </div></h3>
                     <h4>Recuerda que no existirán copias del mismo una vez eliminado y perderá todo el contenido relacionado.</h4>
                    </div>

                    <div class="w3-container w3-light-white w3-padding">
                      <button class="w3-btn w3-right w3-red" id="deleteElement">Eliminar</button>
                     <button class="w3-btn w3-right w3-green"
                     onclick="document.getElementById('id01').style.display='none'">Close</button><dd>
                    </div>
               </div>
          </div>

      </div>

  <script>

    document.getElementsByClassName("tablink")[0].click();

    function modalElim(evt, deletElementso) {
      var i, x, tablinks;
      x = document.getElementsByClassName("borrar");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < x.length; i++) {
        tablinks[i].classList.remove("w3-light-white");
      }
      document.getElementById(deletElementso).style.display = "block";
      evt.currentTarget.classList.add("w3-light-white");
    }
  </script>
