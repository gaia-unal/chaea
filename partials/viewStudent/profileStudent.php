<?php

if(session_id() == ""){
	session_start();
}

if(!$_SESSION){
    header ("Location: /chaea/logingIndex.php");
}else if (("student"!=$_SESSION["rol"])) {
      header ("Location: /chaea/logingIndex.php");
}
 ?>




<body >
<div id="particles-js"></div>
<main class="detalle">
			<div id="table-boxi" >
						<div id="info_user">
										<div id="info_user_per" class="info_user_cont">
											<p id="info_user_per_title"><?php echo $_SESSION['name_institution']; ?></p>
											<p class="info_user_per_second"><?php echo $_SESSION['name'];  ?></p>
											<!-- <p class="info_user_per_second">Para estudiante</p> -->
										</div>

										<div id="info_user_multi" class="info_user_cont">
											<h4><?php
											foreach ($_SESSION['style'] as $key => $val) {
																 if($key=='ac'){
																	 echo "Activo ";
																 }elseif ($key=='re') {
																	 echo "Reflexivo ";
																 }elseif ($key=='te') {
																	 echo "Teórico ";
																 }elseif ($key=='pa') {
																	 echo "Pragmático ";
																 }
													}
											 ?></h4>
											<div>
												<p>Estudiante</p>
												<!--Elemento boton q permite editar etiqueta -->
												<p><a href="javascript:void(0)" id="btn_profile">Editar perfil
												<i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></p>

											</div>
											<p><img src="/chaea/images/images.png" alt=""></p>
										</div>
						</div>
						<div id="cont_profile_user" style="display: none">
							<!--Aquí se un formulario que permita mostar los datos del ROL-->
							<form action="">
								<?php
						        include(__DIR__.'/../forms/formStudent.php');
						     ?>
							</form>
						</div>

						<?php  include(__DIR__.'/../viewStudent/navControlStudent.html');
						include(__DIR__.'/../modal/modalInfo.php');
						?>



			</div>
</main>
</body>
