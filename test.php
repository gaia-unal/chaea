<?php
include('partials/head.php');
include('partials/nav.php');
?>
<main class="detalle">
<br>
<br>
    <center>
        <div class= "titulos">CUESTIONARIO HONEY-ALONSO DE ESTILOS DE APRENDIZAJE</div>
    </center>
    <hr color="#566c21">

    <ul>
        <h3><b>Instrucciones:</b></h3>
        <li>Este cuestionario ha sido
            diseñado para identificar su Estilo preferido de
            Aprendizaje. No es un test de inteligencia , ni de
            personalidad</li>
        <li>No hay límite de tiempo para
            contestar al Cuestionario. No le ocupará; más de 15
            minutos.</li>
        <li>No hay respuestas correctas o
            erró;neas. Será; útil en la medida que sea sincero/a en
            sus respuestas.</li>
        <li>Si está más de acuerdo que
            en desacuerdo con el ítem seleccione 'Más (+)'. Si, por el
            contrario, está más en desacuerdo que de acuerdo, seleccione 'Menos (-)'.</li>
        <li>Por favor conteste a todos
            los items.</li>
        <li>El Cuestionario es anónimo.</li>
        <li>Seleccione el test que desea realizar.</li>
        <h3><b>Muchas Gracias</b></h3>
    </ul>
    <div class= "tests">
	    <div class= "test">
        <a class="alo" href="questionChaeaGuest.php">
	    	<img class = "imagen1 "src="images/test.png" href="questionChaeaGuest.php"></a>
        <a href="questionChaeaGuest.php" class="btn btn-success">CHAEA <i class="fa fa-book" aria-hidden="true"></i></a>
      </div>
	    <div class= "test">
        <a class="alo" href="questionChaeaJuniorGuest.php">
	    	<img class = "imagen1 "src="images/chaeaj.png" href="questionChaeaJuniorGuest.php"></a>
        <a href="questionChaeaJuniorGuest.php"class="btn btn-success">CHAEA JUNIOR <i class="fa fa-book" aria-hidden="true"></i></a>
      </div>
    </div>
</main>
<?php
include_once("analyticstracking.php");
include('funcionesphp/sessionJS.php');
include('partials/pie.html');
?>
