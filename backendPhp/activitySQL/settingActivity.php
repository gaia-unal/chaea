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


    global $objDatos;
    $consulta = "SELECT act.id_activity,act.state_system_activity,act.name_activity,
                te.name, lea.type_learning_description,co.name_course
                FROM activity as act, teacher as te, type_learning as lea, course as co, teacher_activity as te_act
                WHERE te_act.number_document = te.number_document
                and te_act.id_activity = act.id_activity
                and act.id_type_learning = lea.id_type_learning
                and act.id_course = co.id_course;";
    $activity = $objDatos->executeQuery($consulta);
    $objDatos->closeConnect();
    $activityTable = "";


    for ($i=0; $i <count($activity) ; $i++) {


      $activityTable.='{
            "id_activity":"'.$activity[$i]["id_activity"].'",
            "state_system_activity":"'.$activity[$i]['state_system_activity'].'",
            "name_activity":"'.$activity[$i]['name_activity'].'",
            "name":"'.$activity[$i]['name'].'",
            "type_learning_description":"'.$activity[$i]['type_learning_description'].'",
            "name_course":"'.$activity[$i]['name_course'].'"
          },';
    }

    $activityTable = substr($activityTable,0, strlen($activityTable) - 1);

    echo '{"data":['.$activityTable.']}';




 ?>
