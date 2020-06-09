	document.addEventListener('DOMContentLoaded',main)
	var bas=0;
	function ajaxSettingNote(note,action) {
				var notes = note;
				var note = JSON.stringify(note);


				$.ajax({
					method:"POST",
					url: "/chaea/backendPhp/studentSQL/t-trackingStudentCrud.php",
					data: {"action":action,"note":note}

				}).done( function( info ){
										 if(Number(info)==1){
											  mensajeSend("Se almaceno la nota correctamente");
												document.getElementById('id12').style.display='none';
												loadingin();
										 }else {
											 mensajeSend(info);
										 }

				});

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
		$("#acep").click(function(){
			 $("#id04").stop(true, true);
		 });
	}
	function mensajePanelA(info, option){
		switch (option) {
			case 1:
				$('#infoPanel1').html("<div id='infoPanelClose' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>&times;</button><strong>"+info+"</strong></a> </div>");
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
		$("#next3").click(function(){
		loading();//carga la lista de estudiantes del curso
		});
		$("#next2").click(function(){
		loadingiTematic();//carga la lista de las tematicas
		});

		$("#car2").click(function(){
		loadingin();// carga la tabla de archivos de actividades
		});

		$("#next3-1").click(function(){
			var student = JSON.parse(readCookie('student'));
			if(student[0]!=''){
			loadingin();// carga la tabla de archivos de actividades
			}
		});

		//creat actividad
	}
