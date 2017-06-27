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

<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<style>
.borrar {display:none}
</style>
    <div class="w3-container">
        <div id="id04" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom">
                <header class="w3-container w3-blue">
                     <span onclick="document.getElementById('id04').style.display='none'"
                      class="w3-button w3-red w3-xlarge w3-display-topright">&times;</span>
                     <h1>Info <i class="fa fa-info-circle" aria-hidden="true"></i></h1>
                </header>
                <div class="w3-bar w3-border-bottom">
                      <button class="tablink w3-bar-item w3-button" onclick="modalInfo(event, 'InfoUser')"></button>
                </div>
          <!--Este div contendra toda la info que se requiera -->
                <div id="InfoUser" class="w3-container Info"></div>

                <div class="w3-container w3-light-white w3-padding">
                     <button class="w3-btn w3-right w3-green"
                     onclick="document.getElementById('id04').style.display='none';"
                     id = "acep">Aceptar</button><dd>
                </div>
             </div>
        </div>
    </div>

<script>

document.getElementsByClassName("tablink")[0].click();

function modalInfo(evt, InfoUser) {
  var i, x, tablinks;
  x = document.getElementsByClassName("Info");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].classList.remove("w3-light-white");
  }
  document.getElementById(InfoUser).style.display = "block";
  evt.currentTarget.classList.add("w3-light-white");
}
</script>
</form>
