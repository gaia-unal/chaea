
	document.addEventListener('DOMContentLoaded',main)
	var bas=0;
	function ajaxSettingActivity(activity,action) {
				var activitys = activity;
				var activity = JSON.stringify(activity);
			let info = $.ajax({
					method:"POST",
					url: "/chaea/backendPhp/activitySQL/t-activityCourse.php",
					data: {"action":action,"activity":activity}

				}).done( function( info ){
					var response = JSON.parse(info);
										 if(Number(info)==1){
											  mensajeSend("Se registro correctamente la actividad: "+ activitys[0]);
												$('#formularioActiv')[0].reset();
												CKEDITOR.instances['description_activity'].setData('');
												document.getElementById('id10').style.display='none';
												$('#weight_edit').val(0);
												$('#weight_lo').html(0+'%');
										 }else if (Number(info)==2) {
										 		mensajeWarning("La actividad: \""+activitys[0]+"\" ya existe\n en este curso con las mismas características ");
										 }else if(Number(info)==3){
											 	mensajeSend("Se actuaizo correctamente el la actividad: "+ activitys[0]);
												document.getElementById('id11').style.display='none';
										 }else if(Number(info)==4){
											 	mensajeSend("Se desactivo correctamente el la actividad: "+ activitys[1]);

										 }else if(Number(info)==5){
											 mensajeSend("Se activo correctamente el la actividad: "+ activitys[1]);
										 }else if(Number(info)==6){
											 mensajeWarning(`El valor porcentual de esta actividad "`+activitys[0]+`" debe ser igual a la actividad "`+activitys[0]+`"  ya creada previamente para otro
												 estilo de aprendizaje.
												 Si lo que desea es cambiar el valor porcentual de esta actividad debe modificar primero el valor
												 porcentual de la actividad "`+activitys[0]+`" que  creó previamente.`);

										 }else if(response[1]==7){
											$('#total_percent').val(response[0]);
											 $('#entire').html('Porcentaje acumulado de las actividades: '+response[0]+'% / 100%');

										 }else if(response[1]==8){
											  mensajeWarning('El valor porcentual de esta nueva actividad "'+activitys[0]+'" no puede superar el: '+response[0]+'%');

										 }else if(response[1]==9){
											 strategis(response[0], activitys)

										 }else if(response[1]==11){
											 strategisedit(response[0], activitys)

										 }else if(response[1]==10){
											 if(response[0]>0){
											 $('#id_strategis_edit').val(response[0]);
										 	}
										 }else if(Number(info)==12){
											  mensajeSend("Se ha eliminado correctamente el la actividad");
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
		//Este es para cuando crea la actividad
		var lista =`<div class="form-group">
											<label for="id_strategis" class="">Estrategia:</label>
											<div class="has-success">
											<select class="form-control" id="id_strategis">`;
		for (var i = 0; i < strategis.length; i++) {
			lista = lista + `<option value="`+strategis[i].str_id+`">`+strategis[i].str_des+`</option>`;
		}
		lista = lista +`</select>
											</div>
										</div>`;

		$('#strategisti').html(lista);

	}
	function strategisedit(strategis, option){

		//Este es para cuando edita la actividad
		var lista =`<div class="form-group">
			<label for="id_strategis_edit" class="">Estrategia:</label>
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

	//Funcion que toma los datos del formulario de creación de la actividad
	function createNewActi(){
		let name_activity = document.getElementById('name_activity').value; /*0*/
		let id_type_learning = document.getElementById('id_type_learning').value; /*1*/
		let description_activity = CKEDITOR.instances['description_activity'].getData(); /*2*/
				description_activity = reemplaza(description_activity);
	  let idCourseJsn =  readCookie('idCourseJsn');/*3*/
		let weight = document.getElementById('weight').value; /*4*/
		let weight_now = $('#total_percent').val();/*5*/
		let strategis = document.getElementById('id_strategis').value; /*6*/
		let id_level_performance = document.getElementById('id_level_performance').value; /*7*/
		var thematicJsn =  readCookie('thematicJsn');/*8*/
		let activity = [name_activity, id_type_learning, description_activity, idCourseJsn, weight, weight_now,  strategis, id_level_performance, thematicJsn ];
		for (let	 i in activity){if((activity[i]=="") ) {bas++;}}
		if(id_type_learning == 0 || id_level_performance == 0 ){bas++;}
		if (bas==0){
				$('#infoPanelClose').hide();
				ajaxSettingActivity(activity,2);
				loading();
		}else{
			let info='Debe ingresar todos los datos que se solicitan.';
			mensajePanelA(info,1);
			bas=0;
		}
	}
	//fin de crear curso

	//Funcion que toma los datos del formulario de edición de la actividad
	function editThisActivity(){

			let id_edit_activ = $('#id_edit_activ').val();/*8*/
			let name_edit_activity = $('#name_edit_activity').val();/*0*/
			let id_type_edit_learning = $('#id_type_edit_learning').val();/*1*/
			let description_edit_activity = CKEDITOR.instances['description_edit_activity'].getData();/*2*/
					description_edit_activity = reemplaza(description_edit_activity);
			let idCourseJsn =  readCookie('idCourseJsn');/*3*/
			let weight = document.getElementById('weight_edit').value; /*4*/
			let strategis = document.getElementById('id_strategis_edit').value; /*5*/
			var thematicJsn =  readCookie('thematicJsn');/*6*/
			let id_level_performance = document.getElementById('id_level_edit_performance').value; /*7*/
			let activity = [name_edit_activity, id_type_edit_learning, description_edit_activity, idCourseJsn, weight,  strategis, thematicJsn, id_level_performance, id_edit_activ ];

			for (let	 i in activity){if((activity[i]=="") ) {bas++;}}
			if(id_type_learning==0){bas++;}
			if (bas==0){
					$('#infoPanelClose').hide();
					ajaxSettingActivity(activity,3);
					loading();
			}else{
				let info='Debe ingresar todos los datos que se solicitan.';
				mensajePanelA(info,2);
				bas=0;
			}


	}
	//fin editar.

	function estrategyActivity(){
		$( "#id_type_learning" ).change(function() {
		   //ajax que carga las estrategias.
			 let id_type_learning = $('#id_type_learning').val();
			 ajaxSettingActivity(id_type_learning, 8);//voy aquí

		});
		$( "#id_type_edit_learning" ).change(function() {
		   //ajax que carga las estrategias.
			 let id_type_edit_learning = $('#id_type_edit_learning').val();
			 ajaxSettingActivity(id_type_edit_learning, 10);

		});
	}

function main(){
	//creat actividad
	let total_percent = $('#total_percent').val();
	$("#addActivity").click(function(){
		let limit = 100 - total_percent;
				// $('#weight').attr({'max':limit});

		document.getElementById('id10').style.display='block';
		estrategyActivity();
	 });
	$("#newActivity").click(function(){
		createNewActi();
	});
	//fin crear
	//Edita Actividaad
		$("#editActivity").click(function(){
			editThisActivity();
		});
	//Fin de edtitar

	$("#deleteElement").click(function(){
    var id_element = document.getElementById('id_element').value;
    ajaxSettingActivity(id_element,6);
	  loading();
		document.getElementById('id01').style.display='none';
	});

	$("#canDesaEle").click(function(){
	  loading();
	});



}
