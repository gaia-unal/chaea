
var courses_inscription = [];

function ajaxCourseIsn(action , data, obj) {
		$.ajax({
		 method:"POST",
		 url: "/chaea/backendPhp/courseSQL/s-course.php",
		 data: {"action":action}
	 }).then( function( info ){
				 nc =  Number(info);
			 if(data==null){
				 $('#infoCuourseIns').html(`<h4> Cursos Inscritos `+nc+`/5</h4>`);
			 }else{
				 pol(nc, data, obj);
			 }

	 });
 }
function ajaxCourseCrud(action , courses) {
		var courses = JSON.stringify(courses);
		$.ajax({
		 method:"POST",
		 url: "/chaea/backendPhp/courseSQL/s-course.php",
		 data: {"action":action, "courses":courses}
	 }).then( function( info ){
		 if(Number(info)==2){
			 mensajeSend("Se registró los cursos correctamente");
		 }else if (Number(info)==3) {
		 	 mensajeSend("Se cancelo el cursos correctamente");
		 }else{
			 if(info!=""){
				 	mensajeSend(info);
				}
		 }

	 });
 }


	function mensajeWarning(info){
		$('#warningInfo').html(`<h4>`+info+`</h4>`);
		var modalWarning = document.getElementById('id09');
		modalWarning.style.display='block';
		$("#acep").click(function(){
			 $("#id09").stop(true, true);
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

	function pol (nc, data, obj){
		 var tam = nc + courses_inscription.length;

				if(tam <5 && $(obj).val()=='yes'){

					let course= {state:$(obj).val(), id_course:data.idco};
					courses_inscription.push(course);
					$('#infoCuourseIns').html(`<h4> Cursos Inscritos `+(nc+ courses_inscription.length)+`/5</h4>`);


				}else if (tam >= 5 && $(obj).val()=='yes') {
					mensajeWarning("No se puede inscribir mas de 5 cursos ");
					$(obj).val('no');
				}else if ($(obj).val()=='no') {
					for(let i=0; i<=courses_inscription.length ; i++){
						if(courses_inscription[i].id_course==data.idco){
							courses_inscription.splice(i,1);
						}
					}
					$('#infoCuourseIns').html(`<h4> Cursos Inscritos `+(nc+ courses_inscription.length)+`/5</h4>`);

				}



				if(courses_inscription.length>0){
					document.getElementById('addCourseIns').disabled=false;
				}
	}

var get_data_state =function(tbody, table){

  $(tbody).on('change','#inscription', function(){
      try {
							 var data = table.row( $(this).parents("tr") ).data();
						   ajaxCourseIsn(3, data, this);
      } catch (e) {
        console.error(e);
      }

    });


    $( "#addCourseIns" ).mouseenter(function() {
      if(courses_inscription.length<=0){
          mensajeWarning("Tiene que inscribir al menos un curso");
          document.getElementById('addCourseIns').disabled=true;
      }else{
        document.getElementById('addCourseIns').disabled=false;
      }
    });

		$( "#addCourseIns" ).click(function() {
			if(courses_inscription.length>0){
					ajaxCourseCrud(4, courses_inscription);
					courses_inscription.length=0;
					loading();
			}
		});

}

  var get_description_course = function(tbody, table){
    $(tbody).on('click','#detailCoruse', function(){
	      var data = table.row( $(this).parents("tr") ).data();
	      try {
	        $('#InfoElement').html(`<h5>`+data.dc+`</h5`);
	        var modalInfo = document.getElementById('id06');
	        modalInfo.style.display='block';
	         $("#acept").click(function(){
	            $("#id06").hide();
	          });
	        //se muestra moodal de Detalle del curso.
	      } catch (e) {
	          console.error(e);
	      }
   	});
  }



  var get_data_delete =function(tbody, table){
    $(tbody).on('click','button.delete', function(){
      document.getElementById('id01').style.display='block';
      var data = table.row($(this).parents("tr")).data();
      try {
        $('#elements').html('¿Seguro que desea eliminar el curso: '+data.namco+'?');
        $('#id_element').val(data.idco);
      } catch (e) {  }

    });

		$("#deleteElement").click(function(){
	    var id_element = document.getElementById('id_element').value;
	    ajaxCourseCrud(6,id_element);
		  loading();
			ajaxCourseIsn(3, null, null);
			document.getElementById('id01').style.display='none';
		});
  }

function inscriptionCourse(){
  return courses_inscription;
}
