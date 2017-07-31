<main class="detalle">
			<form class="form-horizontal" id='formUpload' onsubmit="return false">
						 <fieldset>
							 <input type="hidden" id="idEditeNote" value="">
				   				<legend>Subir Actividad</legend>
						    		<div class="form-group">
											<label for="file_activity" class=" control-label">Subir Actividad:</label>
												<div class="has-success">
													<input class="btn btn-success" id="file_activity" name="fileActivity"  type="file" ></input><br>
											 </div>


										</div>

							</fieldset>
							 <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
									 <div class="form-group">
										 <div class="col-lg-10 col-lg-offset-2">
											 <button onclick="document.getElementById('id15').style.display='none';" id='closeTea' type="reset" class="btn btn-default">Cancelar</button>
											 <button type="submit" id ="uploadFile"  class="btn btn-success">Aceptar</button>
										 </div>
									 </div>
							 </div>

						</form>



</main>
