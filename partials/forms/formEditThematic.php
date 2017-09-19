<main class="detalle">
			<form class="form-horizontal" id='formularioEditThematic' onsubmit="return false">
						 <fieldset>
									 <div id="topTitle"><legend><div id="name_edit_thematic"></div></legend></div>
									 <input type="hidden" id="id_edit_thematic" value="">

						    		<div class="form-group">
											<label for="thematic_edit_activity" class=" control-label">Temática:</label>
												<div class="has-success">
													<input id="thematic_edit_activity" type="textarea" class="form-control" value="" pattern=".{0}|.{5,60}" title="tiene que tener por lo menos 12 caracteres"  maxlength="60" required  onKeyPress="return control4(event)" placeholder="Ej: Analitica Web"></input><br>
											 </div>
										</div>


										<div id="infoPanel1"></div>

							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id18').style.display='none';
											 $('#infoPanel2').html(''); " id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="editThematic"  class="btn btn-success">Aceptar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
