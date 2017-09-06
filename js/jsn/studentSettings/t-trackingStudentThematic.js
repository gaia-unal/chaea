  function loadingiTematic(){
    var idCourseJsn =  readCookie('idCourseJsn');
    table =   $('#dataTableStudentTrakingThema').DataTable( {
                 "scrollX": true,
                 "scrollY": 300,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/studentSQL/t-trackingStudentCrud.php",
                    "data":{"action":5, "idCourse":idCourseJsn}
                 },
                 "columns": [
                   {
                    "defaultContent": `<td>
                                        <center>
                                          <input class='betara selectThe'  required='required' name='studentId' type=radio>
                                        </center>
                                      </td>`,
                    "searchable":false,
                    "sortable":false
                    },
                    {
                      "data": "id_thematic",
                      "render": function(state){
                       return "<center>"+state+"<center>";
                      }
                    },
                    {
                      "data": "name_thematic",
                      "render": function(state){
                       return "<center>"+state+"<center>";
                      }
                    }
                 ],
                 "language": idioma_espana
               });
               get_slect_thematic('#dataTableStudentTrakingThema tbody',table)


  }
  var get_slect_thematic =function(tbody, table){
        $(tbody).on('click','.selectThe', function(){

            var data = table.row($(this).parents("tr")).data();
            try {
                      let thematics = [data.id_thematic, data.name_thematic];
                       thematics = JSON.stringify(thematics);
                      createCookie('thematics',thematics,1);
            } catch (e) {
              console.error(e);
            }

          });

        }



  var idioma_espana={
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
                      "sEmptyTable":     "Aún no ha se han creado temáticas",
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
