  window.addEventListener('DOMContentLoaded',	main)


//funciones

  function main(){
    fecha();
    cer();
    document.getElementById('registratione').addEventListener('click',function(){
        register();
    });
  }

    //Este permire darle fucnionalidad al boton cerrar de los mensajes de alerta.
    function cer() {
        $('#oculto').hide(); //oculta un mensaje de texto mediante id con el boton de cerrar de las alertas de boostrap
        $('#oculto1').hide();
      }

    //Indica de que año a que año se puede registrar un usuario.
    function fecha(){
      var f= new Date();
      fma = f.getFullYear()-10;
      fmi = f.getFullYear()-100;
      try {
        document.getElementById('birthdate').max= fma+'-12-31';
        document.getElementById('birthdate').min= fmi+'-12-31';
      } catch (e) {}


    }


    // esta funcion es el ajax que me permite tener mas control al momento de enviar los datos al la BD este es compatible con cualquier navegador
    function ajaxpost(person, action) {
      var attributes = JSON.stringify(person);
       $.ajax({
        type: 'POST',
        url: 'backendPhp/send.php',
        data:('&attributes=' + attributes + '&action=' + action + ''),
            success: function(answer){

              if(Number(answer)==1){
                 roote(person)
              } else {

                        bootbox.dialog({
                          message: answer,
                          closeButton: false,
                          buttons: {
                              "success": {
                                 label: "Confirmar",
                                 className: "btn-success",
                                 callback: function () {}
                              }
                          }
                      });
                return false;
              }


            },

        });
    }


    //esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
    function register() {
      var name = document.getElementById('name').value /*0*/
      var email = document.getElementById('email').value /*1*/
      var university = document.getElementById('university').value /*2*/
      var password = document.getElementById('password').value /*3*/
      var password2 = document.getElementById('password2').value
      var birthdate = document.getElementById('birthdate').value/*4*/
      var gender = document.getElementById('gender').value /*5*/
      var native_city = document.getElementById('native_city').value /*6*/
      var id_role = document.getElementById('id_role').value/*10*/
      if(id_role==2){
        var academic_program = document.getElementById('academic_program').value /*7*/
        var semester = document.getElementById('semester').value /*8*/
      }
      var number_phone = document.getElementById('number_phone').value /*9*/

      var nickname = document.getElementById('nickname').value /*11*/
      var id_user = document.getElementById('id_user').value/*12*/
      var document_type = document.getElementById('document_type').value/*13*/
      var person = new Array(name, email, university, password, birthdate, gender, native_city, academic_program, semester, number_phone, id_role, nickname,id_user, document_type)
      var bas = 0

      for (var i in person){if((person[i]=="") ) {bas++;}}
      if((person[12]<1000000 || person[12]>10000000000)){bas++}//si cambia el tamaño del documento se cambia de aquí y del formulario
      if(person[10]== 2 && person[8] == 0 ){bas++}

        if (bas==0){
              if(email.indexOf('.') != -1){
                  if(person[3] == password2 && person[3] != '' && password2 != ''){
                    ajaxpost (person, 2)
                  } else {
                    $('#warningpassword').html("<div id='oculto' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>Las contraseñas no coinciden</strong></a> </div>");
                       return false;
                  }
              } else {
                $('#warningemail').html("<div id='oculto1' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>No es un correo valido</strong></a> </div>");
                return false;
              }

        }
    }
    //fin de definición de atributos

    function roote (person) {
      let today = new Date(), birthday = new Date(person[4]);
      if (person[10]== 1) {
            location.href = 'congratulation.php';
      }
      if(person[10] == 2) {
        let student = { document: person[12],  name: person[0] };
        student = JSON.stringify(student);
        createCookie('student', student, 1);
        let birthdate = today.getFullYear() - birthday.getFullYear();
        if(birthdate > 15){
          location.href = 'questionChaea.php';
        }
        else{
          location.href = 'questionChaeaJunior.php';
        }
        return false;
      }

    }

    //Esta función me permite ocultar o mostrar datos del formulario ya que para el profesor es uno y para el estudiante otro...
    function formstudent() {
      try {var id_role = document.getElementById('id_role').value}catch(err) {}


        if (id_role == 1) {
          $('#studentForm').html("");
          $('#semesterForm').html("");
        } else if (id_role == 2) {
          $('#studentForm').html(`<div class="form-group">
                 <label for="academic_program" class="col-lg-2 control-label">Programa Academico:</label>
                   <div class="col-lg-10 has-success">
                   <input  list="program"  value="" class="form-control"  pattern=".{0}|.{10,80}" name="program" title="tiene que tener por lo menos 10 caracteres" value="" maxlength="300" id="academic_program" placeholder="Ej: Geología "></input><br>
                  </div>
            </div>`);
            $('#semesterForm').html(`<div class="form-group">
               <label for="semester" class="col-lg-2 control-label">Semestre:</label>
                 <div class="col-lg-10 has-success">
                  <input type="number" class="form-control"  value="" min="1" max="15"  required="" id="semester" name="semester" placeholder="Ej: 4"></input><br>
                </div>
             </div>`);
        }


    }
    // fin de ocultamiento de campos en fomulario

    //Controles para los campos del formulario, mediante codigo ascii.
    //control3 es para correo electronico
    function control3(a) {
      tecla = (document.all) ? a.keyCode : a.which;
      if (tecla == 32 || tecla == 38 || tecla == 43 || tecla == 44 || tecla == 60 || tecla == 61 || tecla == 62) {
        alert('La dirección de correo electrónico no es válida no puede contener: "espacios" - "coma" - "<>" - "&" - "+" - "="');
        return false;
      }

    }

    //control2 para numero de identificación y numero telefonico
    function control2(a) {
      var band = 0;
      tecla = (document.all) ? a.keyCode : a.which;

      if (tecla == 69 || tecla == 101) {
        alert("Porfavor solo numeros");
        return false;
      }

      for (var i = 32; i <= 47; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }

      for (var i = 58; i <= 64; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }
      if (band == 1) {
        // $('#control2').html("<div id='oculto' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>Porfavor solo numeros</strong></a> </div>");
        alert("Porfavor solo numeros");
        return false;
      }

    }

    //controla el campo de la universidad y nombre de la persona para que solo sean letras sin numeros
    function control1(a) {
      var band = 0;
      tecla = (document.all) ? a.keyCode : a.which;
      for (var i = 33; i <= 64; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }

      for (var i = 123; i <= 126; i++) {
        if (tecla == i) {
          band = 1;
        }
      }

      for (var i = 91; i <= 95; i++) {
        if (tecla == i) {
          band = 1;
        }
      }
      if (band == 1) {
        // $('#control1').html("<div id='oculto' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>Porfavor solo letras</strong></a> </div>");
        alert("Porfavor solo letras");
        return false;
      }

    }

    //control3 para nickname solo permite numeros y letras
    function control4(a) {
      var band = 0;
      tecla = (document.all) ? a.keyCode : a.which;
      for (var i = 32; i <= 47; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }

      for (var i = 58; i <= 64; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }
      for (var i = 91; i <= 95; i++) {
        if (tecla == i) {
          band = 1;
        }
      }
      for (var i = 123; i <= 126; i++) {
        if (tecla == i) {
          band = 1;
        }
      }
      if (band == 1) {
        alert("Porfavor solo numeros o lestras ");
        return false;
      }
    }

    // crear cookie para ser leida unicamente en javascript
    function createCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

//funciones
