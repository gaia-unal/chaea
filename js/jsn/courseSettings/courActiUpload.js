document.addEventListener('DOMContentLoaded',mainis);
var idCourseJsn="", ac="", nameCourse;

//Capturar el id de la tabla
function getDataTableCoruse(){
  //Se crea Cookie donde esta el Id del curso al dar click en el radian boton. 
  $(".radij").click(function(){
        $(this).parents("tr").find("#idCourse").each(function(){
          idCourseJsn=$(this).html()+"\n";
          createCookie('idCourseJsn', idCourseJsn, 1);
        });
        $(this).parents("tr").find("#nameCourse").each(function(){
          nameCourse=$(this).html()+"\n";
        });
        $('#nameActiCou').html("Selecciona una actividad del curso <br><div>"+nameCourse+"</div>");

  });
}


function mensajePanel(info, option){

  switch (option) {
    case 1:
      $('#errorCourse').html(`<div id='infoPanelClose' class='alert alert-dismissible alert-warning'>
                                <button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>
                                  &times;
                                </button>
                                <strong>`+info+`</strong>
                                </a>
                             </div>`);
      return false;
      break;
    case 2:
      $('#infoPanel2').html(`<div id='infoPanelClose' class='alert alert-dismissible alert-warning'>
                                <button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>
                                    &times;
                                </button>
                                <strong>`+info+`</strong>
                              </a>
                            </div>`);
      return false;
      break;
  }
  return false;

}

function checkRadian(){
  $('#next1').click(function(){
    if(idCourseJsn==""){

      let info='Debe selecionar un curso.';
      mensajePanel(info,1);
    }

    if(idCourseJsn!=""){
      loadingos();//cargar tabla
    }
  });

  $('#next1-1').click(function(){
    if(idCourseJsn==""){
      let info='Debe selecionar un curso.';
      mensajePanel(info,1);
    }

    if(idCourseJsn!=""){
      loadingos();//cargar tabla
    }
  });
  $('#next4').click(function(){
      loadingos();//cargar tabla
  });
}


function mensajeConfirm(info){
  $('#warningInfos').html(`<h4>`+info+`</h4>`);
  var modalWarning = document.getElementById('id16');
  modalWarning.style.display='block';
  $("#close").click(function(){
     $("#id16").stop(true, true);
   });
  $("#confirmYes").click(function(){
    ajaxCourseCrud(9,null);//para sustituir el archivo
    sendArchive();//para sustituir el archivo
    loadingos();
    document.getElementById('id16').style.display='none';
    document.getElementById('id15').style.display='none';
   });
}
function ajaxCourseUrlUpload(file) {

        $.ajax({
          data: file,
          url: "/chaea/backendPhp/courseSQL/archi.php",
          type:"POST",
          processData: false,
          contentType: false,
          success: function(info){
            if (Number(info)==1) {
               info="El archivo ya existe ¿quiere sustituirlo de todas formas? ";
               mensajeConfirm(info);
            }else if (Number(info)==2) {
              info="No ha seleccionado ningún archivo.";
              mensajeWarning(info);
            }else if (Number(info)==3) {
              info="No se puede subir este tipo de archivo ";
              mensajeWarning(info);
            }else if (Number(info)==4) {
              info="Se guardo correctamente el archivo";
              mensajeSend(info);
            }else{
              mensajeWarning(info);
            }
          }
        });
}
function sendArchive(){
  var file = new FormData($("#formUpload")[0]);
  var nameArchi = nameCourse.toLowerCase().split(" ", 2);
  let id_activity = $('#id_activity').val();/*0*/
  urlCourse = "/uploads/"+nameArchi[0]+"_"+nameArchi[1]+"_"+idCourseJsn+"/"+id_activity;
  let course = [urlCourse, id_activity ];
  ajaxCourseCrud(8,course);//se crea la session con la ruta en php
  ajaxCourseUrlUpload(file);// se guarda el archivo en la ruta dada en la session
  loadingos();
  document.getElementById('id15').style.display='none';
}

function lod(){
  try{
      function tam(){this.style.width = "25px";this.style.height = "25px";}
      function min(){this.style.width = "";this.style.height = "";}
         for (var i = 0; i < coursesLet ; i++) {//160
           document.getElementsByClassName('radij')[i].addEventListener('mouseenter', tam);
           document.getElementsByClassName('radij')[i].addEventListener('mouseleave', min);
         }
    }catch (e) {console.log('e1')}

}


function mainis(){
  lod();
  getDataTableCoruse();
  checkRadian();
  $('#uploadFile').click(function (){
    sendArchive();
  });

}
