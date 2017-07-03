  $(document).ready(function() {
    loading();
  });

  function loading(){
    table =   $('#dataTableCourseTeacher').DataTable( {
                 "scrollX": true,
                 "scrollY": 500,
                 "bDeferRender": true,
                 "sPaginationType": "full_numbers",
                 "destroy":true, //esto es para que me refresque la tabla sin problemas
                 "ajax": {
                   "method": "POST",
                   "url": "/chaea/backendPhp/courseSQL/settingCourseTeacher.php"
                 },
                 "columns": [
                   {
                     "data": "state_system_course",
                     "searchable":false,
                     "sortable":false,
                     "render": function(state){
                      if(state=='Activo'){
                         return '<center><label value="Activo" class="switch"><input type="checkbox" checked><div class="slider round"></div></label></center>'
                       }else{return '<center><label value="Inactivo" class="switch"><input type="checkbox"><div class="slider round"></div></label></center>'}
                     }
                   },
                   {
                     "defaultContent": "<center><button id='editCourse' type='button' name='button' class='edit btn btn-warning'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></center>",
                     "searchable":false,
                     "sortable":false
                   },
                   {
                    "defaultContent": "<center><button id='eliminar' type='button' name='button' class='delete btn btn-danger' ><i class='fa fa-trash'  aria-hidden='true'></i></button></center>",
                    "searchable":false,
                    "sortable":false
                   },
                   { "data": "id_course" },
                   { "data": "name_course" },
                   {
                     "data": "description_course",
                     "render": function(state){
                      return "<center><button id='detailCoruse' class='btn btn-success btn-circle'><i class='fa fa-file-text-o' aria-hidden='true'></i></button></div>";
                    }

                   },
                   { "data": "quotas_course" },
                   { "data": "num_est_ac" },
                   { "data": "cup_dis" },
                   { "data": "num_est" },
                   { "data": "num_act" }
                 ],
                 "language": idioma_espanol
               });
               get_data_state('#dataTableCourseTeacher tbody',table);
               get_description_course('#dataTableCourseTeacher tbody',table);
               get_data_delete('#dataTableCourseTeacher tbody',table);
               get_edit_course('#dataTableCourseTeacher tbody',table);


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
    //Funcion editar curso.
    var get_edit_course = function(tbody, table){
      $(tbody).on('click','#editCourse', function(){
        var data = table.row( $(this).parents("tr") ).data();
        try {
            $('#nameEditeCourse').html('Esta editando el curso '+data.name_course);
            $('#idEditeCourse').val(data.id_course);
            $('#nameEditCourse').val(data.name_course);

            if(data.quotas_course!="N/A"){
              $('#quotas_edit_course').val("Si");
              formEditLimit();
              $('#limit-edit-quotas').val(data.quotas_course);
            }
            CKEDITOR.instances['descriptionEditeCourse'].setData(data.description_course);
          	document.getElementById('id07').style.display='block';
        } catch (e) {
            console.error(e);
        }

     });
    }



    var get_data_state =function(tbody, table){
      $(tbody).on('click','.switch', function(){

          var data = table.row($(this).parents("tr")).data();
          try {
              if(data.state_system_course =='Inactivo'){
                ajaxSettingCourse(data.id_course,3);
                loading();
              }
              if (data.state_system_course =='Activo') {
                //para desactivar
                if(data.num_est_ac>0){
                    document.getElementById('id08').style.display='block';
                    $('#elementsDes').html('¿Seguro que desea desactivar el curso: '+data.name_course+'?');
                    $('#elementsDesInf').html('Recuerda que se desactivaran los usuarios que se tengan activos, y estos no podrán acceder al curso.');
                    $('#id_element_des').val(data.id_course);
                }else{
                   ajaxSettingCourse(data.id_course,4);
                   loading();
                 }
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
          $('#elements').html('¿Seguro que desea eliminar el curso: '+data.name_course+'?');

          $('#deletElement #id_element').val(data.id_course);
        } catch (e) {  }

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
                      "sEmptyTable":     "Aún no ha creado ningún curso.",
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
