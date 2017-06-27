	document.addEventListener('DOMContentLoaded',main)
	var bas=0;
	function ajaxSettingCourse(course,action) {
				var courses = course;
				var course = JSON.stringify(course);
				$.ajax({
					method:"POST",
					url: "/chaea/funcionesphp/courseSQL/crudTableCourse.php",
					data: {"action":action,"course":course}
				}).done( function( info ){
											loading();
										 if(Number(info)==1){
											  mensajeSend("Se registro correctamente el curos: "+ courses[0]);
												$('#formularioCourse')[0].reset();
												CKEDITOR.instances['descriptionNewCourse'].setData('');
												document.getElementById('id05').style.display='none';

										 }else if (Number(info)==2) {
										 		mensajeSend("El curso: "+courses[0]+" ya existe\n debe tener otro nombre");
										 }else if (Number(info)==3) {
										 		mensajeSend("El curso: "+courses[1]+" ya existe\n debe tener otro nombre");
										 }else if(Number(info)==4){
											 	mensajeSend("Se actuaizo correctamente el curos: "+ courses[1]);
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

	//Funcion que toma los datos del formulario de creación del cuerso
	function createNewCourse(){
		let nameCourse = document.getElementById('nameCourse').value; /*0*/
		let descriptionNewCourse = CKEDITOR.instances['descriptionNewCourse'].getData(); /*1*/
		let course = new Array(nameCourse,descriptionNewCourse);
		for (let	 i in course){if((course[i]=="") ) {bas++;}}
		if (bas==0){
			$('#infoPanelClose').hide();
			ajaxSettingCourse(course,1);

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
		let course = [idCourse, name_course, description_course];
		ajaxSettingCourse(course,7);
	}

function main(){
	$("#addCoruse").click(function(){
		document.getElementById('id05').style.display='block';
	 });
	$("#newCourse").click(function(){
		createNewCourse();
	});
	$("#deleteElement").click(function(){
    var id_element = document.getElementById('id_element').value;
    ajaxSettingCourse(id_element,6);
		document.getElementById('id01').style.display='none';
	});

	$("#edite-Course").click(function(){
		editThisCourse();
	});

}
