document.addEventListener('DOMContentLoaded',main)

function ajaxSetting(person,action) {
			let persons = person;
			var person = JSON.stringify(person);
			$.ajax({
				method:"POST",
				url: "/chaea/funcionesphp/teacherSQL/crudTableTeacher.php",
				data: {"action":action,"person":person}
			}).done( function( info ){
				loading();

				if(Number(info)==1){
					 mensajeSend("Se activó correctamente el usuario "+ persons[0]);
				}else if (Number(info)==2) {
					 mensajeSend("Se desactivó correctamente el usuario "+ persons[0]);
				} else {
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
function teacherUpdate(){

//esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
  var name = document.getElementById('name').value /*0*/
  var email = document.getElementById('email').value /*1*/
  var university = document.getElementById('university').value /*2*/
  var birthdate = document.getElementById('birthdate').value/*3*/
  var gender = document.getElementById('gender').value /*4*/
  var native_city = document.getElementById('native_city').value /*5*/
  var number_phone = document.getElementById('number_phone').value /*6*/
  var nickname = document.getElementById('nickname').value /*7*/
  var number_document = document.getElementById('number_document').value/*8*/
  var document_type = document.getElementById('document_type').value/*9*/
  var person = new Array(name, email, university, birthdate, gender, native_city, number_phone, nickname, number_document, document_type)
  var bas = 0

  for (var i in person){if((person[i]=="") ) {bas++;}}
  if((person[8]<1000000 || person[8]>10000000000)){bas++}//si cambia el tamaño del documento se cambia de aquí y del formulario
    if (bas==0){
          if(email.indexOf('.') != -1){
						    ajaxSetting(person, 2)
          } else {
            $('#warningemail').html("<div id='oculto1' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>No es un correo valido</strong></a></div>");
            return false;
          }

    }else{
			$('#warningform').html("<div id='oculto1' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>No completo bien los campos</strong></a></div>");
			return false;
		}
}
	//fin de definición de atributos
//funcion para consultar si esta modificando el email, document y nickname
function modifTeacher(){
	var email = document.getElementById('email').value /*0*/
	var nickname = document.getElementById('nickname').value /*1*/
	var number_document = document.getElementById('number_document').value/*2*/
	var person = new Array(number_document,email, nickname);
	ajaxSetting(person,5);//creo las variables de session.
}

function main(){

  var deleteElement = document.getElementById('deleteElement');
  deleteElement.addEventListener('click', function (){
		conter=0;
    var id_element = document.getElementById('id_element').value;
    ajaxSetting(id_element,1);
		document.getElementById('id01').style.display='none';
  });
	// var updateTeacher = document.getElementById('registratione');
	// updateTeacher.addEventListener('click', function(){
	// 		conter=0;
	// 	modifTeacher();
	// 	teacherUpdate();
	// 	document.getElementById('id02').style.display='none';
	//
	// });

	// var deleteElement = document.getElementById('p');
	// deleteElement.addEventListener('click',pol);
	// var stateTeacher = document.getElementsByClassName('switch')[0]

}
