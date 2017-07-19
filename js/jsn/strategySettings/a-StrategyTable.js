$(document).ready(function() {
  loading();
});
  function loading(){
    table =   $('#dataTableStrategy').DataTable( {
                 "scrollX": true,
                 "scrollY": 450,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/strategySQL/a-StrategyActivity.php",
                    "data":{"action":1}
                 },
                 "columns": [
                   {
                     "defaultContent": "<center><button id='editStrategy' type='button' name='button' class='edit btn btn-warning'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></center>",
                     "searchable":false,
                     "sortable":false
                   },
                   {
                       "data": "id_str",
                       "render": function(state){
                        return "<center>"+state+"<center>";
                        }
                   },
                   {
                       "data": "str_des",
                       "render": function(state){
                        return "<center>"+state+"<center>";
                        }
                   },
                   {
                       "data": "ty_lear_des",
                       "render": function(state){
                        return "<center>"+state+"<center>";
                        }
                   },
                   {
                    "defaultContent": "<center><button id='eliminar' type='button' name='button' class='delete btn btn-danger' ><i class='fa fa-trash'  aria-hidden='true'></i></button></center>",
                    "searchable":false,
                    "sortable":false
                   }

                 ],
                 "language": idioma_espanol
               });
                get_edit_strategy('#dataTableStrategy tbody',table);
                get_data_delete('#dataTableStrategy tbody',table);
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
