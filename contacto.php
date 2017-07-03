<?php

// El mensaje
$mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";

// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");

// Enviarlo
// mail('amperezz@unal.edu.co', 'Mi título', $mensaje);

include('partials/head.php');
include('partials/nav.php');
?>
<main class="detalle">

				<p id= 'p-inicio' align='justify'>
					<font color="green"><h1>Contacto</h1></font>
					<!-- <h2>Si desea contactarse con nosotros, por favor utilice la siguiente información:</h2> -->
					<br><br>
					<div class= "titulos">Grupo de Ambientes Inteligentes Adaptativos - GAIA</div><br>
					<br>
					<font size="3">
					<b>Nestor Dario Duque Mendez</b></font><br><br>
					Universidad Nacional de Colombia-Sede Manizales
					<br>
					Correo Electronico: <font color="green">ndduqueme@unal.edu.co</font><br>
					<br>
					<br>
					<div class= "titulos">Currículo, universidad y empresa- CUE</div><br>
					<br>
					<font size="3">
					<b>Raul Munevar</b></font><br><br>
					Universidad de Caldas
					<br>
					Correo Electronico: <font color="green">ramumo11@gmail.com</font><br>

				</p>
</main>
<?php
  include_once("analyticstracking.php");
include('funcionesphp/sessionJS.php');
	include('partials/pie.html');
?>
