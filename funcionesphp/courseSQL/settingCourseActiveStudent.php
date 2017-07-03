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

$action = json_decode(array_key_exists("action", $_POST) ? $_POST["action"] : null);
$idCourse = json_decode(array_key_exists("idCourse", $_POST) ? $_POST["idCourse"] : null);
$student = json_decode(array_key_exists("student", $_POST) ? $_POST["student"] : null);

switch ($action) {
  case 1:
    tableLoader($idCourse);
    break;
  case 2:
    $res = quotasCourse($student[2]);
    if($res!=0){
      studentActiveCourse($student[0], $student[2]);
    }else{
      echo 2;
    }
    break;
  case 3:
    studentDesactivateCourse($student[0], $student[2]);
    break;
  }
?>
<?php
//Cargar la tabla de la BD
  function tableLoader($idCourse){
    //Se consulta los cursos existentes
    global $objDatos;
    $consulta = "SELECT coe.state_course_student as state,
                  st.number_document AS num,
                  st.name AS nam,
                  co.name_course  as namecor
            	    FROM student as st
            	    inner join course_student as coe
            	    on st.number_document = coe.number_document and st.state_system = 'Activo'
            	    inner join course as co
            	    on coe.id_course = co.id_course and '".$idCourse."' = co.id_course ;";
    $course = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();
    if($course[0]['num']!=""){
                $courseTable = "";
                  for ($i=0; $i <count($course) ; $i++) {
                    $courseTable.='{
                          "state":"'.$course[$i]["state"].'",
                          "idStudent":"'.$course[$i]['num'].'",
                          "nameStudente":"'.$course[$i]['nam'].'",
                          "namecor":"'.$course[$i]['namecor'].'"
                        },';
                  }
      }else{
          $courseTable = "";
      }

    $courseTable = substr($courseTable,0, strlen($courseTable) - 1);
    echo '{"data":['.$courseTable.']}';
  }

  function studentActiveCourse($idStudent, $idCourse){
    global $objDatos;
    $sql = "UPDATE course_student SET state_course_student ='Activo'
            WHERE number_document ='".$idStudent."'
            AND id_course = '".$idCourse."';";
            $objDatos->executeQuery($sql);
           //  enviarEmail($number_document);
            $objDatos->closeConnect();
            echo 1;

  }


  function studentDesactivateCourse($idStudent, $idCourse){
    global $objDatos;
    $sql = "UPDATE course_student SET state_course_student ='Inactivo'
            WHERE number_document ='".$idStudent."'
            AND id_course = '".$idCourse."';";
            $objDatos->executeQuery($sql);
           //  enviarEmail($number_document);
            $objDatos->closeConnect();
            echo 3;

  }





 ?>
