var co=0;
$(document).ready(function() {
  ajaxCourseIsn(3, null, null);
  loading();

});



  function loading(){
    table =   $('#dataTableCouStuDelete').DataTable( {
                 "scrollX": true,
                 "scrollY": 490,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/courseSQL/s-course.php",
                  "data":{ "action":5}
                 },
                 "columns": [
                   {
                     "data": "idco",
                     "render": function(state){
                      return "<center>"+state+"<center>";
                     }
                   },
                   {
                     "defaultContent": `<center>
                                          <button id='delete' type='button' name='button' class='delete btn btn-danger' >
                                            <i class='fa fa-trash'  aria-hidden='true'></i>
                                          </button>
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
                      return `<center>
                                <button id='detailCoruse' class='btn btn-success btn-circle'>
                                  <i class='fa fa-file-text-o' aria-hidden='true'></i>
                                </button>
                              </center>`;
                    }

                   }
                 ],
                 "language": idioma_espanol
               });


               get_description_course('#dataTableCouStuDelete tbody',table);
               get_data_delete('#dataTableCouStuDelete tbody',table);

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
                          "sEmptyTable":     "Sobrepasa el límite de cursos inscritos permitido",
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
