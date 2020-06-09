$(document).ready(function() {
  loading();
});

function loading(){
  table =   $('#dataTableActivity').DataTable( {
               "scrollX": true,
               "scrollY": 500,
               "bDeferRender": true,
               "sPaginationType": "full_numbers",
               "destroy":true, //esto es para que me refresque la tabla sin problemas
               "ajax": {
                 "method": "POST",
                 "url": "backendPhp/activitySQL/settingActivity.php"
               },
               "columns": [
                 { "data": "state_system_activity"},
                 { "data": "id_activity"},
                 { "data": "name_activity" },
                 { "data": "name" },
                 { "data": "type_learning_description" },
                 { "data": "name_course" }
               ],
               "language": idioma_espanol
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
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
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
