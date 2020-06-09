<?php
		session_start();
		if($_SESSION["regis"]==1){
		session_destroy();
		}else{
			if (("administrator"==$_SESSION["rol"])) {
					header ("Location: /./chaea/adminIndex.php");
			}else if("teacher"==$_SESSION["rol"]){
					// header ("Location: /./chaea/adminIndex.php");
			}else if ("student"==$_SESSION["rol"]){
				// header ("Location: /./chaea/adminIndex.php");s
			}else{
				header ("Location: /./chaea/logingIndex.php");
			}
		}

	include('partials/head.php');
	include('partials/nav.php');
  include('backendPhp/send.php');
  $questionChaea="";
	$questionChaea= questionC();
?>

<!-- Configura el texto, el nav y los formularios -->
<link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">
<body id="fondo">
	<div id="particles-js"></div>
	<!--* Pasar a hoja de estilos -->
	<main class="detalle">
	<div id="question-box" >
					<h3>Fin</h3>
					<div id="ans2">
							<h1 id="finichh1">Se Registró Correctamente <i class="fa fa-thumbs-up" aria-hidden="true"></i></h1>
							<p id="finichP">Pronto recibirá un correo confirmando su activación.</p>
					</div>
		</div>
</main>

	<script src="js/jsn/tabla.js" charset="utf-8"></script>
	<!--este es JSN-->

</body>

<?php
  include_once("analyticstracking.php");
include('backendPhp/sessionJS.php');
  include('partials/pie.html');
?>
