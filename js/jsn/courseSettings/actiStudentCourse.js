document.addEventListener('DOMContentLoaded',main);
var idCourseJsn="", ac="";
//Efecto del radion bouton
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

//Capturar el id de la tabla
function getDataTableCoruse(){
  $(".radij").click(function(){

        $(this).parents("tr").find("#idCourse").each(function(){
        idCourseJsn=$(this).html()+"\n";
        createCookie('idCourseJsn', idCourseJsn, 1);
        });
        $(this).parents("tr").find("#nameCourse").each(function(){
        nameCourse=$(this).html()+"\n";
        });
        $('#nameEstudentCourse').html("Activa o desactiva los estudiantes al curso de: <br><div>"+nameCourse+"</div>");
        $('#nameActiCou').html("Crea, edita, elimina, activa o desactiva las actividades para el cuso: <br><div>"+nameCourse+"</div>");
        $('#nameActiCouNote').html("Selecciona un estudiante del curso de:  <br><div>"+nameCourse+"</div>");
        $('#nameCouNote').html("Notas de la actividades del curos de:  <br><div>"+nameCourse+"</div>");


  });
}

//función que permite crear la paginación
function paginationCourse(){
    $(".coursePage").pagination();
}


function mensajePanel(info, option){
  switch (option) {
    case 1:
      $('#erroCourse').html("<div id='infoPanelClose' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>&times;</button><strong>"+info+"</strong></a> </div>");
      return false;
      break;
    case 2:
      $('#infoPanel2').html("<div id='infoPanelClose' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>&times;</button><strong>"+info+"</strong></a> </div>");
      return false;
      break;
  }
  return false;

}




function main(){
  $('#next1').click(function(){
    if(idCourseJsn==""){
      let info='Debe selecionar un curso.';
      mensajePanel(info,1);
    }

    if(idCourseJsn!=""){
      ac="1";
      createCookie('ac', ac, 1);
      loading();//cargar tabla
    }
  })
  $('#next1-1').click(function(){
    if(idCourseJsn==""){
      let info='Debe selecionar un curso.';
      mensajePanel(info,1);
    }

    if(idCourseJsn!=""){
      ac="1";
      createCookie('ac', ac, 1);
      loading();//cargar tabla
    }
  })

  paginationCourse();
  getDataTableCoruse();
  lod();

}
