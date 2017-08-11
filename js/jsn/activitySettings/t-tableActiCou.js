$(document).ready(function() {
  //loading();
});
try {
  var idCourseJsn =  readCookie('idCourseJsn');
  var ac =  readCookie('ac');
} catch (e) {}

  function loading(){



    table =   $('#dataTableActiCou').DataTable( {
                 "scrollX": true,
                 "scrollY": 300,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/activitySQL/t-activityCourse.php",
                    "data":{"idCourse":idCourseJsn, "action":ac}
                 },
                 "columns": [
                   {
                     "data": "id_activity",
                     "render": function(state){
                      return "<center>"+state+"<center>";
                     }
                   },
                   {
                     "data": "state_system_activity",
                     "searchable":false,
                     "sortable":false,
                     "render": function(state){
                      if(state=='Activo'){
                         return '<center><label value="Activo" class="switch"><input type="checkbox" checked><div class="slider round"></div></label></center>'
                       }else{return '<center><label value="Inactivo" class="switch"><input type="checkbox"><div class="slider round"></div></label></center>'}
                     }
                   },
                   {
                     "defaultContent": "<center><button id='editActi' type='button' name='button' class='edit btn btn-warning'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></center>",
                     "searchable":false,
                     "sortable":false
                   },
                   {
                    "defaultContent": "<center><button id='delete' type='button' name='button' class='delete btn btn-danger' ><i class='fa fa-trash'  aria-hidden='true'></i></button></center>",
                    "searchable":false,
                    "sortable":false
                   },
                   {
                     "data": "description_activity",
                     "searchable":false,
                     "sortable":false,
                     "render": function(state){
                      return "<center><button id='detailActivity' class='btn btn-success btn-circle'><i class='fa fa-file-text-o' aria-hidden='true'></i></button></div></center>";
                    }

                   },
                   { "data": "thematic" },
                   { "data": "name_activity" },
                   { "data": "strategy" },
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
                   }
                 ],
                 "language": idioma_espanol
               });
              sum(idCourseJsn);
              get_edit_acti('#dataTableActiCou tbody',table);
              get_description_activity('#dataTableActiCou tbody',table);
              get_data_state('#dataTableActiCou tbody',table);
              get_data_delete('#dataTableActiCou tbody',table);
  }

  function sum(id_course){
     let total = ajaxSettingActivity(id_course,7);//total de lo que de.
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
      //Funcion cargar datos al modal de actividad.
      var get_edit_acti = function(tbody, table){
        $(tbody).on('click','#editActi', function(){
          try {
              let data = table.row( $(this).parents("tr") ).data();
              let id_learning;


              $('#id_edit_activ').val(data.id_activity);
              $('#name_ed_activity').html('Esta editando la actividad '+data.name_activity);
              $('#name_edit_activity').val(data.name_activity);
              $('#thematic_edit_activity').val(data.thematic);
              $('#weight_edit').val(data.weight);
              $('#weight_lo').html(data.weight+'%');
              let total_salary = $('#total_salary').val();
              let limit1 = total_salary- data.weight ;
              let limit = 100-limit1;
              $('#weight_edit').attr({'max':limit});

              if(data.type_learning=='activo'){
                id_learning = 1;
              }else if (data.type_learning=='reflexivo') {
                id_learning = 2;
              }else if (data.type_learning=='teórico') {
                id_learning = 3;
              }else if (data.type_learning=='pragmático') {
                id_learning = 4;
              }
              $('#id_type_edit_learning').val(id_learning);
              ajaxSettingActivity(id_learning, 8);
              //cargar la estrategia.
              let activity = [data.strategy, id_learning];
              ajaxSettingActivity(activity, 9);

              estrategyActivity();//carga las estrategias dependiendo del estilo que tome.

              CKEDITOR.instances['description_edit_activity'].setData(data.description_activity);
            	document.getElementById('id11').style.display='block';
          } catch (e) {
              console.error('e');
          }

       });
      }
      //fin funcion

      var get_data_state =function(tbody, table){
        $(tbody).on('click','.switch', function(){

            var data = table.row($(this).parents("tr")).data();
            try {
                  if (data.state_system_activity =='Inactivo'){
                     let activity = [data.id_activity, data.name_activity, idCourseJsn];
                     ajaxSettingActivity(activity,4);
                     loading();
                  }
                  if (data.state_system_activity =='Activo') {
                     let activity = [data.id_activity, data.name_activity, idCourseJsn];
                     ajaxSettingActivity(activity,5);
                     loading();
                  }
            } catch (e) {
              console.error(e);
            }

          });

        }

      var get_data_delete =function(tbody, table){
        $(tbody).on('click','button.delete', function(){
          document.getElementById('id01').style.display='block';
          var data = table.row($(this).parents("tr")).data();
          try {
            $('#elements').html('¿Seguro que desea eliminar la actividad: '+data.name_activity+'?');
            $('#id_element').val(data.id_activity);
          } catch (e) {  }

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
