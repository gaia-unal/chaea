
	document.addEventListener('DOMContentLoaded',main)
	var bas=0;
	function ajaxSettingActivity(activity,action) {
				var activitys = activity;
				var activity = JSON.stringify(activity);
				$.ajax({
					method:"POST",
					url: "/chaea/backendPhp/activitySQL/t-activityCourse.php",
					data: {"action":action,"activity":activity}

				}).done( function( info ){
										 if(Number(info)==1){
											  mensajeSend("Se registro correctamente la actividad: "+ activitys[0]);
												$('#formularioActiv')[0].reset();
												CKEDITOR.instances['description_activity'].setData('');
												document.getElementById('id10').style.display='none';
												$('#weight_edit').val(0);
												$('#weight_lo').html(0+'%');
										 }else if (Number(info)==2) {
										 		mensajeWarning("La actividad: \""+activitys[0]+"\" ya existe\n en este curso, debe tener otro nombre");
										 }else if(Number(info)==3){
											 	mensajeSend("Se actuaizo correctamente el la actividad: "+ activitys[0]);
												document.getElementById('id11').style.display='none';
										 }else if(Number(info)==4){
											 	mensajeSend("Se desactivo correctamente el la actividad: "+ activitys[1]);

										 }else if(Number(info)==5){
											 	mensajeSend("Se activo correctamente el la actividad: "+ activitys[1]);

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

		let activity = [name_activity, id_type_learning, description_activity, idCourseJsn, weight ];
		for (let	 i in activity){if((activity[i]=="") ) {bas++;}}
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

		let id_edit_activ = $('#id_edit_activ').val();/*0*/
		let name_edit_activity = $('#name_edit_activity').val();/*1*/
		let id_type_edit_learning = $('#id_type_edit_learning').val();/*2*/
		let description_edit_activity = CKEDITOR.instances['description_edit_activity'].getData();/*3*/
				description_edit_activity = reemplaza(description_edit_activity);
		let weight = document.getElementById('weight_edit').value; /*5*/
				let activity = [name_edit_activity, id_type_edit_learning, description_edit_activity, idCourseJsn, id_edit_activ, weight];
				for (let	 i in activity){if((activity[i]=="") ) {bas++;}}
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


function main(){
	//creat actividad
	$("#addActivity").click(function(){
		let limit = 100 - total_salary.toFixed(0);
				$('#weight').attr({'max':limit});
		document.getElementById('id10').style.display='block';
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
