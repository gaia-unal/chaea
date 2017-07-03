var j=0;
$(document).ready(function() {
  loading();
});
$("#btn_listar").on("click", function(){
  limpiar_datos();
  loading();
})

function loading(){
  table =   $('#datatable').DataTable( {
               "scrollX": true,
               "scrollY": 500,
               "bDeferRender": true,
               "sPaginationType": "full_numbers",
               "destroy":true, //esto es para que me refresque la tabla sin problemas
               "ajax": {
                 "method": "POST",
                 "url": "backendPhp/teacherSQL/settingTeacher.php"
               },
               "columns": [
                 { "data": "state",
                    "searchable":false,
                    "sortable":false,
                    "render": function(state){
                      if(state=='Activo'){
                        return '<center><label value="Activo" class="switch"><input type="checkbox" checked><div class="slider round"></div></label></center>'
                      }else{return '<center><label value="Inactivo" class="switch"><input type="checkbox"><div class="slider round"></div></label></center>'}
                    }
                  },
                 { "defaultContent": "<center><button id='editar' type='button' name='button' class='edit btn btn-warning'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></center>",
                   "searchable":false,
                   "sortable":false
                 },
                 { "defaultContent": "<center><button id='eliminar' type='button' name='button' class='delete btn btn-danger' ><i class='fa fa-trash'  aria-hidden='true'></i></button></center>",
                   "searchable":false,
                   "sortable":false
                  },
                 { "data": "number_document" },
                 { "data": "type_document" },
                 { "data": "name" },
                 { "data": "birthplace" },
                 { "data": "birthdate" },
                 { "data": "university" },
                 { "data": "email" },
                 { "data": "number_phone" },
                 { "data": "nickname" },
                 { "data": "gender" }
               ],
               "language": idioma_espanol
             });

             get_data_state('#datatable tbody',table);
             get_data_edit('#datatable tbody',table);
             get_data_delete('#datatable tbody',table);
            //  table.ajax.reload();
}

var limpiar_datos = function(){
  $('#name').val("");
  $('#birthdate').val("");
  $('#document_type').val("");
  $('#number_document').val("");
  $('#gender').val("");
  $('#native_city').val("");
  $('#id_role').val("");
  $('#university').val("");
  $('#number_phone').val("");
  $('#email').val("");
  $('#nickname').val("");
  $('#deletElement #id_element').val("");
}
    var get_data_edit =function(tbody, table){
      $(tbody).on('click','button.edit', function(){
        var data = table.row( $(this).parents("tr") ).data();
        var typeDoc=0;

      try {

        if(data.type_document.localeCompare('Cédula de Ciudadanía')==0){
          typeDoc=1;
          }else if (data.type_document.localeCompare('Cédula de Extranjería')==0) {
            typeDoc=2;
        }else{typeDoc=3;}

        var name = $('#name').val(data.name),
            birthdate = $('#birthdate').val(data.birthdate),
            document_type = $('#document_type').val(typeDoc),
            number_document = $('#number_document').val(data.number_document),
            gender = $('#gender').val(data.gender),
            native_city = $('#native_city').val(data.birthplace),
            id_role = $('#id_role').val(data.id_role),
            university = $('#university').val(data.university),
            number_phone = $('#number_phone').val(data.number_phone),
            email = $('#email').val(data.email),
            nickname = $('#nickname').val(data.nickname);
            document.getElementById('id02').style.display='block';

          } catch (e) {

          }


      });
    }

    var get_data_delete =function(tbody, table){
      $(tbody).on('click','button.delete', function(){
        document.getElementById('id01').style.display='block';
        var data = table.row($(this).parents("tr")).data();


        try {
          $('#elements').html(`¿Seguro que desea eliminar el usuario: `+data.name+`?`);
          var number_document = $('#deletElement #id_element').val(data.number_document);

        } catch (e) {

        }

      });
    }


    var get_data_state =function(tbody, table){
      $(tbody).on('click','.switch', function(){
        var data = table.row($(this).parents("tr")).data();

        try {
                let person = new Array(data.name,data.number_document);
            if(data.state=='Inactivo'){

               ajaxSetting(person,3);
               loading();
            }
            if (data.state=='Activo') {
               ajaxSetting(person,4);
               		loading();
            }
        } catch (e) {

        }

      });

    }

//mas idiomas: https://datatables.net/plug-ins/i18n/
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
