document.addEventListener('DOMContentLoaded',main);
  var idCourse="", nameCourse="";
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

        //Obtenemos todos los
        //valores contenidos en los
        //<td> de la fila
        // seleccionada
        $(this).parents("tr").find("#idCourse").each(function(){
        idCourse=$(this).html()+"\n";
        });
        $(this).parents("tr").find("#nameCourse").each(function(){
        nameCourse=$(this).html()+"\n";
        });
        console.log(idCourse);
        // alert(nameCourse);
        // alert(idCourse);
        $('#nameEstudentCourse').html("Agrega los Estudiantes Al Curso De: <br><div>"+nameCourse+"</div>");

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
    if(idCourse==""){
      let info='Debe selecionar un curso.';
      mensajePanel(info,1);
    }
  })

  paginationCourse();
  getDataTableCoruse();
  lod();

}
