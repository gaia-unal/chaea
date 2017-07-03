document.addEventListener('DOMContentLoaded',adminCrud)

var co=0;
function ajaxPersonAdmin() {
			$.ajax({
				method:"POST",
				url: "funcionesphp/recoursSQL/crudAdmin.php "
			}).done( function( info ){
				var admin = eval(info);
				 adminForm(admin);

			});

	}

	function ajaxSetting(person,action) {
				var person = JSON.stringify(person);
				$.ajax({
					method:"POST",
					url: "funcionesphp/recoursSQL/crudAdmin.php",
					data: {"action":action,"person":person}
				}).done( function( info ){
					co++;
					if(co<2){
						alert(info);
						ajaxPersonAdmin();
					}
				});

		}

function adminForm(admin){
//esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
	var name_admin = document.getElementById('name_admin').value = admin[0].name /*0*/
  var email_admin = document.getElementById('email_admin').value = admin[0].email /*1*/
  var birthdate_admin = document.getElementById('birthdate_admin').value = admin[0].birthdate/*3*/
  var gender_admin = document.getElementById('gender_admin').value = admin[0].gender /*4*/
  var native_city_admin = document.getElementById('native_city_admin').value = admin[0].name_birthplace /*5*/
  var number_phone_admin = document.getElementById('number_phone_admin').value = admin[0].number_phone /*6*/
  var nickname_admin = document.getElementById('nickname_admin').value = admin[0].nickname /*7*/
  var number_document_admin = document.getElementById('number_document_admin').value = admin[0].number_document/*8*/
  var document_type_admin = document.getElementById('document_type_admin').value = admin[0].id_type_document/*9*/

 }

 function adminUpdate(){

 //esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
   var name = document.getElementById('name_admin').value /*0*/
   var email = document.getElementById('email_admin').value /*1*/
   var birthdate = document.getElementById('birthdate_admin').value/*2*/
   var gender = document.getElementById('gender_admin').value /*3*/
   var native_city = document.getElementById('native_city_admin').value /*4*/
   var number_phone = document.getElementById('number_phone_admin').value /*5*/
   var nickname = document.getElementById('nickname_admin').value /*6*/
   var number_document = document.getElementById('number_document_admin').value/*7*/
   var document_type = document.getElementById('document_type_admin').value/*8*/
   var person = new Array(name, email, birthdate, gender, native_city, number_phone, nickname, number_document, document_type)
   var bas = 0;
   for (var i in person){if((person[i]=="") ) {bas++;}}
   if((person[7]<1000000 || person[7]>10000000000)){bas++}//si cambia el tamaño del documento se cambia de aquí y del formulario
     if (bas==0){
           if(email.indexOf('.') != -1){
 						    ajaxSetting(person, 1);
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
		 ajaxPersonAdmin();
	});


	var update_admin = document.getElementById('update_admin');
	update_admin.addEventListener('click', function (){
		adminUpdate();

	});

	var closedig = document.getElementById('closedig');
	closedig.addEventListener('click', function (){
		document.getElementById('cont_profile_user').style.display = "none";
	});



}
