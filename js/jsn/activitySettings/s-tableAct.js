try {
  var idCourseJsn =  readCookie('idCourseJsn');
} catch (e) {}


  function loadingos(){
    table =   $('#dataTableActiCouStudent').DataTable( {
                 "scrollX": true,
                 "scrollY": 300,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/courseSQL/s-course.php",
                    "data":{"courses":idCourseJsn, "action":7}
                 },
                 "columns": [
                   {
                     "data": "id_activity",
                     "render": function(state){
                      return "<center>"+state+"<center>";
                     }
                   },
                   {
                     "data": "name_act",
                     "render": function(state){
                      return "<center>"+state+"<center>";
                     }
                   },
                   {
                     "data": "description_activity",
                     "searchable":false,
                     "sortable":false,
                     "render": function(state){
                      return `<center>
                                <button id='detailActivity' class='btn btn-success btn-circle'>
                                  <i class='fa fa-file-text-o ' aria-hidden='true'></i>
                                </button>
                              </center>`;
                    }

                   },
                   {
                     "data": "type_learning",
                     "render": function(state){
                      return "<center>"+state+"<center>";
                     }
                   },
                   {
                     "data": "weight",
                     "render": function(state){
                      return "<center>"+state+"%<center>";
                     }
                   },
                   {
                       "data": "path_ac",
                       "searchable":false,
                       "sortable":false,
                      "render": function(state){
                          if(state!=''){
                            return `<center>
                                          <button type='button' id='listActi' class='btn btn-success' >
                                            <i class='fa fa-folder-open fa-2x' aria-hidden='true'></i>
                                          </button>
                                    </center>`;
                          }else{
                           return  "<center>Sin subida<center>";
                          }
                       }
                     },
                 {
                       "defaultContent": `<center>
                                 <button type='button' name='button' id='upload' class='btn btn-success' >
                                   <i class='fa fa-angle-double-up fa-2x' aria-hidden='true'></i>
                                 </button>
                               </center>`,
                       "searchable":false,
                       "sortable":false
                  }
                 ],
                 "language": idioma_espanol

               });
              get_description_activity('#dataTableActiCouStudent tbody',table);
              get_upload_activity('#dataTableActiCouStudent tbody',table);
              get_enlist_activitis('#dataTableActiCouStudent tbody',table);
  }

  function ajaxUrlArchi(path_ac) {
      var path_ac = JSON.stringify(path_ac);
      $.ajax({
       method:"POST",
       url: "/chaea/backendPhp/courseSQL/s-course.php",
        data: {"courses":path_ac, "action":11}
     }).then( function( info ){
        location.href = '/chaea/partials/viewStudent/ListarFile.php';
     });
  }




      var get_description_activity = function(tbody, table){
        $(tbody).on('click','#detailActivity', function(){
          var data = table.row( $(this).parents("tr") ).data();
          try {
            $('#InfoElement').html(`<h5>`+data.description_activity+`</h5`);
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
      var get_upload_activity = function(tbody, table){
        $(tbody).on('click','#upload', function(){
          try {
              var data = table.row( $(this).parents("tr") ).data();
              $('#id_activity').val(data.id_activity);
              var modalUpload = document.getElementById('id15');
              modalUpload.style.display='block';
          } catch (e) {
          }

       });
      }

      var get_enlist_activitis = function(tbody, table){
        $(tbody).on('click','#listActi', function(){
          try {
              var data = table.row( $(this).parents("tr") ).data();
              let path_ac = '/'+data.path_ac;
              ajaxUrlArchi(path_ac);
          } catch (e) {
          }

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
