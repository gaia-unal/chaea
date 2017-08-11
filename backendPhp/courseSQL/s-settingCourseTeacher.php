<?php session_start();
if(!$_SESSION){
  header ("Location: /chaea/logingIndex.php");
}else if (("student"!=$_SESSION["rol"])) {
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
    $consulta = "SELECT cour.state_system_course, cour.id_course, cour.name_course,
                 cour.description_course, cour.quotas_course
                 FROM course as cour
                 INNER JOIN course_teacher as cote
                 on cote.id_course = cour.id_course and
                 ".$_SESSION["document"]." = cote.number_document;";
    $course = $objDatos->executeQuery($consulta);
    if($course[0]['name_course']!=""){

              //saca el numero de estudiantes inscritos
              $consulta = "SELECT count(st.number_document) AS n1,  co.name_course  as namecor
                            FROM student as st
                            inner join course_student
                            on st.number_document = course_student.number_document
                            inner join course as co
                            on course_student.id_course = co.id_course
                            group by co.name_course;";
              $numest = $objDatos->executeQuery($consulta);


              $consulta = "SELECT co.id_course , count(st.number_document) as stua
                            FROM student as st
                            inner join course_student as coe
                            on st.number_document = coe.number_document and coe.state_course_student = 'Activo'
                            inner join course as co
                            on coe.id_course = co.id_course
                            group by co.id_course;";
              $numActiStudent = $objDatos->executeQuery($consulta);

              //saca el numero de actividades
              $consulta = "SELECT count(co.id_course) AS n2,  co.name_course  as namecor
                            FROM activity as act
                            inner join course as co
                            on act.id_course = co.id_course
                            group by co.id_course";
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
                      for ($j=0; $j <count($numActiStudent) ; $j++) {
                        if($course[$i]['id_course']== $numActiStudent[$j]['id_course']){
                          if($course[$i]['quotas_course']!="N/A"){
                            $course[$i]['num_est_ac']= $numActiStudent[$j]['stua'];
                            $course[$i]['cup_dis']= (intval($course[$i]['quotas_course']) - intval($numActiStudent[$j]['stua']));
                          }else{
                            $course[$i]['num_est_ac']= $numActiStudent[$j]['stua'];
                            $course[$i]['cup_dis']="N/A";
                          }
                          break;
                        }else{
                          if($course[$i]['quotas_course']!="N/A"){
                              $course[$i]['cup_dis'] = intval($course[$i]['quotas_course']);
                              $course[$i]['num_est_ac']=0;
                          }else{
                            $course[$i]['cup_dis'] = "N/A";
                            $course[$i]['num_est_ac']=0;
                          }
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
                      "quotas_course":"'.$course[$i]['quotas_course'].'",
                      "num_est_ac":"'.$course[$i]['num_est_ac'].'",
                      "cup_dis":"'.$course[$i]['cup_dis'].'",
                      "num_est":"'.$course[$i]['num_est'].'",
                      "num_act":"'.$course[$i]['num_act'].'"
                    },';
              }
  }else{
      $courseTable = "";
  }

    $courseTable = substr($courseTable,0, strlen($courseTable) - 1);
    echo '{"data":['.$courseTable.']}';




 ?>
