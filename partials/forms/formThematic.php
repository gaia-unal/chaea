<main class="detalle">
			<form class="form-horizontal" id='formularioThematic' onsubmit="return false">
						 <fieldset>
				   				<legend>Agregar Temátiva</legend>
						    		<div class="form-group">
											<label for="thematic_activity" class=" control-label">Temática:</label>
												<div class="has-success">
													<input id="thematic_activity" type="textarea" class="form-control" value="" pattern=".{0}|.{5,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required  onKeyPress="return control1(event)" placeholder="Ej: Analitica Web"></input><br>
											 </div>
										</div>


										<div id="infoPanel1"></div>

							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id17').style.display='none';
											  	CKEDITOR.instances['description_activity'].setData('');
													 $('#infoPanel1').html(''); " id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="newThematic"  class="btn btn-success">Agregar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
