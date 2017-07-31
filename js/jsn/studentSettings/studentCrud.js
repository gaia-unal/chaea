document.addEventListener('DOMContentLoaded',studentCrud)

var co=0;
function ajaxPersonStudent() {
			$.ajax({
				method:"POST",
				url: "../../backendPhp/studentSQL/crudStudent.php"
			}).done( function( info ){
				var student = eval(info);
				 studentForm(student);

			});

	}

	function ajaxStudentUbdate(person,action) {
					try {
							var person = JSON.stringify(person);
							$.ajax({
								method:"POST",
								url: "../../backendPhp/studentSQL/crudStudent.php",
								data: {"action":action,"person":person}
							}).done( function( info ){
										alert('Se actualizo Correctamente');
										// alert(info);
										return false;

							});
					} catch (e) {

					}


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
function studentForm(student){

//esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
	 document.getElementById('name').value = student[0].name /*0*/
   document.getElementById('email').value = student[0].email /*1*/
   document.getElementById('birthdate').value = student[0].birthdate/*2*/
   document.getElementById('gender').value = student[0].gender /*3*/
   document.getElementById('native_city').value = student[0].name_birthplace /*4*/
   document.getElementById('number_phone').value = student[0].number_phone /*5*/
   document.getElementById('nickname').value = student[0].nickname /*6*/
   document.getElementById('number_document').value = student[0].number_document/*7*/
   document.getElementById('document_type').value = student[0].id_type_document/*8*/
   document.getElementById('university').value = student[0].name_university/*9*/
   document.getElementById('academic_program').value = student[0].name_program/*10*/
   document.getElementById('semester').value = student[0].semester/*11*/

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
   var academic_program = document.getElementById('academic_program').value;/*10*/
   var semester = document.getElementById('semester').value;/*11*/

   var person = new Array(name, email, birthdate, gender, native_city, number_phone, nickname, number_document, document_type, university,academic_program, semester);
   var bas = 0;
   for (var i in person){if((person[i]=="") ) {bas++;}}
   if((person[7]<1000000 || person[7]>10000000000)){bas++}//si cambia el tamaño del documento se cambia de aquí y del formulario
     if (bas==0){
           if(email.indexOf('.') != -1){
 						    ajaxStudentUbdate(person, 1);
           } else {
             $('#warningemail').html("<div id='oculto1' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>No es un correo valido</strong></a></div>");
             return false;
           }

     }else{
 			$('#warningform').html("<div id='oculto1' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>No completo bien los campos</strong></a></div>");
 			return false;
 		}
 }

//editar los datos del administrador
function studentCrud(){

 //Carga datos del estudiante en la tabla
	$('#btn_profile').click(function(){
  	 ajaxPersonStudent();
  });


//Editar los datos del profesorz
	var update_admin = document.getElementById('registratione');
	update_admin.addEventListener('click', function (){
		adminUpdate();
	});

	$('#closeStudent').click(function(){
  	$('#cont_profile_user').toggle('slow');
  });



}
