
try {
  var idCourseJsn =  readCookie('idCourseJsn');

} catch (e) {}
  function loading(){

    table =   $('#dataTableStudentTraking').DataTable( {
                 "scrollX": true,
                 "scrollY": 195,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/courseSQL/s-course.php",
                    "data":{"courses":idCourseJsn, "action":10}
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
                     "data": "note_ac",
                     "render": function(state){
                       return "<center>"+state+"<center>";
                      }
                   },
                   {
                     "data": "weight",
                     "render": function(state){
                       return "<center>"+Math.round(state)+"%<center>";
                      }
                   },
                 ],
                 "language": idioma_espanol
               });

  }





  var idioma_espanol={
                      "sProcessing":     "Procesando...",
                      "sLengthMenu": 'Mostrar <select>'+
                          '<option value="5">5</option>'+
                          '<option value="-1">All</option>'+
                          '</select> registros',
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Aún no hay estudiantes activos o inscritos o no se han creado actividades.",
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
