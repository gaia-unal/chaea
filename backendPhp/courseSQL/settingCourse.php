<?php session_start();
if(!$_SESSION){
  header ("Location: /chaea/logingIndex.php");
}else if (("administrator"!=$_SESSION["rol"])) {
    header ("Location: /chaea/logingIndex.php");
}
?>
<?php
require_once("../conexion.php");
$objDatos = new DB();
$objDatos->connect();
?>
<?php
//Cargar la tabla de la BD

    //Se consulta los cursos existentes
    global $objDatos;
    $consulta = "SELECT cour.state_system_course, cour.id_course ,cour.name_course, cour.description_course
                  FROM course as cour";
    $course = $objDatos->executeQuery($consulta);


    //saca el numero de estudiantes inscritos
    $consulta = "SELECT count(st.number_document) AS n1,  co.name_course  as namecor FROM student as st
                  inner join course_student
                  on st.number_document = course_student.number_document
                  inner join course as co
                  on course_student.id_course = co.id_course
                  group by co.name_course;";
    $numest = $objDatos->executeQuery($consulta);

    //saca el numero de actividades
    $consulta = "SELECT count(act.id_activity) AS n2,
                  co.name_course as namecor
                  FROM activity as act
                  inner join course as co
                  on act.id_course = co.id_course
                  group by  co.name_course ;";
    $numacti = $objDatos->executeQuery($consulta);

  $objDatos->closeConnect();
  $courseTable = "";
    for ($i=0; $i <count($course) ; $i++) {
            for ($j=0; $j <count($numest) ; $j++) {
              if($course[$i]['name_course']== $numest[$j]['namecor']){
                $course[$i]['num_est']= $numest[$j]['n1'];
                break;
              }else{
                $course[$i]['num_est']=0;
              }
            }

            for ($j=0; $j <count($numacti) ; $j++) {
              if($course[$i]['name_course']== $numacti[$j]['namecor']){
                $course[$i]['num_act']= $numacti[$j]['n2'];
                break;
              }else{
                $course[$i]['num_act']=0;
              }
            }

      $courseTable.='{
            "state_system_course":"'.$course[$i]["state_system_course"].'",
            "id_course":"'.$course[$i]['id_course'].'",
            "name_course":"'.$course[$i]['name_course'].'",
            "description_course":"'.$course[$i]['description_course'].'",
            "num_est":"'.$course[$i]['num_est'].'",
            "num_act":"'.$course[$i]['num_act'].'"


          },';
    }

    $courseTable = substr($courseTable,0, strlen($courseTable) - 1);

    echo '{"data":['.$courseTable.']}';




 ?>
