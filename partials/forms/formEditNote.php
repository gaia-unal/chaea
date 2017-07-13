<main class="detalle">
			<form class="form-horizontal" id='formEditNote' onsubmit="return false">
						 <fieldset>
							 <input type="hidden" id="idEditeNote" value="">
				   				<legend>Editar Nota</legend>
						    		<div class="form-group">
											<label for="note_edit_activity" class=" control-label">Nota:</label>
												<div class="has-success">
													<input id="note_edit_activity" type="textarea" class="form-control" value=""
													maxlength="4" required  onKeyPress="return control5(event)"
													placeholder="Ej: 3.5"></input><br>
											 </div>
										</div>

							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id12').style.display='none';" id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="editNote"  class="btn btn-success">Aceptar</button>
										 </div>
									 </div>
							 </div>

						</form>


</main>
