
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



<body id="table">
  <main class="detalle">
      <div>
        <!--Muestra el contenido del curso  -->
            <div class="w3-container">
                    <div id="id06" class="w3-modal">
                            <div class="w3-modal-content w3-card-4 w3-animate-zoom " style="max-width:600px">

                                    <div class="w3-center"><br>
                                      <span onclick="document.getElementById('id06').style.display='none';$('#id06').stop(true, true);"
                                       class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Cerrar" >&times;
                                     </span>
                                      <img src="/chaea/images/addCourse.png" class="img img-responsive img-circle center-block">
                                    </div>
                                      <br><div id="InfoElement" class=" text-justify w3-container Info  text-left"></div>

                                    <div class="w3-container w3-light-white w3-padding">
                                         <button class="w3-btn w3-right w3-green"
                                         onclick="document.getElementById('id06').style.display='none';"
                                         id = "acept">Aceptar</button><dd>
                                    </div>
                            </div>
                    </div>
            </div>
      </div>
  </main>
</body>
