$(document).ready(function() {
  loading();

});


  function loading(){
    table =   $('#dataTableCouStu').DataTable( {
                 "scrollX": true,
                 "scrollY": 490,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/courseSQL/s-course.php",
                    "data":{ "action":1}
                 },
                 "columns": [
                   {
                     "data": "idco",
                     "render": function(state){
                      return "<center>"+state+"<center>";
                     }
                   },
                   {
                     "defaultContent":` <center>
                                          <select   id="inscription">
                                              <option value="no">No</option>
                                              <option value="yes">Si</option>
                                          </select>
                                        </center>`,
                     "searchable":false,
                     "sortable":false
                   },
                   {
                     "data": "namco",
                     "render": function(state){
                       return "<center>"+state+"<center>";
                     }
                   },
                   {
                     "data": "dc",
                     "searchable":false,
                     "sortable":false,
                     "render": function(state){
                      return "<center><button id='detailCoruse' class='btn btn-success btn-circle'><i class='fa fa-file-text-o' aria-hidden='true'></i></button></div></center>";
                    }

                   }
                 ],
                 "language": idioma_espanol
               });
               get_data_state('#dataTableCouStu tbody',table);
               get_description_course('#dataTableCouStu tbody',table);

  }






      var idioma_espanol={
                          "sProcessing":     "Procesando...",
                          "sLengthMenu": 'Mostrar <select>'+
                              '<option value="2">2</option>'+
                              '<option value="10">10</option>'+
                              '<option value="20">20</option>'+
                              '<option value="30">30</option>'+
                              '<option value="40">40</option>'+
                              '<option value="50">50</option>'+
                              '<option value="-1">All</option>'+
                              '</select> registros',
                          "sZeroRecords":    "No se encontraron resultados",
                          "sEmptyTable":     "Aún no se han creado cursos",
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
