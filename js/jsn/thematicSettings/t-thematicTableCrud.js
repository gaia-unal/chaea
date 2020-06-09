
	document.addEventListener('DOMContentLoaded',main)
	var bas=0;

	function ajaxSettingThematic(thematic,action) {
				var thematics = thematic;
				var thematic = JSON.stringify(thematic);
			let info = $.ajax({
					method:"POST",
					url: "/chaea/backendPhp/thematicSQL/t-thematic.php",
					data: {"action":action,"thematic":thematic}

				}).done( function( info ){
					var response = JSON.parse(info);
										 if(Number(info)==1){
											  mensajeSend("Se registro correctamente la temática: "+ thematics[0]);
												$('#formularioThematic')[0].reset();
												document.getElementById('id17').style.display='none';
										 }else if (Number(info)==2) {
										 		mensajeWarning("La tematica: \""+thematics[0]+"\" ya existe\n en este curso.");
										 }else if(Number(info)==3){
											 	mensajeSend("Se actuaizo correctamente el la actividad: "+ thematics[0]);
												document.getElementById('id18').style.display='none';
										 }else if(Number(info)==4){
											 	mensajeSend("Se ha eliminado la temática: "+ thematics);
										 }else {
											 mensajeSend(info);
										 }
				});


	}

	function mensajeSend(info){
		$('#InfoUser').html(`<h4>`+info+`</h4>`);
		var modalInfo = document.getElementById('id04');
		modalInfo.style.display='block';
		 $("#id04").fadeOut(9000);
		 $("#acep").click(function(){
    		$("#id04").stop(true, true);
			});
	}
	function mensajeWarning(info){
		$('#warningInfo').html(`<h4>`+info+`</h4>`);
		var modalWarning = document.getElementById('id09');
		modalWarning.style.display='block';
		$("#acep").click(function(){
			 $("#id04").stop(true, true);
		 });
	}
	function strategis(strategis, option){
		var lista =`<div class="form-group">
											<label for="id_strategis" class=" control-label">Estrategia:</label>
											<div class="has-success">
											<select class="form-control" id="id_strategis">`;
		for (var i = 0; i < strategis.length; i++) {
			lista = lista + `<option value="`+strategis[i].str_id+`">`+strategis[i].str_des+`</option>`;
		}
		lista = lista +`</select>
											</div>
										</div>`;

		$('#strategisti').html(lista);

		var lista =`<div class="form-group">
			<label for="id_strategis_edit" class=" control-label">Estrategia:</label>
			<div class="has-success">
					<select class="form-control" id="id_strategis_edit">`;
					for (var i = 0; i < strategis.length; i++) {
						lista = lista + `<option value="`+strategis[i].str_id+`">`+strategis[i].str_des+`</option>`;
					}
					lista = lista +`</select>
				</div>
		</div>`;
		$('#strategisti_edit').html(lista);

	}

	function mensajePanelA(info, option){
		switch (option) {
			case 1:
				$('#infoPanel1').html("<div id='infoPanelClose' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>&times;</button><strong>"+info+"</strong></a> </div>");
				return false;
				break;
			case 2:
				$('#infoPanel2').html("<div id='infoPanelClose' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>&times;</button><strong>"+info+"</strong></a> </div>");
				return false;
				break;
		}
		return false;

	}

	//Función que permite crear los links
	function reemplaza(descriptionNewActivity) {
		let b = /"/g;
		let c = descriptionNewActivity.replace(b,"''");
		return c;
	}

	//Funcion que toma los datos del formulario de creación de la tematica
	function createNewThematic(){
		let thematic_activity = document.getElementById('thematic_activity').value; /*0*/
		var idCourseJsn =  readCookie('idCourseJsn');/*1*/
		let thematic = [thematic_activity, idCourseJsn];
		for (let i in thematic){if((thematic[i]=="") ) {bas++;}}
		if (bas==0){
				$('#infoPanelClose').hide();
				ajaxSettingThematic(thematic,2);
				loadingThematic();
		}else{
			let info='Debe ingresar todos los datos que se solicitan.';
			mensajePanelA(info,1);
			bas=0;
		}
	}
	//fin de crear curso

	//Funcion que toma los datos del formulario de edición de la actividad
	function editThisThematic(){

		let name_edit_thematic = $('#thematic_edit_activity').val();/*0*/
		let idCourseJsn =  readCookie('idCourseJsn');/*1*/
		let id_thematic = $('#id_edit_thematic').val();/*2*/
				let thematic = [name_edit_thematic, idCourseJsn, id_thematic];
				console.log(thematic);
				for (let	 i in thematic){if((thematic[i]=="") ) {bas++;}}

				if (bas==0){
						$('#infoPanelClose').hide();
						ajaxSettingThematic(thematic,3);
						loadingThematic();
				}else{
					let info='Debe ingresar todos los datos que se solicitan.';
					mensajePanelA(info,2);
					bas=0;
				}


	}
	//fin editar.


function main(){
	//crea tematica
	$("#addThematic").click(function(){
		document.getElementById('id17').style.display='block';
	 });
	$("#newThematic").click(function(){
		createNewThematic();
	});
	//fin crear
	//Edita tematica
		$("#editThematic").click(function(){
			editThisThematic();
		});
	//Fin de edtitar

	$("#deleteElement").click(function(){
    var id_element = document.getElementById('id_element').value;
    ajaxSettingThematic(id_element,4);
	  loadingThematic();
		document.getElementById('id01').style.display='none';
	});





}
