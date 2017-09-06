<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/conexion.php');

$objDatos = new DB();
$objDatos->connect();
$action = json_decode(array_key_exists("action", $_POST) ? $_POST["action"] : null);
$course = json_decode(array_key_exists("courses", $_POST) ? $_POST["courses"] : null);

if($action!=1){
  if(!isset($_SESSION)) {
       session_start();
  }
  if(!$_SESSION){
    header ("Location: /chaea/logingIndex.php");
  }else if (("student"!=$_SESSION["rol"])) {
      header ("Location: /chaea/partials/viewStudent/studentIndex.php");
  }
}

switch ($action) {
  case 1:
    tableLoader();
    break;
  case 2:
    tableLoaderIsn();
    break;
  case 3:
    $courses = courseInscriptionStudentNumber();
    echo count($courses);
    break;
  case 4:
    registerCourses($course);
    break;
  case 5:
    $courses = courseInscriptionStudentNumber();
    tableLoaderCourses($courses);
    break;
  case 6:
    deleteCoursesIns($course);
    break;
  case 7:
    tableLoaderAct($course);
    break;
  case 8:
    $url = $course[0]."/".$_SESSION["nickname"];
    $_SESSION["urlFiles"] = preg_replace('[\s+]',"", $url);
    $_SESSION["id_activity"] = $course[1];
    break;
  case 9:
    $_SESSION["band"]=1;
    break;
  case 10:
    tableLoaderTracking($course);
    break;
  case 11:
    $_SESSION["path_ac"] = preg_replace('[\s+]',"", $course);
    echo $_SESSION["path_ac"];
    break;

}
?>
<?php
      //Muestra todos los cursos que puede registar esto es para test chaea
      function tableLoader(){
        //Se consulta los cursos existentes
        global $objDatos;
        $consulta = "SELECT  co.id_course as idco,
                      co.description_course as dc,
                      co.name_course as namco
                      FROM course as co
                       WHERE state_system_course = 'Activo'
                       order by co.id_course;";
        $course = $objDatos->executeQuery($consulta);
                  $objDatos->closeConnect();


        if($course[0]['idco']!=""){
                    $courseTable = "";
                      for ($i=0; $i <count($course) ; $i++) {
                        $courseTable.='{
                              "idco":"'.$course[$i]["idco"].'",
                              "dc":"'.$course[$i]['dc'].'",
                              "namco":"'.$course[$i]['namco'].'"
                            },';
                      }
          }else{
              $courseTable = "";
          }

        $courseTable = substr($courseTable,0, strlen($courseTable) - 1);
        echo '{"data":['.$courseTable.']}';
      }

      //Saca los cursos que no tiene inscritos el estudiante si no ha superado el limite de los 5.
      #cursos no inscritos
      function tableLoaderIsn(){
        //Se consulta los cursos existentes y que no esten incritos por el estudiante.
        $courses = courseInscriptionStudentNumber();
        if(count($courses)<5){
        global $objDatos;
        $consulta = "SELECT co.id_course as idco,
                      co.description_course as dc,
                      co.name_course as namco
                      FROM course  as co
                      WHERE co.state_system_course = 'Activo' and NOT co.id_course
                      IN (SELECT co_st.id_course
                      FROM course_student as co_st
                      WHERE co_st.number_document = '".$_SESSION["document"]."')
                      order by co.id_course; ";
        $course = $objDatos->executeQuery($consulta);
                  $objDatos->closeConnect();


        if($course[0]['idco']!=""){
                    $courseTable = "";
                      for ($i=0; $i <count($course) ; $i++) {
                        $courseTable.='{
                              "idco":"'.$course[$i]["idco"].'",
                              "dc":"'.$course[$i]['dc'].'",
                              "namco":"'.$course[$i]['namco'].'"
                            },';
                      }
          }else{
              $courseTable = "";
          }
        }else{
            $courseTable = "";
        }
        $courseTable = substr($courseTable,0, strlen($courseTable) - 1);
        echo '{"data":['.$courseTable.']}';
      }

      //Saca las actividades del curos dependiendo del estilo de aprendizaje
      #actividades del curso especiales para el estudiante
      function tableLoaderAct($course){
        global $objDatos;
        foreach ($_SESSION['style'] as $key => $val) {
                               if($key=='ac'){
                                 $consulta = "SELECT act.id_activity as idact,
                                  act.name_activity AS name_act,
                                  act.description_activity AS desa,
                                  tyl.type_learning_description as tyle,
                                  tea_act.weight as weight,
                                  st_ac.activity_path as  path_ac
                                  FROM activity as act
                                  inner join course as co
                                  on  co.id_course = '".$course."' and act.id_course = co.id_course and act.state_system_activity = 'Activo'
                                  inner join course_teacher co_te
                                  on co_te.id_course = co.id_course
                                  inner join teacher_activity as tea_act
                                  on tea_act.id_activity = act.id_activity and tea_act.number_document = co_te.number_document
                                  inner join type_learning as tyl
                                  on tyl.id_type_learning = act.id_type_learning --and tyl.type_learning_description = 'activo'
                                  inner join student_activity as st_ac
                                  on st_ac.id_activity = act.id_activity and st_ac.number_document = '".$_SESSION["document"]."'
                                  group by st_ac.activity_path, act.id_activity , act.name_activity , act.description_activity, tyl.type_learning_description , tea_act.weight; ";
                                 $activity = $objDatos->executeQuery($consulta);
                               }elseif ($key=='re') {
                                 $consulta = "SELECT act.id_activity as idact,
                                  act.name_activity AS name_act,
                                  act.description_activity AS desa,
                                  tyl.type_learning_description as tyle,
                                  tea_act.weight as weight,
                                  st_ac.activity_path as  path_ac
                                  FROM activity as act
                                  inner join course as co
                                  on  co.id_course = '".$course."' and act.id_course = co.id_course and act.state_system_activity = 'Activo'
                                  inner join course_teacher co_te
                                  on co_te.id_course = co.id_course
                                  inner join teacher_activity as tea_act
                                  on tea_act.id_activity = act.id_activity and tea_act.number_document = co_te.number_document
                                  inner join type_learning as tyl
                                  on tyl.id_type_learning = act.id_type_learning --and tyl.type_learning_description = 'reflexivo'
                                  inner join student_activity as st_ac
                                  on st_ac.id_activity = act.id_activity and st_ac.number_document = '".$_SESSION["document"]."'
                                  group by st_ac.activity_path, act.id_activity , act.name_activity , act.description_activity, tyl.type_learning_description , tea_act.weight; ";
                                 $activity = $objDatos->executeQuery($consulta);
                               }elseif ($key=='te') {
                                 $consulta = "SELECT act.id_activity as idact,
                                  act.name_activity AS name_act,
                                  act.description_activity AS desa,
                                  tyl.type_learning_description as tyle,
                                  tea_act.weight as weight,
                                  st_ac.activity_path as  path_ac
                                  FROM activity as act
                                  inner join course as co
                                  on  co.id_course = '".$course."' and act.id_course = co.id_course and act.state_system_activity = 'Activo'
                                  inner join course_teacher co_te
                                  on co_te.id_course = co.id_course
                                  inner join teacher_activity as tea_act
                                  on tea_act.id_activity = act.id_activity and tea_act.number_document = co_te.number_document
                                  inner join type_learning as tyl
                                  on tyl.id_type_learning = act.id_type_learning --and tyl.type_learning_description = 'teórico'
                                  inner join student_activity as st_ac
                                  on st_ac.id_activity = act.id_activity and st_ac.number_document = '".$_SESSION["document"]."'
                                  group by st_ac.activity_path, act.id_activity , act.name_activity , act.description_activity, tyl.type_learning_description , tea_act.weight; ";
                                 $activity = $objDatos->executeQuery($consulta);
                               }elseif ($key=='pa') {
                                 $consulta = "SELECT act.id_activity as idact,
                                 act.name_activity AS name_act,
                                 act.description_activity AS desa,
                                 tyl.type_learning_description as tyle,
                                 tea_act.weight as weight,
                                 st_ac.activity_path as  path_ac
                                 FROM activity as act
                                 inner join course as co
                                 on  co.id_course = '".$course."' and act.id_course = co.id_course and act.state_system_activity = 'pragmático'
                                 inner join course_teacher co_te
                                 on co_te.id_course = co.id_course
                                 inner join teacher_activity as tea_act
                                 on tea_act.id_activity = act.id_activity and tea_act.number_document = co_te.number_document
                                 inner join type_learning as tyl
                                 on tyl.id_type_learning = act.id_type_learning --and tyl.type_learning_description = 'teórico'
                                 inner join student_activity as st_ac
                                 on st_ac.id_activity = act.id_activity and st_ac.number_document = '".$_SESSION["document"]."'
                                 group by st_ac.activity_path, act.id_activity , act.name_activity , act.description_activity, tyl.type_learning_description , tea_act.weight; ";
                                 $activity = $objDatos->executeQuery($consulta);
                               }
                        }




                  $objDatos->closeConnect();


        if($activity[0]['idact']!=""){
                    $activityTable = "";
                      for ($i=0; $i <count($activity) ; $i++) {
                        $activityTable.='{
                              "id_activity":"'.$activity[$i]["idact"].'",
                              "name_act":"'.$activity[$i]['name_act'].'",
                              "description_activity":"'.$activity[$i]['desa'].'",
                              "type_learning":"'.$activity[$i]['tyle'].'",
                              "weight":"'.$activity[$i]['weight'].'",
                              "path_ac":"'.$activity[$i]['path_ac'].'"
                            },';
                      }
          }else{
              $activityTable = "";
          }

        $activityTable = substr($activityTable,0, strlen($activityTable) - 1);
        echo '{"data":['.$activityTable.']}';
      }


      //Saca los cursos que tiene inscritos el estudiante
      #cursos inscritos
      function tableLoaderCourses($course){
        //Se consulta los cursos existentes y que no esten incitos por el estudiante.

        global $objDatos;
        $objDatos->closeConnect();


        if($course[0]['idco']!=""){
                    $courseTable = "";
                      for ($i=0; $i <count($course) ; $i++) {
                        $courseTable.='{
                              "idco":"'.$course[$i]["idco"].'",
                              "dc":"'.$course[$i]['dc'].'",
                              "namco":"'.$course[$i]['namco'].'"
                            },';
                      }
          }else{
              $courseTable = "";
          }

        $courseTable = substr($courseTable,0, strlen($courseTable) - 1);
        echo '{"data":['.$courseTable.']}';
      }

      //Saca los cursos que tiene inscrito  tanto activos como inactivos el estudiante se utiliza para saber
      #cuantos puede inscribir el estudiante y cuales puede eliminar.
      function courseInscriptionStudentNumber(){
        global $objDatos;
        $consulta = " SELECT co.id_course as idco,
                      co.description_course as dc,
                      co.name_course as namco,
                      co_st.number_document
                      From course  as co
                      Left Outer Join course_student as co_st
                      ON  co.id_course = co_st.id_course
                      where co.state_system_course = 'Activo'
                      AND co_st.number_document = '".$_SESSION["document"]."'
                      order by co.id_course;";
        $course = $objDatos->executeQuery($consulta);
                  return $course;
      }
      //Saca los cursos que tiene inscrito  tanto activos como inactivos el estudiante se utiliza para saber
      #cuantos puede inscribir el estudiante y cuales puede eliminar.
      function courseNoteActiv(){
        global $objDatos;
        $consulta = "SELECT co.id_course as id_co,
	                co.name_course as co_name,
                  co.description_course as co_des,
                  sum (st_ac.activity_note *(tea_ac.weight / 100))  as note_st
                  FROM student as st, student_activity as st_ac,  activity as act,
		              course_student as co_st, course as co, teacher_activity as tea_ac
                  WHERE  st.number_document = '".$_SESSION["document"]."'
                  and st.number_document = co_st.number_document
                  and co_st.state_course_student = 'Activo'
		              and co_st.id_course = co.id_course
                  and co.id_course = act.id_course
                  and act.state_system_activity = 'Activo'
                  and st.number_document = st_ac.number_document
                  and st_ac.id_activity = act.id_activity
                  and tea_ac.id_activity  = act.id_activity
                  group by id_co, co_des, co_name
                  order by id_co;";
                  $course = $objDatos->executeQuery($consulta);
                  return $course;
      }
      //Saca los cursos que tiene inscrito  solo activos el estudiante se utiliza para saber
      #cuantos puede inscribir el estudiante y cuales puede eliminar.
      function courseInscriptionStudentActi(){
        global $objDatos;
        $consulta = " SELECT co.id_course as idco,
                      co.description_course as dc,
                      co.name_course as namco,
                      co_st.number_document
                      From course  as co
                      Left Outer Join course_student as co_st
                      ON  co.id_course = co_st.id_course and co_st.state_course_student = 'Activo'
                      where co.state_system_course = 'Activo'
                      AND co_st.number_document = '".$_SESSION["document"]."'
                      order by co.id_course;";
        $course = $objDatos->executeQuery($consulta);
                  return $course;
      }

      //Cargar las actividades que creo el usuario X para  X curso.
      function tableLoaderTracking($idCourse){
        //Se consulta los cursos existentes
        global $objDatos;
        $consulta = "	SELECT
                      ac.id_activity as ac_id,
                      ac.name_activity as na_ac,
                      st_ac.activity_note as  note_ac,
                      tea_ac.weight as weight
                      FROM student_activity as st_ac
                      inner join activity as ac
                      on st_ac.id_activity = ac.id_activity and ac.state_system_activity = 'Activo'
                      inner join  course as co
                      on co.id_course = '".$idCourse."' and ac.id_course=co.id_course
                      and '".$_SESSION["document"]."' = st_ac.number_document
                      inner join teacher_activity as tea_ac
                      on tea_ac.id_activity = ac.id_activity
                      group by ac.name_activity, st_ac.activity_note, st_ac.activity_path, ac_id, tea_ac.weight
                      order by  ac_id;";
                  $tracking = $objDatos->executeQuery($consulta);
                  $objDatos->closeConnect();

        if($tracking[0]['ac_id']!=""){
                    $trackingTable = "";
                      for ($i=0; $i <count($tracking) ; $i++) {
                        $note_st = number_format(floatval($tracking[$i]['note_ac']), 1, '.', ' ');
                        $trackingTable.='{
                              "ac_id":"'.$tracking[$i]['ac_id'].'",
                              "na_ac":"'.$tracking[$i]["na_ac"].'",
                              "note_ac":"'.$note_st.'",
                              "weight":"'.$tracking[$i]["weight"].'"
                            },';
                      }
          }else{
              $trackingTable = "";
          }

        $trackingTable = substr($trackingTable,0, strlen($trackingTable) - 1);
        echo '{"data":['.$trackingTable.']}';
      }
      //Fin de Carga



      //Funcion que permite almacenar los cursos a los que se inscribio al usuario.
      function registerCourses($course){
        try {
          global $objDatos;

          for ($i=0; $i <sizeof($course) ; $i++) {
            $sql ="INSERT INTO course_student (id_course, number_document, state_course_student)
            values ('". $course[$i]->id_course."','".$_SESSION["document"]."','Inactivo')";
            $objDatos->executeQuery($sql);
          }
          echo 2;

        } catch (Exception $e) {
          echo 'Existe un fallo en la conexión';
        }
      }

      //función de eliminar curso inscrito por el estudiante
      function deleteCoursesIns($id_course){
        global $objDatos;
        $consulta = "DELETE FROM course_student
        WHERE id_course = '".$id_course."'
        AND number_document = '".$_SESSION["document"]."' ";
        $teacher = $objDatos->executeQuery($consulta);
        $objDatos->closeConnect();
        echo "3";
       }


       function getSubString($string, $length=NULL)
       {
         //Si no se especifica la longitud por defecto es 50
         if ($length == NULL)
             $length = 50;
         //Primero eliminamos las etiquetas html y luego cortamos el string
         $stringDisplay = substr(strip_tags($string), 0, $length);
         //Si el texto es mayor que la longitud se agrega puntos suspensivos
         if (strlen(strip_tags($string)) > $length)
             $stringDisplay .= ' ...';
         return $stringDisplay;
       }



?>
