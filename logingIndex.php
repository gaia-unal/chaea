<?php
session_start();
session_destroy();
session_start();
	include('partials/head.php');
	include('partials/nav.php');
  include('funcionesphp/send.php');

?>

<style>


body{
	 		background-color:  rgb(78, 78, 78) !important;
	     font-size: 18px !important;
	     line-height: 1.42857143 !important;
	     color: #fff7f7;


}
div#blanco {
    color: rgb(255, 255, 255);
}
</style>


<div id="particles-js"></div>

		<div class="container">
			<div id="login-box">
				<div class="logo">
					<legend><h1 class="logo-caption">L<span class="tweak"></span><i class="fa fa-cog fa-spin fa-1x fa-fw  tweak" ></i><span class="sr-only">Loading...</span>gin</h1></legend>

					<img src="https://www.khanagadi.com/images/user-icon.png" class="img img-responsive img-circle center-block"/>

				</div><!-- /.logo -->
				<div class="controls">
					<!--Los datos que se toman en este formulario se envían al metodo send.php  -->
					<form class="form-horizontal" method="post" >
					<fieldset>
							<input type="text"  class="form-control"  value="" maxlength="30" required=""  id="nickname" placeholder="Username" onKeyPress="return control4(event)" class="form-control" />
							<input type="password" value="" required="" class="form-control" id="password" placeholder="Contraseña"  maxlength="30"  class="form-control" />
							<div class="checkbox">
								<label>
									<input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'" > <span class="tweak"><div class="fa fa-eye fa-1x" id="blanco"></div></span></label>
							</div>
							<div id="answer"></div>
							<button type="button" class="btn btn-default btn-block btn-custom" onclick="valit()">Login</button>

				 </fieldset>
				 </form>

				</div><!-- /.controls -->
				<button onclick=" location.href='registration.php'" class="btn btn-default btn-block btn-custom">Registrarse</button>
			</div><!-- /#login-box -->
		</div><!-- /.container -->

<script src="js/jsn/controlForm.js"></script><!--Este es JSN-->
<script type="text/javascript">

		 function valit(){
					 var nickname  = document.getElementById('nickname').value;
					 var password  = document.getElementById('password').value;
					 var person = new Array(nickname, password)
					 var attributes = JSON.stringify(person);


						 $.ajax({
							   type: 'POST',
							   url: 'funcionesphp/send.php',
								 data:{"attributes": attributes, "action":1},
							   success: function(answer){

									 if(answer==1){
										 $('#answer').html("<div class='alert alert-dismissible alert-danger' id = 'oculto'><button type='button' class='close' onclick='cer()'  data-dismiss='alert'>&times;</button><strong>Ops! a ocurrido un error,</strong> el usuario no existe<a href='registration.php' class='alert-link'> puede registrarse. </a> </div>");
									 }else if (answer==2) {
									 	 $('#answer').html("<div class='alert alert-dismissible alert-warning' id = 'oculto'><button type='button' class='close' onclick='cer()'  data-dismiss='alert'>&times;</button><strong>Ops! a ocurrido un error,</strong> la contraseña es incorrecta <a href='logingIndex.php' class='alert-link'> inténtelo de nuevo. </a> </div>");
									 }else if (answer==3){
										 $('#answer').html("<div class='alert alert-dismissible alert-warning' id = 'oculto'><button type='button' class='close' onclick='cer()'  data-dismiss='alert'>&times;</button><strong>Ops! a ocurrido un error,</strong> el usuario aún no se encuentra activo  <a href='contacto.php' class='alert-link'> comuníquese con el administrador. </a> </div>");
									 }else if (answer==4) {
										 $('#answer').html("<div class='alert alert-dismissible alert-success' id = 'oculto'><button type='button' class='close' onclick='cer()'  data-dismiss='alert'>&times;</button><strong>Se registró correctamente</strong></a> </div>");
											 location.href = 'adminIndex.php';
									 }else if (answer==5) {
 									 	 $('#answer').html("<div class='alert alert-dismissible alert-success' id = 'oculto'><button type='button' class='close' onclick='cer()'  data-dismiss='alert'>&times;</button><strong>Se registró correctamente como Profesor</strong></a> </div>");
										 location.href = '/chaea/partials/viewTeacher/teacherIndex.php';
									 }else if (answer==6) {
										 $('#answer').html("<div class='alert alert-dismissible alert-success' id = 'oculto'><button type='button' class='close' onclick='cer()'  data-dismiss='alert'>&times;</button><strong>Se registró correctamente como Estudiante</strong></a> </div>");
									 }else{
										 $('#answer').html("<div class='alert alert-dismissible alert-info' id = 'oculto'><button type='button' class='close' onclick='cer()'  data-dismiss='alert'>&times;</button><strong>Ops! a ocurrido un error,</strong> no ingreso los datos<a href='registration.php' class='alert-link'> puede registrarse. </a> </div>");
									 }
								 },

							 });
				}
</script>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	<?php include_once("analyticstracking.php"); ?>
	<?php
		include('partials/pie.html');
	?>
