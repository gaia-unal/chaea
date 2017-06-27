$(document).ready(function() {
  loading();
});

function loading(){
  table =   $('#dataTableCourse').DataTable( {
               "scrollX": true,
               "scrollY": 500,
               "bDeferRender": true,
               "sPaginationType": "full_numbers",
               "destroy":true, //esto es para que me refresque la tabla sin problemas
               "ajax": {
                 "method": "POST",
                 "url": "/chaea/funcionesphp/courseSQL/settingCourse.php"
               },
               "columns": [
                 { "data": "state_system_course",
                    "searchable":false,
                    "sortable":false,
                  },
                 { "data": "id_course" },
                 { "data": "name_course" },
                 {
                   "data": "description_course",
                   "render": function(state){
                     return "<center><button id='detailCoruse' class='btn btn-success btn-circle'><i class='fa fa-file-text-o' aria-hidden='true'></i></button></div>";
                    }
                  },
                 { "data": "num_est" },
                 { "data": "num_act" }
               ],
               "language": idioma_espanol
             });
             get_description_course('#dataTableCourse tbody',table);
}


var get_description_course = function(tbody, table){
  $(tbody).on('click','#detailCoruse', function(){
    var data = table.row( $(this).parents("tr") ).data();
    try {
      $('#InfoCourse').html(`<h5>`+data.description_course+`</h5`);
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
