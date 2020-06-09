<main class="detalle">
			<form class="form-horizontal" id='formStrategy' onsubmit="return false">
						 <fieldset>

						        <div class="form-group">
						          <label for="name_strategy" class=" control-label">Estrategia:</label>
						            <div class="has-success">
						              <input id="name_strategy" type="textarea" class="form-control" value="" pattern=".{0}|.{5,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required  onKeyPress="return control1(event)" placeholder="Ej: Cuadro comparativo"></input><br>
						            </div>
						          </div>

										<div class="form-group">
											<label for="id_type_learning" class=" control-label">Estilo de aprendizaje:</label>
											<div class="has-success">
												<select class="form-control" id="id_type_learning">
													<option value="1">Activo</option>
													<option value="2">Reflexivo</option>
													<option value="3">Teórico</option>
													<option value="4">Pragmático</option>
												</select>
											</div>
										</div><br>

										<div id="infoPanel1"></div>



							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id13').style.display='none';
											 $('#infoPanel3').html('');" id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="add_strategy"  class="btn btn-success">Aceptar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
