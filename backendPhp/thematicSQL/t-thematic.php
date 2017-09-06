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
$thematic = json_decode(array_key_exists("thematic", $_POST) ? $_POST["thematic"] : null);
switch ($action) {
  case 1:
    //carga todas las tematicas.
    tableLoaderThematic($idCourse);
    break;
  case 2:
    newThematic($thematic);
    break;
  case 3:
    editThematic($thematic);
    break;
  case 4:
    deleteThematic($thematic);
    break;
  }
?>
<?php
  //Cargar las actividades que creo el usuario X para  X curso.
  function tableLoaderThematic($idCourse){
    global $objDatos;
    $consulta = "	SELECT them.id_thematic as id_thematic,
                  them.description as name_thematic
                  FROM thematic as them
                  inner join course as co
                  on co.id_course =  '".$idCourse."'  and them.id_course = co.id_course
                  inner join course_teacher as co_tea
                  on co_tea.id_course = co.id_course
                  and co_tea.number_document = '".$_SESSION["document"]."'
                  order by id_thematic;";
    $thematic = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();
    if($thematic[0]['id_thematic']!=""){
                $thematicTable = "";
                  for ($i=0; $i <count($thematic) ; $i++) {
                    $thematicTable.='{
                          "id_thematic":"'.$thematic[$i]['id_thematic'].'",
                          "name_thematic":"'.$thematic[$i]["name_thematic"].'"
                        },';
                  }
      }else{
          $thematicTable = "";
      }

    $thematicTable = substr($thematicTable,0, strlen($thematicTable) - 1);
    echo '{"data":['.$thematicTable.']}';
  }
  //Fin de Carga

  //Función para crear una nueva tematica
  function newThematic($thematic){
       $info_thematic= existThematic($thematic);
       if($info_thematic===0){
         try {
           global $objDatos;
            $sql= "INSERT INTO thematic (description, id_course )
                  values ('".$thematic[0]."','".$thematic[1]."');";
            $objDatos->executeQuery($sql);
            $objDatos->closeConnect();
            echo "1";
         } catch (Exception $e) {
           echo "No se pudo insertar la temática, por favor comuníquese con el administrador";

       }
     }else{
               echo "2";//la tematica ya existe no se puede crear para el curso
     }

  }
  //fin de funcion crear


  //Función para editar actividad
  function editThematic($thematic){
    $info_thematic= existThematic($thematic);
          if($info_thematic===0 || $info_thematic===$thematic[2]){
               try {
                     global $objDatos;
                     $sql= "UPDATE thematic
                     SET description = '".$thematic[0]."'
                     WHERE id_thematic = '".$thematic[2]."';";
                     $objDatos->executeQuery($sql);
                     $objDatos->closeConnect();
                 echo "3";
               } catch (Exception $e) {
                 echo "No se pudo insertar el curso, por favor comuníquese con el administrador";
               }
           }else{
                     echo "2";//la tematica ya existe no se puede editar para el curso
           }

  }

  function deleteThematic($thematic){
    global $objDatos;
    $consulta = "DELETE FROM thematic WHERE id_thematic = '".$thematic."';";
    $objDatos->executeQuery($consulta);
    $objDatos->closeConnect();
    echo "4";
  }

  function sumPoceActivity($id_course){
    global $objDatos;
        $consulta = "	SELECT  tea_act.weight as weight,
                      act.name_activity AS name_act,
                      tyl.id_type_learning as ty
                      FROM activity as act
                      inner join type_learning as tyl
                      on tyl.id_type_learning = act.id_type_learning
                      inner join teacher_activity as tea_act
                      on '".$_SESSION["document"]."'= tea_act.number_document
                      and tea_act.id_activity = act.id_activity
                      inner join course as co
                      on co.id_course =  '".$id_course."'   and co.id_course = act.id_course
                      group by weight,  name_act, ty
                      order by name_act;";
                  $thematic = $objDatos->executeQuery($consulta);
                  $objDatos->closeConnect();
      $act = [''];
      $total= 0;

      for ($i = 0; $i < count($thematic); $i++) {
        $band=0;
      for ( $j = 0; $j < count($act); $j++) {
        if ($act[$j]==$thematic[$i]['name_act']) {
          $band=1;
        }
      }
      if($band!=1){
        if($act[0]==''){
          $act[0]=$thematic[$i]['name_act'];
          $total=$total + $thematic[$i]['weight'];
        }else{
          array_push($act,$thematic[$i]['name_act']);
          $total=$total + $thematic[$i]['weight'];
        }

      }

    }
    $data = array($total, 7);
    echo json_encode($data);
  }

  function estrategyActivity($id_type_learning){
      global $objDatos;
        $consulta = "	SELECT  str.description as str_des, str.id_strategy as str_id
                      FROM strategy as str
                      WHERE id_type_learning = '".$id_type_learning."'
                      ORDER BY str_id;";
        $thematic = $objDatos->executeQuery($consulta);
        $objDatos->closeConnect();

        $data = array($thematic, 9);
        echo json_encode($data);

  }

    function  estrategyId($thematic){
      global $objDatos;
      $sql = "SELECT id_strategy as id_str from  strategy
      WHERE replace(LOWER('".$thematic[0]."'),' ','') = replace(LOWER(description),' ','')
      and '".$thematic[1]."' = id_type_learning ";
      $crud = $objDatos->executeQuery($sql);
      if($crud[0]['id_str']>0){
        $data = array($crud[0]['id_str'], 10);
        echo json_encode($data);
      }else {
        $data = array(0, 10);
        echo json_encode($data);
      }

    }
 ?>
