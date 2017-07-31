<?php
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/send.php');
	$nameUniversity="";
	$nameUniversity=university();
	$program="";
	$program=program();
?>
<main class="detalle">
			<form class="form-horizontal" id='formulario' onsubmit="return false">
			 <fieldset>
			   <legend>Registro</legend>

					    		<div class="form-group">
										<label for="name" class=" control-label">Nombre:</label>
											<div class="has-success">
												<input type="text" class="form-control" value="" pattern=".{0}|.{12,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required id="name" onKeyPress="return control1(event)" placeholder="Ej: Jorge Enrique Pineda Torres"></input><br>
										 </div>
									</div>

								<div class="form-group">
											<label for="birthdate" class=" control-label">Año de nacimiento:</label>
												<div class="has-success">
													<input required="" type="date" id="birthdate" class="form-control"></input><br>
											</div>
									</div>


									<!--documento usuario falta para la BD  -->
									<div class="form-group">
										<label for="document_type" class=" control-label">Tipo de documento:</label>
										<div class="has-success">
											<select class="form-control" id="document_type">
												<option value="1">Cédula de ciudadanía</option>
												<option value="2">Cédula de extranjería.</option>
												<option value="3">Tarjeta de identidad.</option>
											</select>
										</div>
									</div><br>

									<div class="form-group">
									 <label for="number_document"  class=" control-label" >Número de identificación:</label>
										 <div class="has-success">
									 <input type="number" value="" class="form-control"  min="1000000" max="10000000000" required="" onKeyPress="return control2(event)" id="number_document" placeholder="Ej: 52220080"></input><br>
										</div>
								 </div>
								 <!-- Fin documento usuario -->

									<div class="form-group">
										<label for="gender" class=" control-label">Genero:</label>
										<div class="has-success">
											<select class="form-control" id="gender">
												<option>Masculino</option>
												<option>Femenino</option>
											</select>
										</div>
									</div><br>

									<div class="form-group">
										<label for="native_city" class=" control-label">Lugar de Nacimiento:</label>
										<div class="has-success">
											<input onKeyPress="return control1(event)" pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres" value="" required maxlength="80" class="form-control" id="native_city"  placeholder="Ej: Manizales"/></input>
							  		</div>
									 <!-- Fin del metodo -->
									</div><br>
									<!-- mete las cidades de Colombia de un JSON para esogerlas  -->
									<script type="text/javascript">
											var options = {	url: "/chaea/json/municipality.json",
																			getValue: "Municipio",
																			list: {	match: {enabled: true} },
																			theme: "plate-dark"
																	};
												$("#native_city").easyAutocomplete(options);
											//Esto permite que funcione el el JSON de autocompletar
									</script>


									<!-- fin de borrar -->
							<!-- mete las universidades ya creadas en un vectora html -->
								 <datalist id="universities">
								 			<?php for ($i=0; $i < count($nameUniversity); $i++) { echo "<option value='".$nameUniversity[$i]['un']."'>"; }?>
								 </datalist>
								 <!-- Fin del metodo -->
								 <div class="form-group">
									 <label for="university" class=" control-label">Universidad:</label>
										 <div class="has-success">
										 <input  list="universities" pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres" onKeyPress="return control1(event)"
										  class="form-control"  value="" maxlength="300" required id="university" placeholder="Ej: Universidad Nacional de Colombia"></input><br>
										</div>
								 </div>

								 <datalist id="program">
										 <?php for ($i=0; $i < count($program); $i++) { echo "<option value='".$program[$i]['pr']."'>"; }?>
								 </datalist>

								 <div class="form-group">
								 		<label for="academic_program" class="control-label">Programa Academico:</label>
										<div class=" has-success">
											<input  list="program"  value="" class="form-control"  pattern=".{0}|.{10,80}" name="program" title="tiene que tener por lo menos 10 caracteres" value="" maxlength="300" id="academic_program" placeholder="Ej: Geología "></input><br>
									 </div>
							 	</div>


								 <div class="form-group">
									 <label for="semester" class=" control-label">Semestre:</label>
										<div class=" has-success">
										 	<input type="number" class="form-control"  value="" min="1" max="15"  required="" id="semester" name="semester" placeholder="Ej: 4"></input><br>
									 </div>
								 </div>
								 <!-- Fin -->

								 <div class="form-group">
							 		<label for="number_phone" class=" control-label">Numero telefónico:</label>
							 			<div class="has-success">
							 					<input  type="number"  onKeyPress="return control2(event)"  min="1000000" max="10000000000" maxlength="300" class="form-control"  value="" required="" id="number_phone" placeholder="Ej:3166954258"></input><br>
							 		 </div>
							 	</div>
								<div class="form-group">
									<label for="email" class=" control-label">Correo electronico:</label>
										<div class="has-success">
												<input onKeyPress="return control3(event)" pattern=".{0}|.{8,80}" title="tiene que tener por lo menos 8 caracteres"  type="email" class="form-control"  value="" maxlength="300" required="" id="email" placeholder="Ej: jagomezo@unal.edu.co"></input><br>
									 </div>
								</div>
								<div id="warningemail"></div>
								<div class="form-group">
									<label for="nickname" class=" control-label">Nombre de usuario:</label>
										<div class="has-success">
												<input onKeyPress="return control4(event)"  pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres"  type="text" class="form-control"  value="" maxlength="300" required="" id="nickname" placeholder="Ej: jagomezo "></input><br>
									 </div>
								</div>

							 </fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
								 <div id="warningform"></div>
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button id='closeStudent' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="registratione"  class="btn btn-success">Actualizar</button>
										 </div>
									 </div>
							 </div>

										</form>


							 </main>
