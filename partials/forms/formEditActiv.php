<main class="detalle">
			<form class="form-horizontal" id='formularioActiv' onsubmit="return false">
						 <fieldset>
				   				<div id="topTitle"><legend><div id="name_ed_activity"></div></legend></div>
									<input type="hidden" id="id_edit_activ" value="">

										<div class="form-group">
											<label for="name_edit_activity" class="">Nombre:</label>
												<div class="has-success">
													<input id="name_edit_activity" type="text" disabled="disabled" class="form-control"></input><br>
											 </div>
										</div>

										<div class="form-group">
											<label for="id_type_edit_learning" class="">Estilo de aprendizaje:</label>
											<div class="has-success">
												<select class="form-control" id="id_type_edit_learning">
													<option value="1">Activo</option>
													<option value="2">Reflexivo</option>
													<option value="3">Teórico</option>
													<option value="4">Pragmático</option>
												</select>
											</div>
										</div><br>


										<!-- se enlistan las estrategias sustituyendo la etiqueda di -->
										<div id="strategisti_edit"></div>

										<!-- se enlistan los niveles de desempeño -->
										<div class="form-group">
											<label for="id_level_edit_performance">Nivel de Desempeño:</label>
											<div class="has-success">
												<select class="form-control" id="id_level_edit_performance">
													<option value="0"></option>
													<option value="1">Explorador</option>
													<option value="2">Integrador</option>
													<option value="3">Innovador</option>
												</select>
											</div>
										</div>


										<div class="range-slider">
											<label for="description_activity" class="">Porcentaje de la actividad:</label>
										  <input class="range-slider__range"  id="weight_edit" type="range" value="0" min="0" max="100" step="1">
										  <span class="range-slider__value" id="weight_lo" >0</span>
										</div>

										<div class="form-group">
											<label for="description_edit_activity" class=" control-label">Descripción:</label>
												<div class="has-success">
													<textarea  class="form-control ckeditor"  id="description_edit_activity" placeholder="Ej: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero nam beatae illo mollitia fugit, exercitationem fuga ab nobis non nihil repellendus officia voluptate labore consectetur. Nam perferendis magnam, repellendus aperiam."+style="max-width: 448px;width: 448px; height: 146px;"></textarea><br>
											 </div>
										</div>
										<div id="infoPanel2"></div>

							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id11').style.display='none';
											 CKEDITOR.instances['description_edit_activity'].setData('');
											 $('#infoPanel2').html('');" id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="editActivity"  class="btn btn-success">Actualizar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
