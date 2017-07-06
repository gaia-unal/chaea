$(document).ready(function() {
  // loading();
});
try {
  var idCourseJsn =  readCookie('idCourseJsn');
  var ac =  readCookie('ac');

} catch (e) {}
  function loading(){
    table =   $('#dataTableCourseActiveStudent').DataTable( {
                 "scrollX": true,
                 "scrollY": 300,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/courseSQL/settingCourseActiveStudent.php",
                    "data":{"idCourse":idCourseJsn, "action":ac}
                 },
                 "columns": [
                   {
                     "data": "state",
                     "searchable":false,
                     "sortable":false,
                     "render": function(state){
                      if(state=='Activo'){
                         return '<center><label value="Activo" class="switch"><input type="checkbox" checked><div class="slider round"></div></label></center>'
                       }else{return '<center><label value="Inactivo" class="switch"><input type="checkbox"><div class="slider round"></div></label></center>'}
                     }
                   },
                   { "data": "idStudent" },
                   { "data": "nameStudente" },
                   { "data": "namecor" }
                 ],
                 "language": idioma_espanol
               });
               get_data_state('#dataTableCourseActiveStudent tbody',table);
  }





      function ajaxSettingActiveCourse(student,action) {
    				let nameStudents = student[1];
    				var student = JSON.stringify(student);
    				$.ajax({
    					method:"POST",
    					url: "/chaea/backendPhp/courseSQL/settingCourseActiveStudent.php",
    					data: {"action":action,"student":student}
    				}).done( function( info ){
    										 if(Number(info)==1){
                           mensajeSend("Se activo correctamente el curso para: "+nameStudents);
    										 }else if (Number(info)==2) {
                           mensajeWarning(`A llegado al tope de cupos disponibles
                                        para este curso, si desea puede
                                        ir a la <a id="coursesTeacher" href="teacherTableCourse.php"><font color="red"><u>configuración de cursos</u></font></a>
                                        y modificar la cantidad de cupos disponibles.`);
    										 }else if (Number(info)==3) {
                           mensajeSend("Se desactivo correctamente el curso para: "+nameStudents);
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
    	}

      var get_data_state =function(tbody, table){
        $(tbody).on('click','.switch', function(){

            var data = table.row($(this).parents("tr")).data();
            try {
                  if (data.state =='Inactivo'){
                     let student = [data.idStudent, data.nameStudente, idCourseJsn];
                     ajaxSettingActiveCourse(student,2);
                     loading();
                  }
                  if (data.state =='Activo') {
                     let student = [data.idStudent, data.nameStudente, idCourseJsn];
                     ajaxSettingActiveCourse(student,3);
                     loading();
                  }
            } catch (e) {
              console.error(e);
            }

          });

        }

  var idioma_espanol={
                      "sProcessing":     "Procesando...",
                      "sLengthMenu": 'Mostrar <select>'+
                          '<option value="10">10</option>'+
                          '<option value="20">20</option>'+
                          '<option value="30">30</option>'+
                          '<option value="40">40</option>'+
                          '<option value="50">50</option>'+
                          '<option value="-1">All</option>'+
                          '</select> registros',
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Aún no han solicitado inscripción a este curso.",
                      "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Filtrar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Por favor espere - cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                      },
                      "oAria": {
                          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                      }
      }
