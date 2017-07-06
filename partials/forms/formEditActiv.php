<main class="detalle">
			<form class="form-horizontal" id='formularioActiv' onsubmit="return false">
						 <fieldset>
				   				<div id="topTitle"><legend><div id="name_ed_activity"></div></legend></div>
									<input type="hidden" id="id_edit_activ" value="">
						    		<div class="form-group">
											<label for="name_edit_activity" class=" control-label">Nombre:</label>
												<div class="has-success">
													<input id="name_edit_activity" type="textarea" class="form-control" value="" pattern=".{0}|.{5,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required  onKeyPress="return control1(event)" placeholder="Ej: Analitica Web"></input><br>
											 </div>
										</div>

										<div class="form-group">
											<label for="id_type_edit_learning" class=" control-label">Estilo de Aprendizaje:</label>
											<div class="has-success">
												<select class="form-control" id="id_type_edit_learning">
													<option value="1">Activo</option>
													<option value="2">Reflexivo</option>
													<option value="3">Teórico</option>
													<option value="4">Pragmático</option>
												</select>
											</div>
										</div><br>

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
											 <button onclick="document.getElementById('id11').style.display='none'; 	CKEDITOR.instances['description_edit_activity'].setData(''); $('#infoPanel2').html(''); " id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="editActivity"  class="btn btn-success">Agregar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
