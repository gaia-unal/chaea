<main class="detalle">
			<form class="form-horizontal" id='formulario' onsubmit="return false">
			 <fieldset>
			   <legend>Editar perfil</legend>

					    		<div class="form-group">
										<label for="name_admin" class=" control-label">Nombre:</label>
											<div class="has-success">
												<input type="text" class="form-control" value="" pattern=".{0}|.{12,60}" title="tiene que tener por lo menos 12 caracteres"
												maxlength="60" required id="name_admin" onKeyPress="return control1(event)" placeholder="Ej: Jorge Enrique Pineda Torres"></input><br>
										 </div>
									</div>

								<div class="form-group">
											<label for="birthdate_admin" class=" control-label">Año de nacimiento:</label>
												<div class="has-success">
													<input required="" type="date" id="birthdate_admin" class="form-control"></input><br>
											</div>
									</div>


									<!--documento usuario falta para la BD  -->
									<div class="form-group">
										<label for="document_type_admin" class=" control-label">Tipo de documento:</label>
										<div class="has-success">
											<select class="form-control" id="document_type_admin">
												<option value="1">Cédula de ciudadanía</option>
												<option value="2">Cédula de extranjería.</option>
												<option value="3">Tarjeta de identidad.</option>
											</select>
										</div>
									</div><br>

									<div class="form-group">
									 <label for="number_document_admin"  class=" control-label" >Número de identificación:</label>
										 <div class="has-success">
									 <input type="number" value="" class="form-control"  min="1000000" max="10000000000" required="" onKeyPress="return control2(event)" id="number_document_admin" placeholder="Ej: 52220080"></input><br>
										</div>
								 </div>
								 <!-- Fin documento usuario -->

									<div class="form-group">
										<label for="gender_admin" class=" control-label">Genero:</label>
										<div class="has-success">
											<select class="form-control" id="gender_admin">
												<option>Masculino</option>
												<option>Femenino</option>
											</select>
										</div>
									</div><br>

									<div class="form-group">
										<label for="native_city_admin" class=" control-label">Lugar de nacimiento:</label>
										<div class="has-success">
											<input onKeyPress="return control1(event)" pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres" value=""
                      required maxlength="80" class="form-control" id="native_city_admin"  placeholder="Ej: Manizales"/></input>
							  		</div>
									 <!-- Fin del metodo -->
									</div><br>
									<!-- mete las cidades de Colombia de un JSON para esogerlas  -->
									<script type="text/javascript">
											var options = {	url: "json/municipality.json",
																			getValue: "Municipio",
																			list: {	match: {enabled: true} },
																			theme: "plate-dark"
																	};
												$("#native_city_admin").easyAutocomplete(options);
											//Esto permite que funcione el el JSON de autocompletar
									</script>
								 <div class="form-group">
							 		<label for="number_phone_admin" class=" control-label">Numero telefónico:</label>
							 			<div class="has-success">
							 					<input  type="number"  onKeyPress="return control2(event)"  min="1000000" max="100000000000" maxlength="300"
							 					 class="form-control"  value="" required="" id="number_phone_admin" placeholder="Ej:3166954258"></input><br>
							 		 </div>
							 	</div>
								<div class="form-group">
									<label for="email_admin" class=" control-label">Correo electronico:</label>
										<div class="has-success">
												<input onKeyPress="return control3(event)" pattern=".{0}|.{8,80}" title="tiene que tener por lo menos 8 caracteres"  type="email"
												 class="form-control"  value="" maxlength="300" required="" id="email_admin" placeholder="Ej: jagomezo@unal.edu.co"></input><br>
									 </div>
								</div>
								<div id="warningemail"></div>
								<div class="form-group">
									<label for="nickname_admin" class=" control-label">Nombre de usuario:</label>
										<div class="has-success">
												<input onKeyPress="return control4(event)"  pattern=".{0}|.{4,80}" title="tiene que tener por lo menos 4 caracteres"  type="text" class="form-control"  value="" maxlength="300" required="" id="nickname_admin" placeholder="Ej: jagomezo "></input><br>
									 </div>
								</div>

							 </fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
								 <div id="warningform"></div>
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button id="closedig" type="reset" class="btn btn-default">Cerrar</button>
											 <button type="submit" id ="update_admin"  class="btn btn-success">Actualizar</button>
										 </div>
									 </div>
							 </div>


			</form>

</main>
