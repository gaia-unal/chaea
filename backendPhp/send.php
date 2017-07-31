<?php
  // Se crea la conexion con la BD
   require_once("conexion.php");
   require_once("recoverInfo.php");
   $objDatos = new DB();
   $objDatos->connect();
   $action= array_key_exists("action", $_POST) ? $_POST["action"] : null;
   $attributes = json_decode(array_key_exists("attributes", $_POST) ? $_POST["attributes"] : null);
   $replys = json_decode(array_key_exists("replys", $_POST) ? $_POST["replys"] : null);
   $student_style_point =json_decode(array_key_exists("student_style_point", $_POST) ? $_POST["student_style_point"] : null);
   $coursesIs = json_decode(array_key_exists("coursesIs", $_POST) ? $_POST["coursesIs"] : null);
   $confirm=0;

    //llamdo de funcion para validar el usuario
    if($action==1){
       if ([0] == null || $attributes[1]  == null ) {
            return null;
        }else{
          echo  validation($attributes[0], $attributes[1]);
        }
    }
    //Fin


    //llamdo de funcion para insertar el usuario
    if($action==2){
        // var_dump($attributes);
        $confirdocument = existDocument($attributes[12]);
        if($confirdocument == 1){
            $confirmemail = existemail($attributes[1]);

            if($confirmemail==1){

              $confirm = exist($attributes[11]);

                if($confirm == 1){
                  if ($attributes[10]==1) {
                    echo  register($attributes);
                  } else {
                    setcookie('attributes', base64_encode(serialize($attributes)),time()+(60*60),"questionChaea.php"); // la coloque para que dure una hora en caso de que se cierre el aplicativo y no haya terminado de registrarse el test.
                    echo 1;//retorno 1 para redireccionar en la pagina asychronous.js
                  }

               }else{
                 echo "El nombre de usuario '$attributes[11]' ya está siendo utilizado.";
               }
             } else {
               echo "Ya existe una cuenta de usuario con el correo : ".$attributes[1];
             }
           }else{echo "Ya existe una cuenta de usuario que registra con el documento : ".$attributes[12];}
    }
    //Fin
    //llamdo de funcion para insertar las respuestas
    if($action==3){
        //con esta pregunta miro si el usuario biene de la parte de un registro
        if(isset($_COOKIE["attributes"])){
          $attributes = unserialize(base64_decode($_COOKIE["attributes"]));
            register($attributes);//imprime 1
            registerReply($replys, $attributes[12],$student_style_point);//imprime 2
          echo  registerCourses($coursesIs, $attributes[12]);
          setcookie('attributes', base64_encode(serialize($attributes)),time()-(60*60),"questionChaea.php");// se cierra el cookie cuando se registra todo.
        } else {
          echo "La cookie no existe";
        }
    }
    //Fin
    if($action==4){
        //con esta pregunta miro si el usuario biene de la parte de un registro
        if(isset($_COOKIE["attributes"])){
          $attributes = unserialize(base64_decode($_COOKIE["attributes"]));
            register($attributes);//imprime 1
            registerReplyJunior($replys, $attributes[12],$student_style_point);//imprime 2
          echo  registerCourses($coursesIs, $attributes[12]);
          setcookie('attributes', base64_encode(serialize($attributes)),time()-(60*60),"questionChaea.php");// se cierra el cookie cuando se registra todo.
        } else {
          echo "La cookie no existe";
        }
    }
    //Fin
?>


