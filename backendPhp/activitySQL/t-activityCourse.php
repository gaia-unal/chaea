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
$activity = json_decode(array_key_exists("activity", $_POST) ? $_POST["activity"] : null);

switch ($action) {
  case 1:
    tableLoaderActivity($idCourse);
    break;
  case 2:
    newActivity($activity);
    break;
  case 3:
    editActi($activity);
    break;
  case 4:
    acvationActivity($activity);
    break;
  case 5:
    desactivationActivity($activity);
    break;
  case 6:
    deleteActivity($activity);
    break;
  }
?>
<?php
  //Cargar las actividades que creo el usuario X para  X curso.
  function tableLoaderActivity($idCourse){
    //Se consulta los cursos existentes
    global $objDatos;
    $consulta = "SELECT act.id_activity as idact,
                  act.state_system_activity as stas,
                  act.description_activity AS desa,
                  act.name_activity AS nama,
                  tyl.type_learning_description as tyle
                  FROM activity as act
                  inner join type_learning as tyl
                  on tyl.id_type_learning = act.id_type_learning
                  inner join activity
                  on '".$_SESSION["document"]."' = act.number_document_teacher
                  inner join course_activity as co_act
                  on co_act.id_course = '".$idCourse."' and co_act.id_activity = act.id_activity
                  group by act.id_activity, act.state_system_activity, act.description_activity, act.name_activity, tyl.type_learning_description ;";
    $activity = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();
    if($activity[0]['idact']!=""){
                $activityTable = "";
                  for ($i=0; $i <count($activity) ; $i++) {
                    $activityTable.='{
                          "id_activity":"'.$activity[$i]['idact'].'",
                          "state_system_activity":"'.$activity[$i]["stas"].'",
                          "description_activity":"'.$activity[$i]['desa'].'",
                          "name_activity":"'.$activity[$i]['nama'].'",
                          "type_learning":"'.$activity[$i]['tyle'].'"
                        },';
                  }
      }else{
          $activityTable = "";
      }

    $activityTable = substr($activityTable,0, strlen($activityTable) - 1);
    echo '{"data":['.$activityTable.']}';
  }
  //Fin de Carga

  //Función para crear una nueva actividad
  function newActivity($activity){
       $id_activity= existActivity($activity);
       if($id_activity===0){
         try {
              global $objDatos;
               $sql= "INSERT INTO activity (name_activity, id_type_learning, description_activity, id_course ,number_document_teacher, state_system_activity)
                     values ('".$activity[0]."','".$activity[1]."','".$activity[2]."','".$activity[3]."' ,'".$_SESSION["document"]."', 'Inactivo');";
               $objDatos->executeQuery($sql);
               $id_activity = existActivity($activity);
               //Se inserta en el profesor el nuevo curso que creo.
               $sql = "INSERT INTO course_activity (id_course, id_activity) values ('".$activity[3]."','".$id_activity."');";
               $objDatos->executeQuery($sql);
               $objDatos->closeConnect();
           echo "1: ".$id_activity;
         } catch (Exception $e) {
           echo "No se pudo insertar el curso, por favor comuníquese con el administrador";
         }


       }else{
               echo "2";//la actividad ya existe no se puede crear
            }

  }
  //fin de funcion crear

  //Función para editar actividad
  function editActivity($activity){
             try {
                  global $objDatos;
                   $sql= "UPDATE activity
                   SET name_activity = '".$activity[0]."',
                   id_type_learning = '".$activity[1]."',
                   description_activity = '".$activity[2]."'
                   WHERE id_course = '".$activity[3]."' and  id_activity = '".$activity[4]."';";
                   $objDatos->executeQuery($sql);
               echo "3";
             } catch (Exception $e) {
               echo "No se pudo insertar el curso, por favor comuníquese con el administrador";
             }
  }

  function editActi($activity){
       $id_activity= existActivity($activity);

       if($id_activity>0 && $id_activity == $activity[4] ){

         editActivity($activity);
       }elseif ($id_activity==0) {
         editActivity($activity);
       }else{
         echo "2";//la actividad ya existe no se puede crear
       }


  }
  //fin de funcion crear

  //Función para desativar actividad
  function desactivationActivity($activity){
    global $objDatos;
    $sql = "UPDATE activity SET state_system_activity ='Inactivo'
            WHERE  id_activity = '".$activity[0]."';";
            $objDatos->executeQuery($sql);
           //  enviarEmail($number_document);
            $objDatos->closeConnect();
            echo 4;
  }
  //Función para activar actividad
  function acvationActivity($activity){
    global $objDatos;
    $sql = "UPDATE activity SET state_system_activity ='Activo'
            WHERE id_activity = '".$activity[0]."';";
            $objDatos->executeQuery($sql);
           //  enviarEmail($number_document);
            $objDatos->closeConnect();
            echo 5;
  }

  function deleteActivity($activity){
    global $objDatos;
    $consulta = "DELETE FROM activity WHERE id_activity = '".$activity."'";
    $objDatos->executeQuery($consulta);
    $objDatos->closeConnect();
    echo "Se ha eliminado la actividad correctamente";
  }




 ?>
