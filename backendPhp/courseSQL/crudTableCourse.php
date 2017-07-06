<?php session_start();

if(!$_SESSION){
  header ("Location: /chaea/logingIndex.php");
}else if (("teacher"!=$_SESSION["rol"])) {
    header ("Location: /chaea/logingIndex.php");
}
 ?>
<?php
require_once("../conexion.php");
require_once("../recoverInfo.php");
$objDatos = new DB();
$objDatos->connect();
$action= array_key_exists("action", $_POST) ? $_POST["action"] : null;
$course = json_decode(array_key_exists("course", $_POST) ? $_POST["course"] : null);
$informartion=[];

switch ($action) {
  case 1:
    createNewCourse($course);
    break;
  case 2:
    $tracing =validationRol('teacher');
    controlInsUpdaAdmin($tracing,$course);
    break;
  case 3:
    activationCourse($course);
    echo "Se activó correctamente";
    break;
  case 4:
    desactivationCourse($course);
    echo "Se desactivó correctamente";
    break;
  case 5:
      if(session_id() == ""){
        session_start();
      }

    $_SESSION["document_up"]= $course[0];
    $_SESSION["email_up"]= $course[1];
    $_SESSION["nickname_up"]= $course[2];
    $_SESSION["password_up"]= passwordRecover("teacher",$course[0]);
    break;
  case 6:
    deleteCourse($course);
  break;
  case 7:
    editCourse($course);// quedo aqui!! Crear funcion no se ha hecho
  break;
}

?>

 <?php
//Funciones de configuración del estado del curso
 function activationCourse($id_course){
   global $objDatos;
   $sql = "UPDATE course SET state_system_course ='Activo'
           WHERE id_course ='".$id_course."';";
           $objDatos->executeQuery($sql);
          //  enviarEmail($number_document);
           $objDatos->closeConnect();


 }

 function desactivationCourse($id_course){
   global $objDatos;
   $sql = "UPDATE course SET state_system_course ='Inactivo'
           WHERE id_course ='".$id_course."';";
           $objDatos->executeQuery($sql);

    $sql = "UPDATE course_student SET state_course_student ='Inactivo'
            WHERE id_course = '".$id_course."';";
            $objDatos->executeQuery($sql);

           $objDatos->closeConnect();

 }

 //Fin de configuraciones

 //Función para crear un curso

 function createNewCourse($course){
   global $objDatos;

      $id_course = existCourse($course[0]);

      if($id_course==0){
        try {
          $sql= "INSERT INTO course (name_course, state_system_course, description_course, quotas_course) values ('$course[0]','Inactivo','$course[1]','$course[2]');";
          $objDatos->executeQuery($sql);
          $id_course = existCourse($course[0]);
          //Se inserta en el profesor el nuevo curso que creo.
          $sql = "INSERT INTO course_teacher (id_course, number_document) values ('".$id_course."','".$_SESSION["document"]."');";
          $objDatos->executeQuery($sql);
          $objDatos->closeConnect();
          echo "1";
        } catch (Exception $e) {
          echo "No se pudo insertar el curso, por favor comuníquese con el administrador";
        }


      }else{
              echo "2";//el curso ya existe no se puede crear
           }

 }
 //fin de funcion crear

 //función de eliminar un curso
 function deleteCourse($id_course){
   global $objDatos;
   $consulta = "DELETE FROM course WHERE id_course = '$id_course'";
   $teacher = $objDatos->executeQuery($consulta);
   $objDatos->closeConnect();
   echo "Se ha eliminado el curso correctamente";
  }
//fin de función eliminar

//funcion editar un curso
  function editCourse($course){
    $id_course = existCourse($course[1]);
    //Mirar si  existen estudiantes inscitos activados y si se disminuye el
    //la quota $course[3] sacar erro si es menor a la cantidad disminuida
    global $objDatos;
    if($id_course>0 && $id_course!=$course[0] ){
      echo 3;//0x000D
    }else if($id_course>0 && $id_course == $course[0] && $course[3]>0){
      $numActiStudent = numEstudentActi($course[0]);
            if($course[3] >= $numActiStudent){
                $sql ="UPDATE course SET name_course='".$course[1]."',
                description_course='".$course[2]."',
                quotas_course='".$course[3]."'
                WHERE id_course ='".$course[0]."';";
                $objDatos->executeQuery($sql);
                $objDatos->closeConnect();
                echo 4;//0x0000
          }else{
            echo 6;//0x000D
          }
    }elseif ($id_course==0 && $course[3]>0) {
      $numActiStudent = numEstudentActi($course[0]);
            if($course[3] >= $numActiStudent){
                $sql ="UPDATE course SET name_course='".$course[1]."',
                description_course='".$course[2]."',
                quotas_course='".$course[3]."'
                WHERE id_course ='".$course[0]."';";
                $objDatos->executeQuery($sql);
                $objDatos->closeConnect();
                echo 4;//0x0000
          }else{
            echo 6;//0x000D
          }
    }else{
      echo 5;//0x000D
    }

  }

?>