<?php

    //Funcion que permite almacenar los cursos a los que se inscribio al usuario.
    function registerCourses($coursesIs, $document){
      try {
        global $objDatos;

        for ($i=0; $i <sizeof($coursesIs) ; $i++) {
          $sql ="INSERT INTO course_student (id_course, number_document, state_course_student)
          values ('". $coursesIs[$i]->id_course."','".$document."','Inactivo')";
          $objDatos->executeQuery($sql);
        }
        return 2;

      } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
      }
    }

  //Funcion que permite almacenar las respues que del test Chaea
  function registerReply($replys, $document, $student_style_point){
    try {
      global $objDatos;
      $date=date("Y-m-d");
      for ($i=0; $i <sizeof($replys) ; $i++) {
        $sql ="INSERT INTO chaea_answer (type_answer, execute_date_test, id_question, number_student_inanswer)
        values ('$replys[$i]','$date',($i+1),'$document')";
        $objDatos->executeQuery($sql);
      }

      $sql ="INSERT INTO student_style_point (activo, reflexivo, teorico, pragmatico, number_student)
      values ('$student_style_point[0]','$student_style_point[1]','$student_style_point[2]','$student_style_point[3]','$document')";
      $objDatos->executeQuery($sql);


    } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
    }
  }
  //Funcion que permite almacenar las respues que del test ChaeaJunior
  function registerReplyJunior($replys, $document, $student_style_point){
    try {
      global $objDatos;
      $date=date("Y-m-d");
      for ($i=0; $i <sizeof($replys) ; $i++) {
        $sql ="INSERT INTO chaea_answer_junior (type_answer, execute_date_test, id_question_junior, number_student_inanswer)
        values ('$replys[$i]','$date',($i+1),'$document')";
        $objDatos->executeQuery($sql);
      }

      $sql ="INSERT INTO student_style_point (activo, reflexivo, teorico, pragmatico, number_student)
      values ('$student_style_point[0]','$student_style_point[1]','$student_style_point[2]','$student_style_point[3]','$document')";
      $objDatos->executeQuery($sql);


    } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
    }
  }

  // FUNCIONES DE LOGING
  //_____________________________________________________________________________

  //Esta función mira si existe el usuario.
  function validation ($nickname, $password){
    try {

        global $objDatos;

        $sql = "SELECT count(number_document) as t1
        FROM student WHERE nickname = '$nickname'";
        $crud1 = $objDatos->executeQuery($sql);

        $sql = "SELECT count(number_document) as t2
        FROM teacher WHERE nickname = '$nickname'";
        $crud2 = $objDatos->executeQuery($sql);

        $sql = "SELECT count(number_document) as t3
        FROM administrator WHERE nickname = '$nickname'";
        $crud3 = $objDatos->executeQuery($sql);

        if($crud1[0]['t1'] >= 1){
          return password ('student',$nickname, $password);
        }elseif($crud2[0]['t2'] >= 1){
          return password ('teacher',$nickname, $password);
        }elseif ($crud3[0]['t3'] >= 1) {
          return password ('administrator',$nickname, $password);
        }else{
          return 1;//no existe el usuario
        }
    } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
    }

  }

  //Esta función mira si la contraseña coincide.
  function password ($rolTable,$nickname, $password){
        global $objDatos;
        try {

                      $sql = "SELECT count(number_document) as t1
                               FROM ".$rolTable." WHERE password = MD5('$password')
                               AND  nickname = '$nickname'";
                      $crud = $objDatos->executeQuery($sql);

                     if($crud [0]['t1']>=1){
                         session_start();
                         $_SESSION['password'] = MD5($password);
                      return stateSystem ($rolTable,$nickname);
                     }else{
                       return 2;//contraseña no es correcta
                     }

        } catch (Exception $e) {
          echo 'Existe un fallo en la conexión';
        }

}

  //Esta función mira si se ecuentra activo en el sistema
  function stateSystem ($rolTable,$nickname){

    try {
            global $objDatos;
            $sql = "SELECT number_document as t1, name as na
            FROM ".$rolTable." WHERE state_system = 'Activo'
            AND  nickname = '$nickname'";
            $crud = $objDatos->executeQuery($sql);

            if($crud [0]['t1']>=1){
              $_SESSION['name'] = $crud[0]['na'];
              $_SESSION['nickname'] = $nickname;
              $_SESSION['document'] = $crud[0]['t1'];
              $_SESSION['rol'] = $rolTable;
              if("student"==$_SESSION['rol']) {
                studentStyle();
              }

                if("administrator"==$_SESSION['rol'] ){
                  return 4;//todo esta OK para admin
                }else{
                  $_SESSION['name_institution']= nameInstitution($_SESSION['rol']);
                  $objDatos->closeConnect();
                }

                if ("teacher"==$_SESSION['rol']) {
                  return 5;//todo esta OK para teacher
                }
                if("student"==$_SESSION['rol']) {

                  return 6;//todo esta OK para student
                }

            }else{
              return 3;//aun no se ha activado el usuario
            }

    } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
    }
  }


  // fin de validacion
  //=============================================================================


  //FUNCIONES DE REGISTRO estan en recoverInfos
  //_____________________________________________________________________________

  //funcion que permite almacenar los profesores y los estudiantes en el formulario
  //el estudiante.
  function register($attributes){
      try {
          global $objDatos;

          $idUniversity = existUniversity($attributes[2]);
          if($idUniversity==0){
            $idUniversity = existUniversity($attributes[2]);
          }
          if($attributes[7]!=""){
            $idProgram = existProgram($attributes[7]);
            if($idProgram==0){
              $idProgram = existProgram($attributes[7]);
            }
          }

          $idBirthplace = existPlace($attributes[6]);
          if($idBirthplace==0){
            $idBirthplace = existPlace($attributes[6]);
          }

          if ($attributes[10]==1) {
            //Profesor
            $sql ="INSERT INTO teacher (number_document, name, email, password, birthdate, number_phone,
              nickname, state_system,id_birthplace, id_university, id_type_document, gender)
              values ('$attributes[12]','$attributes[0]','$attributes[1]',MD5('$attributes[3]'),'$attributes[4]','$attributes[9]',
              '$attributes[11]','Inactivo','$idBirthplace', '$idUniversity', '$attributes[13]','$attributes[5]')";
              $objDatos->executeQuery($sql);
              if(session_id() == ""){
                session_start();
                $_SESSION["regis"]=1;//para que no entre a congratulation creo esta variable de session
              }
              echo "1";
            }else{
              //Estudiante
              $sql ="INSERT INTO student (number_document, name, email, password, birthdate, number_phone,
                nickname, state_system, id_birthplace, id_university, id_type_document, semester, id_program, gender)
                values ('$attributes[12]','$attributes[0]','$attributes[1]',MD5('$attributes[3]'),'$attributes[4]','$attributes[9]',
                '$attributes[11]','Inactivo','$idBirthplace', '$idUniversity','$attributes[13]','$attributes[8]','$idProgram', '$attributes[5]')";
                $objDatos->executeQuery($sql);
              }

      } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
      }

  }
  //Fin Registro
  //=============================================================================



  // Sacar las universidades existentes para que el usuario pueda tener una lista
  // de recomendación y autocompletar el campo
  function university(){
      try {
        global $objDatos;
        $sql = "SELECT  distinct name_university as un FROM university";
        $crud = $objDatos->executeQuery($sql);
        return $crud;

      } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
      }
  }
  //fin de universidades

  // Sacar las porgramas academicos existentes para que el usuario pueda tener una
  //lista de recomendación y autocompletar el campo
  function program(){
      try {
        global $objDatos;
        $sql = "SELECT  distinct name_program as pr FROM academic_program";
        $crud = $objDatos->executeQuery($sql);
        return $crud;

      } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
      }
  }



  // Sacar las preguntas que se encuentran en la tabla
  function questionC(){
    try {
      global $objDatos;
      $sql = "SELECT description as qu,  id_question as idc FROM question_chaea";
      $crud = $objDatos->executeQuery($sql);
      return $crud;

    } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
    }
  }

  //fin de pregustas
  // Sacar las preguntas que se encuentran en la tabla
  function questionCJ(){
    try {
      global $objDatos;
      $sql = "SELECT description as qu,  id_question_junior as idc FROM question_chaea_junior";
      $crud = $objDatos->executeQuery($sql);
      return $crud;

    } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
    }
  }
  //fin de pregustas


 ?>
