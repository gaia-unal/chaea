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
$note = json_decode(array_key_exists("note", $_POST) ? $_POST["note"] : null);
// tableLoaderTrackingActStu('3', '910436652');
// tableLoaderTracking('3');
switch ($action) {
  case 1:
    tableLoaderTracking($idCourse);
    break;
  case 2:
    tableLoaderTrackingActStu($idCourse,$student);
    break;
  case 3:
    noteUpdate($note);
    break;
  }
?>
<?php
  //Cargar las actividades que creo el usuario X para  X curso.
  function tableLoaderTracking($idCourse){
    //Se consulta los cursos existentes
    global $objDatos;
    $consulta = "	SELECT st_ac.number_document as id_st,
                  st.name as st_name,
                  sum (st_ac.activity_note *(tea_ac.weight / 100))  as note_st
                  FROM student as st, student_activity as st_ac,  activity as act,
		              course_student as co_st, course as co, teacher_activity as tea_ac
                  WHERE  st.number_document = co_st.number_document
                  and co.id_course = '".$idCourse."'
                  and co.id_course = act.id_course
                  and co_st.id_course = co.id_course
                  and co_st.state_course_student = 'Activo'
                  and act.state_system_activity = 'Activo'
                  and st.number_document = st_ac.number_document
                  and st_ac.id_activity = act.id_activity
                  and tea_ac.id_activity  = act.id_activity
                	group by st_ac.number_document, st.name;";
              $tracking = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();


    if($tracking[0]['id_st']!=""){
                $trackingTable = "";
                  for ($i=0; $i <count($tracking) ; $i++) {
                    $note_st = number_format(floatval($tracking[$i]['note_st']), 1, '.', ' ');
                    $trackingTable.='{
                          "id_st":"'.$tracking[$i]['id_st'].'",
                          "st_name":"'.$tracking[$i]["st_name"].'",
                          "note_st":"'.$note_st.'"
                        },';
                  }
      }else{
          $trackingTable = "";
      }

    $trackingTable = substr($trackingTable,0, strlen($trackingTable) - 1);
    echo '{"data":['.$trackingTable.']}';
  }
  //Fin de Carga

  function tableLoaderTrackingActStu($idCourse, $student){

    global $objDatos;


    $consulta = " SELECT ac.name_activity as na_ac,
                  ac.id_activity as ac_id,
                  st_ac.activity_note as  note_ac,
                  st_ac.activity_path as  path_ac,
                  tea_ac.weight as weight
                  FROM student_activity as st_ac
                  inner join activity as ac
                  on st_ac.id_activity = ac.id_activity and ac.state_system_activity = 'Activo'
        	        inner join  course as co
                  on co.id_course = '".$idCourse."' and ac.id_course=co.id_course
                  and '".$student."'= st_ac.number_document
                  inner join teacher_activity as tea_ac
                  on tea_ac.id_activity = ac.id_activity
                  group by ac.name_activity, st_ac.activity_note, st_ac.activity_path, ac.id_activity, tea_ac.weight";
    $tracking = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();

    if($tracking[0]['note_ac']!=""){
                $trackingTable = "";
                  for ($i=0; $i <count($tracking) ; $i++) {
                    $trackingTable.='{
                          "na_ac":"'.$tracking[$i]['na_ac'].'",
                          "ac_id":"'.$tracking[$i]['ac_id'].'",
                          "path_ac":"'.$tracking[$i]['path_ac'].'",
                          "note_ac":"'.$tracking[$i]["note_ac"].'",
                          "weight":"'.$tracking[$i]["weight"].'"
                        },';
                  }
      }else{
          $trackingTable = "";
      }

    $trackingTable = substr($trackingTable,0, strlen($trackingTable) - 1);
    echo '{"data":['.$trackingTable.']}';
  }

  function noteUpdate ($note){
    global $objDatos;
    $sql ="UPDATE student_activity SET activity_note='".$note[1]."'
            WHERE number_document = '".$note[0]."'and id_activity = '".$note[2]."';";
            $objDatos->executeQuery($sql);
            $objDatos->closeConnect();
            echo "1";
  }


 ?>
