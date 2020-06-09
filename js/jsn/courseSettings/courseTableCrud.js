	document.addEventListener('DOMContentLoaded',main)
	var bas=0;
	function ajaxSettingCourse(course,action) {
				var courses = course;
				var course = JSON.stringify(course);
				$.ajax({
					method:"POST",
					url: "/chaea/backendPhp/courseSQL/crudTableCourse.php",
					data: {"action":action,"course":course}
				}).done( function( info ){
										 if(Number(info)==1){
											  mensajeSend("Se registro correctamente el curos: "+ courses[0]);
												$('#formularioCourse')[0].reset();
												$('#limit-course').html('');
												CKEDITOR.instances['descriptionNewCourse'].setData('');
												document.getElementById('id05').style.display='none';

										 }else if (Number(info)==2) {
										 		mensajeWarning("El curso: "+courses[0]+" ya existe\n debe tener otro nombre");
										 }else if (Number(info)==3) {
										 		mensajeWarning("El curso: "+courses[1]+" ya existe\n debe tener otro nombre");
										 }else if(Number(info)==4){
											 	mensajeSend("Se actuaizo correctamente el curos: "+ courses[1]);
												$('#limit-edit-course').html('');
												document.getElementById('id07').style.display='none';
										 }else if(Number(info)==5){
											 mensajeWarning("No se pudo realizar la actualización del curso: "+ courses[1])+". ";
										 }else if(Number(info)==6){
											 mensajeWarning(`El numero de cupos del curso: `+ courses[1]+
											`, no puede ser menor a la cantidad de estudiantes activos
											 si desea puede
											 	<a id="coursesTeacher" href="actiStudentCourse.php">
											 		<font color="red"><u>inactivar los estudiantes.</u></font>
												</a>`);
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
	function mensajePanel(info, option){
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

	function reemplaza(descriptionNewCourse) {
		let b = /"/g;
		let c = descriptionNewCourse.replace(b,"''");
		return c;
	}
	//Funcion que toma los datos del formulario de creación del cuerso
	function createNewCourse(){
		let nameCourse = document.getElementById('nameCourse').value; /*0*/
		let descriptionNewCourse = CKEDITOR.instances['descriptionNewCourse'].getData(); /*1*/
				descriptionNewCourse = reemplaza(descriptionNewCourse);
		let limitCourse = $('#limit-quotas').val();
		if(limitCourse==null){limitCourse="N/A";}
		let course = new Array(nameCourse,descriptionNewCourse, limitCourse);
		for (let	 i in course){if((course[i]=="") ) {bas++;}}
		if (bas==0){
			$('#infoPanelClose').hide();
			ajaxSettingCourse(course,1);
			loading();

		}else{
			let info='Debe ingresar todos los datos que se solicitan.';
			mensajePanel(info,1);
			bas=0;
		}
	}

	function editThisCourse(){
		let name_course = $('#nameEditCourse').val();
		let idCourse = $('#idEditeCourse').val();
		let description_course = CKEDITOR.instances['descriptionEditeCourse'].getData(); /*1*/
				description_course = reemplaza(description_course);

		let limitCourse = $('#limit-edit-quotas').val();
		if(limitCourse==null){limitCourse="N/A";}

		let course = [idCourse, name_course, description_course, limitCourse];
		for (let	 i in course){if((course[i]=="") ) {bas++;}}
		if (bas==0){
			$('#infoPanelClose').hide();
			ajaxSettingCourse(course,7);
			loading();

		}else{
			let info='Debe ingresar todos los datos que se solicitan.';
			mensajePanel(info,2);
			bas=0;
		}


	}
	function formLimit(){
		if($("#quotas_course").val()=="Si"){
				$("#limit-course").html(`
						<div class="form-group">
							<label for="limit-quotas" class=" control-label">Ingrese El Limite:</label>
								<div class="has-success">
								<input type="number" id="limit-quotas"  value="" class="form-control"  min="1" max="1000" required="" onKeyPress="return control2(event)" placeholder="Ej: 50"></input><br></div>
						</div>
				`);
		}else{
			$("#limit-course").html('');
		}
	}

	function formEditLimit(){
		if($("#quotas_edit_course").val()=="Si"){
				$("#limit-edit-course").html(`
						<div class="form-group">
							<label for="limit-edit-quotas" class=" control-label">Ingrese El Limite:</label>
								<div class="has-success">
								<input type="number" id="limit-edit-quotas"  value="" class="form-control"  min="1" max="1000" required="" onKeyPress="return control2(event)" placeholder="Ej: 50"></input><br></div>
						</div>
				`);
		}else{
			$("#limit-edit-course").html('');
		}
	}
function main(){
	$("#quotas_course").click(function(){
		formLimit();
	})
	$("#quotas_edit_course").click(function(){
		formEditLimit();
	})
	$("#addCoruse").click(function(){
		document.getElementById('id05').style.display='block';
	 });
	$("#newCourse").click(function(){
		createNewCourse();
	});
	$("#deleteElement").click(function(){
    var id_element = document.getElementById('id_element').value;
    ajaxSettingCourse(id_element,6);
	  loading();
		document.getElementById('id01').style.display='none';
	});
	$("#desaElement").click(function(){
    var id_element_des = document.getElementById('id_element_des').value;
    ajaxSettingCourse(id_element_des,4);
	  loading();
		document.getElementById('id08').style.display='none';
	});
	$("#canDesaEle").click(function(){
	  loading();
	});

	$("#edite-Course").click(function(){
		editThisCourse();
	});

}
