document.addEventListener('DOMContentLoaded',main)
var ban1=0, ban2=0, ban3=0, ban4=0, conter=0;
try{
var person = readCookie('student');person = JSON.parse(person);namep = person.name.toLowerCase().trim();
}catch(e){}
  // esta funcion es el ajax que me permite tener mas control al momento de enviar
  //los datos al la BD este es compatible con cualquier navegador
  function ajaxas(student_style_point,reply, action) {

    var replys = JSON.stringify(reply);
    var student_style_point = JSON.stringify(student_style_point);

     $.ajax({
      type: 'POST',
      url: 'backendPhp/send.php',
      data:{"replys": replys, "action":action, "student_style_point":student_style_point},
          success: function(answer){
            //en caso de existir una falla al registrar estudiante descomentar
            //la linea de abajo y hacer el registro de nuvo para ver que error ocurre
             alert(answer);
            if(Number(answer)==2){
              alert('Se registro correctamente')
            }
            return false;// se esta registrando.

          },

      });
    }

  //Funciones de Control de confirmar politicas.
    function Name(){
       selectSI = document.getElementById('confirmation').value;
      if(selectSI=='Si'){
          document.getElementById('next0').disabled=false;
          $('#oculto').hide();
      }else{
          $('#oculto').show()

      }

    }
