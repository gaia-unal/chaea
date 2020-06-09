$(document).ready(function() {
  //loading();
});
try {
  var idCourseJsn =  readCookie('idCourseJsn');
} catch (e) {}

  function loadingThematic(){



    table =   $('#dataTableThematic').DataTable( {
                 "scrollX": true,
                 "scrollY": 300,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true,
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/thematicSQL/t-thematic.php",
                    "data":{"idCourse":idCourseJsn, "action":1}
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
                   },

                   {
                     "defaultContent": `<center>
                                          <button id='editThema' type='button' name='button' class='edit btn btn-warning'>
                                            <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                          </button>
                                        </center>`,
                     "searchable":false,
                     "sortable":false
                   },
                   {
                    "defaultContent": `<center>
                                          <button id='deleteThema' type='button' name='button' class='delete btn btn-danger'>
                                           <i class='fa fa-trash'  aria-hidden='true'></i>
                                          </button>
                                        </center>`,
                    "searchable":false,
                    "sortable":false
                   }
                 ],
                 "language": idioma_espanol
               });

              get_slect_thematic('#dataTableThematic tbody',table);
              get_edit_thematic('#dataTableThematic tbody',table);
              get_data_deletes('#dataTableThematic tbody',table);
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


      //Seleccionar un radian bouton
      var get_slect_thematic =function(tbody, table){
        $(tbody).on('click','.selectThe', function(){
                try {
                    var data = table.row($(this).parents("tr")).data();
                    $('#nameTheCou').html("Crea, edita, elimina, activa o desactiva las actividades para la tematica: <br><div>"+data.name_thematic+"</div>");
                           let thematicJsn = data.id_thematic;
                           createCookie('thematicJsn',Number(thematicJsn),1);
                } catch (e) {
                  console.error('e');
                }

              });

            }


      //Funcion cargar datos al modal de la tematica.
      var get_edit_thematic = function(tbody, table){
        $(tbody).on('click','#editThema', function(){
          try {
              let data = table.row( $(this).parents("tr") ).data();
              $('#id_edit_thematic').val(data.id_thematic);
              $('#name_edit_thematic').html('Esta editando la temática de '+data.name_thematic);
              $('#thematic_edit_activity').val(data.name_thematic);
            	document.getElementById('id18').style.display='block';
          } catch (e) {
              console.error('e');
          }

       });
      }
      //fin funcion

      var get_data_deletes =function(tbody, table){
        $(tbody).on('click','#deleteThema', function(){
          try {
            let data = table.row( $(this).parents("tr") ).data();
            $('#elements').html('¿Seguro que desea eliminar la temática: '+data.name_thematic+'?');
            $('#id_element').val(data.id_thematic);
            document.getElementById('id01').style.display='block';
          } catch (e) {  }

        });
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
                          "sEmptyTable":     "Aún no han creado actividades.",
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
