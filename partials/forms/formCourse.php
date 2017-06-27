<main class="detalle">
			<form class="form-horizontal" id='formularioCourse' onsubmit="return false">
						 <fieldset>
						   				<legend>Agregar Curso</legend>
								    		<div class="form-group">
													<label for="nameCourse" class=" control-label">Nombre:</label>
														<div class="has-success">
															<input type="textarea" class="form-control" value="" pattern=".{0}|.{5,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required id="nameCourse" onKeyPress="return control1(event)" placeholder="Ej: Analitica Web"></input><br>
													 </div>
												</div>


										<div class="form-group">
											<label for="descriptionNewCourse" class=" control-label">Descripción:</label>
												<div class="has-success">
													<textarea  class="form-control ckeditor"  id="descriptionNewCourse" placeholder="Ej: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero nam beatae illo mollitia fugit, exercitationem fuga ab nobis non nihil repellendus officia voluptate labore consectetur. Nam perferendis magnam, repellendus aperiam."+style="max-width: 448px;width: 448px; height: 146px;"></textarea><br>
											 </div>
										</div>
										<div id="infoPanel1"></div>

							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id05').style.display='none'; 	CKEDITOR.instances['descriptionNewCourse'].setData('');" id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="newCourse"  class="btn btn-success">Agregar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