//Se validan que los campos si coincidan con los ingresados en el registro
    function confirmNameId(){
      var b1=0,b2=0;
      id_stud = document.getElementById('id_user').value;
      name_s =  document.getElementById('name_s').value;
      document.getElementById('id_user').addEventListener('focus', function(){
        var name_s =  document.getElementById('name_s').value;
            name_s = name_s.toLowerCase().trim();
              if (name_s != namep  && b1==0){
                var  mensaje = document.createElement('div');
                     mensaje.innerHTML='<button type="button" class="close" id="closeAlert1" data-dismiss="alert">&times;</button><strong>Ops!</strong> El nombre no coincide con el usuario.';
                     mensaje.classList.add('alert');
                     mensaje.classList.add('alert-dismissible');
                     mensaje.classList.add('alert-danger');
                     mensaje.setAttribute('id','close1');
                     document.getElementById('name_st').appendChild(mensaje);
                     document.getElementById('next0').disabled=true;
                     b1=1;
              }else if(name_s != namep && b1==1){
                  document.getElementById('next0').disabled=true;
                 $('#close1').show();
              }
              if(name_s == namep){
                document.getElementById('next0').disabled=false;
                  $('#close1').hide();
              }

      });

      document.getElementById('confirmation').addEventListener('focus', function(){
            id_stud = document.getElementById('id_user').value;
            name_s =  document.getElementById('name_s').value;
            name_s = name_s.toLowerCase().trim();

        if(id_stud != person.document && b2==0){
          var  mens = document.createElement('div');
          mens.innerHTML='<button type="button" class="close"  id="closeAlert2" data-dismiss="alert">&times;</button><strong>Ops!</strong> El documento no coincide con el del registro.';
          mens.classList.add('alert');
          mens.classList.add('alert-dismissible');
          mens.classList.add('alert-danger');
          mens.setAttribute('id','close2');
          document.getElementById('id_sx').appendChild(mens);
          document.getElementById('next0').disabled=true;
          b2=1;
        }else if(id_stud != person.document && b2==1){
            document.getElementById('next0').disabled=true;
           $('#close2').show();
        }

        if (name_s != namep  && b1==0) {
          var  mensaje = document.createElement('div');
               mensaje.innerHTML='<button type="button" class="close" id="closeAlert1" data-dismiss="alert">&times;</button><strong>Ops!</strong> El nombre no coincide con el usuario.';
               mensaje.classList.add('alert');
               mensaje.classList.add('alert-dismissible');
               mensaje.classList.add('alert-danger');
               mensaje.setAttribute('id','close1');
               document.getElementById('name_st').appendChild(mensaje);
               document.getElementById('next0').disabled=true;
               b1=1;
        } else if(name_s != namep && b1==1){
             document.getElementById('next0').disabled=true;
             $('#close1').show();
        }
        if(name_s == namep){
            document.getElementById('next0').disabled=false;
            $('#close1').hide();

        }

        if (id_stud == person.document) {
            document.getElementById('next0').disabled=false;
            $('#close2').hide();
        }

      });

      document.getElementById('next0').addEventListener('mouseenter', function(){
        selectSI = document.getElementById('confirmation').value;
        id_stud = document.getElementById('id_user').value;
        name_s =  document.getElementById('name_s').value;
        name_s = name_s.toLowerCase().trim();
        if(id_stud != person.document && b2==0){
          var  mens = document.createElement('div');
          mens.innerHTML='<button type="button" class="close"  id="closeAlert2" data-dismiss="alert">&times;</button><strong>Ops!</strong> El documento no coincide con el del registro.';
          mens.classList.add('alert');
          mens.classList.add('alert-dismissible');
          mens.classList.add('alert-danger');
          mens.setAttribute('id','close2');
          document.getElementById('id_sx').appendChild(mens);
          document.getElementById('next0').disabled=false;
          b2=1;
        }else if(id_stud != person.document && b2==1){
            document.getElementById('next0').disabled=false;
           $('#close2').show();
        }

        if (name_s != namep  && b1==0) {
          var  mensaje = document.createElement('div');
               mensaje.innerHTML='<button type="button" class="close" id="closeAlert1" data-dismiss="alert">&times;</button><strong>Ops!</strong> El nombre no coincide con el usuario.';
               mensaje.classList.add('alert');
               mensaje.classList.add('alert-dismissible');
               mensaje.classList.add('alert-danger');
               mensaje.setAttribute('id','close1');
               document.getElementById('name_st').appendChild(mensaje);
               document.getElementById('next0').disabled=false;
               b1=1;
        } else if(name_s != namep && b1==1){
              document.getElementById('next0').disabled=true;
             $('#close1').show();
        }

        if(name_s == namep){

            $('#close1').hide();
        }
        if (id_stud == person.document) {
            $('#close2').hide();
        }
        if(name_s == namep && id_stud == person.document && selectSI=='Si'){
          document.getElementById('next0').disabled=false;
          $('#oculto').hide();
        }else{
          $('#oculto').show();
          document.getElementById('next0').disabled=true;
        }

      });

      try{
        document.getElementById('name_st').addEventListener('click',cer1)
        document.getElementById('id_user').addEventListener('click',cer2)
        document.getElementById('closeAlert1').addEventListener('click',cer1)
        document.getElementById('closeAlert2').addEventListener('click',cer2)

      }catch(e){}

      function cer1() {
          $('#close1').hide();
      }
      function cer2() {
        $('#close2').hide();
      }

    }
  //fin de funciones

  //Si no se registro antes muestra un mensaje
  function load(){
    if(person.name==null){
          $('#loader').html('<div class="alert alert-dismissible alert-danger">'+
          ' <button type="button" onclick="cer();" class="close" data-dismiss="alert">&times;</button>'+
          ' <strong>Tiene que </strong><a href="registration.php" class="alert-link"> registrarse</a> primero!!.</div>');
                  return true;
        }

  }
  // Se muestra que se confirmo Correctamente
  function registationThen(){
    $('#loader').html(
      '<div class="row setup-content" id="step-7">'+
                  '<div class="col-xs-12">'+
                          '<div class="col-md-12">'+
                                  '<h3>Fin</h3>'+
                                  '<div id="ans">'+
                                      '<h1 id="finichh1">Se Registró Correctamente <i class="fa fa-thumbs-up" aria-hidden="true"></i></h1>'+
                                      '<p id="finichP">Pronto recibirá un correo confirmando su activación.</p>'+
                                  '</div>'+
                          '</div>'+
                  '</div>'+
          '</div>');
  }

  //Esto lo que hace es que los radianButto tengan un efecto.
  function lod(){
    try{
        function tam(){this.style.width = "25px";this.style.height = "25px";}
        function min(){this.style.width = "";this.style.height = "";}
           for (var i = 0; i <88 ; i++) {//son 44 preguntas
             document.getElementsByClassName('radij')[i].addEventListener('mouseenter', tam)
             document.getElementsByClassName('radij')[i].addEventListener('mouseleave', min)
           }
      }catch (e) {console.log('e1')}

  }

  //Esta funcion cuenta cuantas respuestas de estilo de aprendizaje
  //respondio el usuario y las almasena en BD
  function resultTable(){
      activo = [3, 6, 9, 17, 26, 27, 29, 30, 39, 41];//20
      reflexivo = [5, 7, 11, 13, 20, 22, 24, 28, 38, 42, 44];//20
      teorico = [2, 4, 8, 12, 14, 23, 31, 32, 35, 37, 43];//20
      pragmatico = [1, 10, 15, 18, 19, 21, 25, 33, 34, 36, 40];//20

      var answers =[]; var res ='q';
      var a=0; var r=0; var t=0; var p=0;
      try {
            for (var i = 0; i < 44; i++) {
              res = 'q'+i
              answers[i]= document.forms['questionChaea'][res].value
              if(activo.indexOf(i)!=-1){
                if(answers[i].indexOf('+')!=-1){
                  a+=1
                }
              }else if (reflexivo.indexOf(i)!=-1){
                if(answers[i].indexOf('+')!=-1){
                  r+=1
                }
              }else if (teorico.indexOf(i)!=-1){
                if(answers[i].indexOf('+')!=-1){
                  t+=1
                }
              }else if (pragmatico.indexOf(i)!=-1){
                if(answers[i].indexOf('+')!=-1){
                  p+=1
                }
              }
            }

        document.getElementById('result1').innerHTML =  '<h1 number="_blank" id="result1">'+a+'</h1>';
        document.getElementById('result2').innerHTML =  '<h1 number="_blank" id="result2">'+t+'</h1>';
        document.getElementById('result3').innerHTML =  '<h1 number="_blank" id="result3">'+r+'</h1>';
        document.getElementById('result4').innerHTML =  '<h1 number="_blank" id="result4">'+p+'</h1>';

        //esto se ejecuta siempre y cuando la cookie exista en php...
        var student_style_point = new Array(a, t, r, p);
          if(person.document>0){
            ajaxas(student_style_point, answers,4);
          }
      } catch (e) {
        alert("Erro en >> "+e)
      }

  }

  // Esta funcion controla que si ingrese los campos por tabla cuando preciona
  // el boton next1, next2, next3, next4
  function controlQuestion(x,n,nx){
          var answers =[]; var res ='q', vw=0;

          for (var i = x ; i < n; i++) {
            res = 'q'+i;

            answers[i]= document.forms['questionChaea'][res].value;

            var  mensaje = document.createElement('div');
                 mensaje.innerHTML='<button type="button" class="close" id ="myFail'+i+'"'+
                  'data-dismiss="alert">&times;</button><strong>Ops!</strong>'+
                  ' Falto responder esta pregunta.';
                 mensaje.classList.add('alert');
                 mensaje.classList.add('alert-dismissible');
                 mensaje.classList.add('alert-danger');
                 mensaje.setAttribute('id','fail'+i);

              if(answers[i].indexOf('+')!=-1){
                try {
                      document.getElementById('fail'+i).remove();
                      if(nx==4&&conter>0){conter--;}
                } catch (e) {

                }


              }else if (answers[i].indexOf('-')!=-1){
                try {
                  document.getElementById('fail'+i).remove();
                  if(nx==4&&conter>0){conter--;}

                } catch (e) {

                }
              }else{
                    if(ban1==0 && nx==1){
                      document.getElementById('pregunta'+(i)).appendChild(mensaje);
                    }else if (ban2==0 && nx==2){
                      document.getElementById('pregunta'+(i)).appendChild(mensaje);
                    }else if (ban3==0 && nx==3){
                      document.getElementById('pregunta'+(i)).appendChild(mensaje);
                    }else if (ban4==0 && nx==4){
                      conter++;
                      document.getElementById('pregunta'+(i)).appendChild(mensaje);
                    }
                    if(vw==0){
                       document.getElementById('myFail'+i).focus();
                       vw=1;
                    }
              }

          }/*fin for*/
          if(nx==1){
            ban1=1;
          }else if (nx==2) {
            ban2=1;
          }else if (nx==3) {
            ban3=1;
          }else if (nx==4) {
            ban4=1;
          }

          return conter;

  }

  //read cookie
  function readCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
  }

  function eliminarCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function main(){
    var loading = load();
            lod();
              if(loading != true){
                        confirmNameId();
                        var parrafos = document.getElementsByName('step-2');
                                parrafos.disabled=true;
                        var selecConfirm = document.getElementById('confirmation');
                        selecConfirm.addEventListener('click', function (){
                              Name();
                        });
                  var nextButton0 = document.getElementById('next0');
                  nextButton0.addEventListener('click', function (){
                    $('.cerr').attr('disabled','disabled');
                  });
                  var nextButton3 = document.getElementById('next3');
                  nextButton3.addEventListener('click', function (){
                    eliminarCookie('student',' ',0);
                    registationThen();
                  });

                }
          try {


            var nextButton1 = document.getElementById('next1');
            nextButton1.addEventListener('click', function (){controlQuestion(0,20,1);});
            var nextButton2 = document.getElementById('next2');
            nextButton2.addEventListener('click', function (){
              conter = controlQuestion(20,40,2);
              if(conter==0){
                resultTable();//tabla de resultados
              }
            });
          } catch (e) {
            console.log('e2');
          }

  }
