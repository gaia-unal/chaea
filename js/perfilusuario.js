$(document).ready(function (){
	$('#btn_profile').click(function(){
		$('#cont_profile_user').toggle('slow');
	});


});

$(document).ready(function () {
		main();

    $('.material-button-toggle').on("click", function () {
        $(this).toggleClass('open');
        $('.option').toggleClass('scale-on');
    });



			$('button.tips').each(function () {
		    var severity = $(this).data('severity');
		    $(this).tooltip({
		        content: function () {
		            return '<em>' + $(this).attr('title') + '</em>';
		        },
		        tooltipClass: severity,
		        show: "slideDown",
		        open: function (event, ui) {
		            ui.tooltip.hover(function () {
		                $(this).fadeTo("slow", 1);
		            });
		        }
		    });
		});

});




function main(){
	var URLactual = window.location.pathname;
	var url1="/chaea/partials/viewStudent/s-studentTableCourseIns.php";
	var url2="/chaea/partials/viewStudent/studentIndex.php";
	var url3="/chaea/partials/viewStudent/s-studentDeleteCourseIns.php";
	var url4="/chaea/partials/viewStudent/s-activityStudentCourse.php";
	var url5="/chaea/partials/viewStudent/s-studentTableNoteCourse.php";
	var url6="/chaea/partials/viewStudent/ListarFile.php";

		if(URLactual==url1){

			$('#opt1').html(`<button title="Notas" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableNoteCourse.php';" data-severity="danger" class="tips material-button option1" type="button" >
													<span class="fa fa-check-circle fa-2x" aria-hidden="true"></span>
											 </button>`);

					$('#opt2').html(`<button title="Actividades del Curso" onclick="location.href = '/chaea/partials/viewStudent/s-activityStudentCourse.php';" data-severity="danger" class="tips material-button option2" type="button" >
														<span class="fa fa-pencil-square fa-2x" aria-hidden="true"></span>
													</button>`);

				$('#opt3').html(`<button  title="Inicio" onclick="location.href = '/chaea/partials/viewStudent/studentIndex.php';"  data-severity="danger" class="tips material-button option3" type="button">
														<i class="fa fa-user" aria-hidden="true"></i>
												 </button>`);

				 $('#opt4').html(`<button title="Cancelación de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentDeleteCourseIns.php';" data-severity="danger" class="tips material-button option4" type="button" >
	               					<span class="fa fa-bomb fa-2x" aria-hidden="true"></span>
	             					</button>`);




		}else if(URLactual== url2){

			$('#opt1').html(`<button title="Notas" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableNoteCourse.php';" data-severity="danger" class="tips material-button option1" type="button" >
												 <span class="fa fa-check-circle fa-2x" aria-hidden="true"></span>
											 </button>`);

				$('#opt2').html(`<button title="Actividades del Curso" onclick="location.href = '/chaea/partials/viewStudent/s-activityStudentCourse.php';" data-severity="danger" class="tips material-button option2" type="button" >
														<span class="fa fa-pencil-square fa-2x" aria-hidden="true"></span>
												 </button>`);

				$('#opt3').html(`<button  title="Inscripción de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableCourseIns.php';"  data-severity="danger" class="tips material-button option3" type="button">
														<span class="fa fa-pencil" aria-hidden="true"></span>
												 </button>`);

				$('#opt4').html(`<button title="Cancelación de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentDeleteCourseIns.php';" data-severity="danger" class="tips material-button option4" type="button" >
                					<span class="fa fa-bomb fa-2x" aria-hidden="true"></span>
              					</button>`);
		}else if(URLactual== url3){

				$('#opt1').html(`<button title="Notas" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableNoteCourse.php';" data-severity="danger" class="tips material-button option1" type="button" >
													 <span class="fa fa-check-circle fa-2x" aria-hidden="true"></span>
												 </button>`);

				$('#opt2').html(`<button title="Actividades del Curso" onclick="location.href = '/chaea/partials/viewStudent/s-activityStudentCourse.php';" data-severity="danger" class="tips material-button option2" type="button" >
														<span class="fa fa-pencil-square fa-2x" aria-hidden="true"></span>
												 </button>`);

				$('#opt3').html(`<button  title="Inscripción de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableCourseIns.php';"  data-severity="danger" class="tips material-button option3" type="button">
														<span class="fa fa-pencil" aria-hidden="true"></span>
												 </button>`);

				$('#opt4').html(`<button  title="Inicio" onclick="location.href = '/chaea/partials/viewStudent/studentIndex.php';"  data-severity="danger" class="tips material-button option4" type="button">
														<i class="fa fa-user" aria-hidden="true"></i>
												 </button>`);

		}else if(URLactual== url4){

				$('#opt1').html(`<button title="Notas" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableNoteCourse.php';" data-severity="danger" class="tips material-button option1" type="button" >
													 <span class="fa fa-check-circle fa-2x" aria-hidden="true"></span>
												 </button>`);

				$('#opt2').html(`<button  title="Inicio" onclick="location.href = '/chaea/partials/viewStudent/studentIndex.php';"  data-severity="danger" class="tips material-button option2" type="button">
														<i class="fa fa-user" aria-hidden="true"></i>
												 </button>`);

				$('#opt3').html(`<button  title="Inscripción de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableCourseIns.php';"  data-severity="danger" class="tips material-button option3" type="button">
														<span class="fa fa-pencil" aria-hidden="true"></span>
												 </button>`);

				 $('#opt4').html(`<button title="Cancelación de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentDeleteCourseIns.php';" data-severity="danger" class="tips material-button option4" type="button" >
	               					<span class="fa fa-bomb fa-2x" aria-hidden="true"></span>
	             					 </button>`);
		}else if(URLactual== url5){
			$('#opt1').html(`<button  title="Inicio" onclick="location.href = '/chaea/partials/viewStudent/studentIndex.php';"  data-severity="danger" class="tips material-button option1" type="button">
												 <i class="fa fa-user" aria-hidden="true"></i>
											</button>`);

			 $('#opt2').html(`<button title="Actividades del Curso" onclick="location.href = '/chaea/partials/viewStudent/s-activityStudentCourse.php';" data-severity="danger" class="tips material-button option2" type="button" >
														<span class="fa fa-pencil-square fa-2x" aria-hidden="true"></span>
												 </button>`);

				$('#opt3').html(`<button  title="Inscripción de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableCourseIns.php';"  data-severity="danger" class="tips material-button option3" type="button">
														<span class="fa fa-pencil" aria-hidden="true"></span>
												 </button>`);

				 $('#opt4').html(`<button title="Cancelación de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentDeleteCourseIns.php';" data-severity="danger" class="tips material-button option4" type="button" >
	               					<span class="fa fa-bomb fa-2x" aria-hidden="true"></span>
	             					 </button>`);
		}else if(URLactual== url6){
			$('#opt1').html(`<button title="Notas" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableNoteCourse.php';" data-severity="danger" class="tips material-button option1" type="button" >
												 <span class="fa fa-check-circle fa-2x" aria-hidden="true"></span>
											 </button>`);

			 $('#opt2').html(`<button title="Actividades del Curso" onclick="location.href = '/chaea/partials/viewStudent/s-activityStudentCourse.php';" data-severity="danger" class="tips material-button option2" type="button" >
														<span class="fa fa-pencil-square fa-2x" aria-hidden="true"></span>
												 </button>`);

				$('#opt3').html(`<button  title="Inscripción de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentTableCourseIns.php';"  data-severity="danger" class="tips material-button option3" type="button">
														<span class="fa fa-pencil" aria-hidden="true"></span>
												 </button>`);

				 $('#opt4').html(`<button title="Cancelación de cursos" onclick="location.href = '/chaea/partials/viewStudent/s-studentDeleteCourseIns.php';" data-severity="danger" class="tips material-button option4" type="button" >
	               					<span class="fa fa-bomb fa-2x" aria-hidden="true"></span>
	             					 </button>`);


		}




	}
