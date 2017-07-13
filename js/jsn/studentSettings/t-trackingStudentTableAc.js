

  function loadingin(){
    var act =  readCookie('act');
    var idCourseJsn =  readCookie('idCourseJsn');
    var student = JSON.parse(readCookie('student'));
    $('#nameActiNote').html("Edita las notas del estudiante:  <br><div>"+student[1]+"</div>");

    table =   $('#dataTableStudentTrakingAc').DataTable( {
                 "scrollX": true,
                 "scrollY": 300,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/studentSQL/t-trackingStudentCrud.php",
                    "data":{"student":student[0], "action":act, "idCourse":idCourseJsn}
                 },
                 "columns": [
                   {
                       "data": "ac_id",
                       "render": function(state){
                        return "<center>"+state+"<center>";
                        }
                   },
                   {
                       "data": "na_ac",
                       "render": function(state){
                        return "<center>"+state+"<center>";
                        }
                   },
                   {
                     "data": "path_ac",
                     "searchable":false,
                     "sortable":false,
                    "render": function(state){
                        if(state!=''){
                          return "<center><a target='_blank' href='/"+state+"'><button type='button' name='button' class='btn btn-success' ><i class='fa fa-angle-double-down fa-2x' aria-hidden='true'></i></center></a>";
                        }else{
                         return  "<center>Sin subida<center>";
                        }
                     }
                   },
                   {
                     "defaultContent": "<center><button id='editAcNote' type='button' name='button' class='edit btn btn-warning'><i class='fa fa-pencil-square-o fa-2x'  aria-hidden='true'></i></button></center>",
                     "searchable":false,
                     "sortable":false
                   },
                   {
                     "data": "note_ac",
                     "render": function(state){
                       return "<center>"+state+"<center>";
                      }
                   }
                 ],
                 "language": idioma_espan
               });
               get_edit_note('#dataTableStudentTrakingAc tbody',table);

  }


  var get_edit_note = function(tbody, table){
    $(tbody).on('click','#editAcNote', function(){
      try {
        var data = table.row( $(this).parents("tr") ).data();
        // $('#nameEditeCourse').html('Esta editando el curso '+data.na_ac);
        $('#note_edit_activity').val(data.note_ac);
        $('#idEditeNote').val(data.ac_id);
          document.getElementById('id12').style.display='block';
      } catch (e) {
          console.error(e);
      }

   });
   $("#editNote").click(function(){
         try {
           let idEditeNote = $('#idEditeNote').val();
           let noteNumber = $('#note_edit_activity').val();
           noteNumber = noteNumber.replace(",",".");
           var repeticion=0;
           if (!isNaN(noteNumber)){
             noteNumber=parseFloat(noteNumber)
              if(noteNumber<=5){
                var student = JSON.parse(readCookie('student'));
                note = [student[0],noteNumber,idEditeNote];
                 ajaxSettingNote(note,3);
              }else{
                info='la calificación no puede superar el 5';
                mensajeWarning(info);
              }

           }else{
             info='valor no válido para la calificación';
             mensajeWarning(info);
           }




           } catch (e) {
             console.error(e);
           }
     });
  }


  var idioma_espan={
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
                      "sEmptyTable":     "Aún no ha seleccionado un estudiante.",
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
