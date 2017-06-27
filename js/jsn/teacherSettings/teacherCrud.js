document.addEventListener('DOMContentLoaded',adminCrud)

var co=0;
function ajaxPersonTeacher() {
			$.ajax({
				method:"POST",
				url: "/chaea/funcionesphp/teacherSQL/crudTeacher.php"
			}).done( function( info ){
				var techer = eval(info);
				 adminForm(techer);

			});

	}

	function ajaxTeacherUbdate(person,action) {
		try {
			var person = JSON.stringify(person);
			$.ajax({
				method:"POST",
				url: "/chaea/funcionesphp/teacherSQL/crudTeacher.php",
				data: {"action":action,"person":person}
			}).done( function( info ){
						// mensajeSend(info);
						alert(info);
					return false;
			});
		} catch (e) {

		}


		}


		// function mensajeSend(info){
		// 	$('#InfoUser').html(`<h4>`+info+`</h4>`);
		// 	var modalInfo = document.getElementById('id04');
		// 	modalInfo.style.display='block';
		// 	 $("#id04").fadeOut(9000);
		// 	 $("#acep").click(function(){
		// 			$("#id04").stop(true, true);
		// 		});
		// }
function adminForm(techer){

//esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
	var name = document.getElementById('name').value = techer[0].name /*0*/
  var email = document.getElementById('email').value = techer[0].email /*1*/
  var birthdate = document.getElementById('birthdate').value = techer[0].birthdate/*3*/
  var gender = document.getElementById('gender').value = techer[0].gender /*4*/
  var native_city = document.getElementById('native_city').value = techer[0].name_birthplace /*5*/
  var number_phone = document.getElementById('number_phone').value = techer[0].number_phone /*6*/
  var nickname = document.getElementById('nickname').value = techer[0].nickname /*7*/
  var number_document = document.getElementById('number_document').value = techer[0].number_document/*8*/
  var document_type = document.getElementById('document_type').value = techer[0].id_type_document/*9*/
  var university = document.getElementById('university').value = techer[0].name_university/*10*/

 }

 function adminUpdate(){

 //esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
   var name = document.getElementById('name').value; /*0*/
   var email = document.getElementById('email').value; /*1*/
   var birthdate = document.getElementById('birthdate').value;/*2*/
   var gender = document.getElementById('gender').value; /*3*/
   var native_city = document.getElementById('native_city').value; /*4*/
   var number_phone = document.getElementById('number_phone').value; /*5*/
   var nickname = document.getElementById('nickname').value; /*6*/
   var number_document = document.getElementById('number_document').value;/*7*/
   var document_type = document.getElementById('document_type').value;/*8*/
   var university = document.getElementById('university').value;/*9*/

   var person = new Array(name, email, birthdate, gender, native_city, number_phone, nickname, number_document, document_type, university);
   var bas = 0;
   for (var i in person){if((person[i]=="") ) {bas++;}}
   if((person[7]<1000000 || person[7]>10000000000)){bas++}//si cambia el tamaño del documento se cambia de aquí y del formulario
     if (bas==0){
           if(email.indexOf('.') != -1){
 						    ajaxTeacherUbdate(person, 1);
           } else {
             $('#warningemail').html("<div id='oculto1' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>No es un correo valido</strong></a></div>");
             return false;
           }

     }else{
 			$('#warningform').html("<div id='oculto1' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>No completo bien los campos</strong></a></div>");
 			return false;
 		}
 }


function adminCrud(){
	var 	btn_profile = document.getElementById('btn_profile');
		btn_profile.addEventListener('click', function (){
		 ajaxPersonTeacher();
	});


	var update_admin = document.getElementById('registratione');
	update_admin.addEventListener('click', function (){
		adminUpdate();
	});
  $('#closeTea').click(function(){
  	$('#cont_profile_user').toggle('slow');
  });




}
