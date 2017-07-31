var courses_inscription = [];


function mensajeWarning(info){
		$('#warningInfo').html(`<h4>`+info+`</h4>`);
		var modalWarning = document.getElementById('id09');
		modalWarning.style.display='block';
		$("#acep").click(function(){
			 $("#id09").stop(true, true);
		 });
	}

var get_data_state =function(tbody, table){

  $(tbody).on('change','#inscription', function(){

      try {
            var data = table.row( $(this).parents("tr") ).data();
            let tam = courses_inscription.length;
            if(tam <5 && $(this).val()=='yes'){

                let course= {state:$(this).val(), id_course:data.idco};
                courses_inscription.push(course);


            }else if (tam >= 5 && $(this).val()=='yes') {
                mensajeWarning("No se puede inscribir mas de 5 cursos ");
                $(this).val('no');
            }else if ($(this).val()=='no') {

              for(let i=0; i<=tam ; i++){
                if(courses_inscription[i].id_course==data.idco){
                  courses_inscription.splice(i,1);
                }
              }

            }

            if(courses_inscription.length>0){
							document.getElementById('next3').disabled=false;
                document.getElementById('next5').disabled=false;
            }
      } catch (e) {
        // console.error(e);
      }

    });


    $( "#next5" ).mouseenter(function() {
      if(courses_inscription.length<=0){
          mensajeWarning("Tiene que inscribir al menos un curso");
          document.getElementById('next5').disabled=true;
      }else{
        document.getElementById('next5').disabled=false;
      }
    });

    $( "#next3" ).mouseenter(function() {
      if(courses_inscription.length<=0){
          mensajeWarning("Tiene que inscribir al menos un curso");
          document.getElementById('next3').disabled=true;
      }else{
        document.getElementById('next3').disabled=false;
      }
    });

  }

  var get_description_course = function(tbody, table){
    $(tbody).on('click','#detailCoruse', function(){
      var data = table.row( $(this).parents("tr") ).data();
      try {
        $('#InfoElement').html(`<h5>`+data.dc+`</h5`);
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

function inscriptionCourse(){
  return courses_inscription;
}
