<?php
  session_start();
if(!$_SESSION){
session_destroy();
}else{
	if (("administrator"==$_SESSION["rol"])) {
	    header ("Location: /./chaea/adminIndex.php");
	}else if("teacher"==$_SESSION["rol"]){
			// header ("Location: /./chaea/adminIndex.php");
	}else{
		// header ("Location: /./chaea/adminIndex.php");s
	}
}

	include('partials/head.php');
	include('partials/nav.php');
  include('backendPhp/send.php');
	$nameUniversity="";
	$nameUniversity=university();
	$program="";
	$program=program();
?>

<main class="detalle">
			<form class="form-horizontal" method="post" id='formulario' onsubmit="return false">
			 <fieldset>
			   <legend>Registro</legend>


					    		<div class="form-group">
										<label for="name" class="col-lg-2 control-label">Nombre:</label>
											<div class="col-lg-10 has-success">
												<input type="text" class="form-control" value="" pattern=".{0}|.{12,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required id="name" onKeyPress="return control1(event)" placeholder="Ej: Jorge Enrique Pineda Torres"></input><br>
										 </div>
									</div>

								<div class="form-group">
											<label for="birthdate" class="col-lg-2 control-label">Año de nacimiento:</label>
												<div class="col-lg-10 has-success">
													<input required="" type="date" id="birthdate" class="form-control"></input><br>
											</div>
									</div>

									<!--documento usuario falta para la BD  -->
									<div class="form-group">
										<label for="document_type" class="col-lg-2 control-label">Tipo de Documento:</label>
										<div class="col-lg-10 has-success">
											<select class="form-control" id="document_type">
												<option value="1">Cédula de ciudadanía</option>
												<option value="2">Cédula de Extranjería.</option>
												<option value="3">Tarjeta de identidad.</option>
											</select>
										</div>
									</div><br>
									<div class="form-group">
									 <label for="id_user"  class="col-lg-2 control-label" >Número de Identificación:</label>
										 <div class="col-lg-10 has-success">
									 <input type="number" value="" class="form-control"  min="1000000" max="10000000000" required="" onKeyPress="return control2(event)" id="id_user" placeholder="Ej: 52220080"></input><br>
										</div>
								 </div>
								 <!-- Fin documento usuario -->

									<div class="form-group">
										<label for="gender" class="col-lg-2 control-label">Genero:</label>
										<div class="col-lg-10 has-success">
											<select class="form-control" id="gender">
												<option>Masculino</option>
												<option>Femenino</option>
											</select>
										</div>
									</div><br>

									<div class="form-group">
										<label for="native_city" class="col-lg-2 control-label">Lugar de Nacimiento:</label>
										<div class="col-lg-10 has-success">
											<input onKeyPress="return control1(event)" pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres" value="" required maxlength="80" class="form-control" id="native_city"  placeholder="Ej: Manizales"/></input>
							  		</div>
									 <!-- Fin del metodo -->
									</div><br>
									<!-- mete las cidades de Colombia de un JSON para esogerlas  -->
									<script type="text/javascript">
											var options = {	url: "json/municipality.json",
																			getValue: "Municipio",
																			list: {	match: {enabled: true} }
																	};
												$("#native_city").easyAutocomplete(options);
											//Esto permite que funcione el el JSON de autocompletar
									</script>

									<div class="form-group">
										<label for="id_role" class="col-lg-2 control-label">Cargo:</label>
										<div class="col-lg-10 has-success">
											<select class="form-control" id="id_role" onchange="formstudent()">
												<option  value="1" >Profesor</option>
												<option  value="2" >Estudiante</option>
											</select>
										</div>
									</div><br>

									<!-- fin de borrar -->

									<!-- formulario del estudiante que se oculta  -->
									<!-- mete las universidades ya creadas en un vectora html -->
									<datalist id="program">
											<?php for ($i=0; $i < count($program); $i++) { echo "<option value='".$program[$i]['pr']."'>"; }?>
									</datalist>
									<div id="studentForm"></div>
						   		<!-- Fin del metodo -->
									<div id="semesterForm"></div>
															<!-- Fin -->
									</div>
							<!-- mete las universidades ya creadas en un vectora html -->
								 <datalist id="universities">
								 			<?php for ($i=0; $i < count($nameUniversity); $i++) { echo "<option value='".$nameUniversity[$i]['un']."'>"; }?>
								 </datalist>
								 <!-- Fin del metodo -->
								 <div class="form-group">
									 <label for="university" class="col-lg-2 control-label">Universidad:</label>
										 <div class="col-lg-10 has-success">
										 <input  list="universities" pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres" onKeyPress="return control1(event)"  class="form-control"  value="" maxlength="300" required id="university" placeholder="Ej: Universidad Nacional de Colombia"></input><br>
										</div>
								 </div>

								 <!-- Fin -->

								 <div class="form-group">
							 		<label for="number_phone" class="col-lg-2 control-label">Numero Telefónico:</label>
							 			<div class="col-lg-10 has-success">
							 					<input  type="number"  onKeyPress="return control2(event)"  min="1000000" max="10000000000" maxlength="300" class="form-control"  value="" required="" id="number_phone" placeholder="Ej:3166954258"></input><br>
							 		 </div>
							 	</div>
								<div class="form-group">
									<label for="email" class="col-lg-2 control-label">Correo Electronico:</label>
										<div class="col-lg-10 has-success">
												<input onKeyPress="return control3(event)" pattern=".{0}|.{8,80}" title="tiene que tener por lo menos 8 caracteres"  type="email" class="form-control"  value="" maxlength="300" required="" id="email" placeholder="Ej: jagomezo@unal.edu.co"></input><br>
									 </div>
								</div>
								<div id="warningemail"></div>
								<div class="form-group">
									<label for="nickname" class="col-lg-2 control-label">Nombre de Usuario:</label>
										<div class="col-lg-10 has-success">
												<input onKeyPress="return control4(event)"  pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres"  type="text" class="form-control"  value="" maxlength="300" required="" id="nickname" placeholder="Ej: jagomezo "></input><br>
									 </div>
								</div>


						    <div class="form-group ">
						      <label for="password" class="col-lg-2 control-label">Contraseña</label>
						      <div class="col-lg-10 has-success">
						        <input  required=""  type="password" class="form-control" id="password" placeholder="Contraseña" value=""></input>
						        <div class="checkbox">
						          <label><input type="checkbox" pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'" > <i class="fa fa-eye fa-1x"></i></input></label>
						        </div>
						      </div>
						    </div>


								<div class="form-group ">
							 	 <label for="password2" class="col-lg-2 control-label">Confirmar contraseña</label>
							 	 <div class="col-lg-10 has-success">
							 		 <input  required="" pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres" type="password" class="form-control" id="password2" placeholder="Contraseña" value=""></input>
 							 	 </div>
							  </div>

								<div id="warningpassword"></div>
							    <div class="form-group">
							      <div class="col-lg-10 col-lg-offset-2">
							        <button  type="reset"   class="btn btn-default">Cancelar</button>
											<button type="bouton" id ="registratione"  onclick="cart();" class="btn btn-un">Registrar</button> <!-- type="bouton"  id ="des"  onclick="register();" -->
										</div>
							    </div>

							  </fieldset>
			</form>

		</main>	<script id='ra'></script>


<!-- sometime later, probably inside your on load event callback -->
	<?php
		include('partials/pie.html');
	?>
<?php include_once("analyticstracking.php"); ?>
	<!-- Formularios -->
	<script src="js/jsn/asynchronous.js" type="text/javascript"></script><!--Este es JSN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" type="text/javascript"></script>
<script type="text/javascript">


	function cart(){

			try {

				document.getElementById('ra').src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"

			} catch (e) {
				bootbox.dialog({
					message: e,
					closeButton: false,
					buttons: {
							"success": {
								 label: "Confirmar",
								 className: "btn-success",
								 callback: function () {}
							}
					}
			});

			} finally {

			}

	}

	</script>
