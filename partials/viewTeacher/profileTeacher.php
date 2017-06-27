<?php

if(session_id() == ""){
	session_start();
}

if(!$_SESSION){
  header ("Location: ./chaea/logingIndex.php");
}else if (("teacher"!=$_SESSION["rol"])) {
    header ("Location: ./chaea/logingIndex.php");
}
 ?>
 <!-- Configura el efecto del panel de edición del usuario-->
<link rel="stylesheet" href="/chaea/css/perfilusuario.css"/>
<script src="/chaea/js/perfilusuario.js"></script>
<!-- Fin  -->

<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >

<body >
<div id="particles-js"></div>
<main class="detalle">
			<div id="table-box" >
						<div id="info_user">
										<div id="info_user_per" class="info_user_cont">
											<p id="info_user_per_title"><?php echo $_SESSION['name_institution']; ?></p>
											<p class="info_user_per_second"><?php echo $_SESSION['name'];  ?></p>
											<!-- <p class="info_user_per_second">Para estudiante</p> -->
										</div>

										<div id="info_user_multi" class="info_user_cont">
											<div>
												<p>Profesor</p>
												<!--Elemento boton q permite editar etiqueta -->
												<p><a href="javascript:void(0)" id="btn_profile">Editar Perfil
												<i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></p>

											</div>
											<p><img src="/chaea/images/images.png" alt=""></p>
										</div>
						</div>
						<div id="cont_profile_user" style="display: none">
							<!--Aquí se un formulario que permita mostar los datos del ROL-->
							<form action="">
								<?php
						        include(__DIR__.'/../forms/formTeacher.php');
						     ?>
							</form>
						</div>
			</div>
</main>
</body>
