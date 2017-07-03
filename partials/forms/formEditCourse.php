<main class="detalle">
			<form class="form-horizontal" id='formularioEditeCourse' onsubmit="return false">
						 <fieldset>
							 			<input type="hidden" id="idEditeCourse" value="">

					   				<div id="topTitle"><legend><div id="nameEditeCourse"></div></legend></div>
							    		<div class="form-group">
												<label for="nameEditeCourse" class=" control-label">Nombre:</label>
													<div class="has-success">
														<input id="nameEditCourse" type="textarea" class="form-control" value="" pattern=".{0}|.{5,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required  onKeyPress="return control1(event)" placeholder="Ej: Analitica Web"></input><br>
													</div>
												</div>

												<div class="form-group">
												 <label for="quotas_edit_course" class=" control-label">¿Tiene Límite de Cupos?</label>
												 <div class="has-success">
													 <select class="form-control" id="quotas_edit_course">
														 <option>No</option>
														 <option>Si</option>
													 </select>
												 </div>
											 </div><br>

												<div id="limit-edit-course"></div>

										<div class="form-group">
											<label for="descriptionEditeCourse" class=" control-label">Descripción:</label>
												<div class="has-success">
													<textarea  id="descriptionEditeCourse" type="textarea" class=" ckeditor form-control"  placeholder="Ej: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero nam beatae illo mollitia fugit, exercitationem fuga ab nobis non nihil repellendus officia voluptate labore consectetur. Nam perferendis magnam, repellendus aperiam." required style="max-width: 448px;width: 448px; height: 146px;"></textarea><br>
											 </div>
										</div>






										<div id="infoPanel2"></div>
							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id07').style.display='none'; $('#limit-edit-course').html(''); $('#infoPanel2').html('');" id='closeEditeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="edite-Course"  class="btn btn-success">Editar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
