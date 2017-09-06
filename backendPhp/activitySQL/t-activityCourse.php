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
$activity = json_decode(array_key_exists("activity", $_POST) ? $_POST["activity"] : null);

switch ($action) {
  case 1:
    //carga todas las actividades.
    tableLoaderActivity($idCourse, $thematic);
    break;
  case 2:
  //crea las actividades
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
  case 7:
    sumPoceActivity($activity);
    break;
  case 8:
    estrategyActivity($activity);
    break;
  case 9:
    estrategyId($activity);
    break;
  case 10:
    estrategyActivityEdit($activity);
  break;
  }
?>
<?php
  //Cargar las actividades que creo el usuario X para  X curso.
  function tableLoaderActivity($idCourse, $thematic){
    global $objDatos;
    $consulta = "	SELECT act.id_activity as idact,
                  act.state_system_activity as stas,
                  act.description_activity AS desa,
                  tea_act.weight as weight,
                  act.name_activity AS name_act,
                  tyl.type_learning_description as tyle,
                  str.description as strategy,
                  perfor.description as performance
                  FROM activity as act
                  inner join type_learning as tyl
                  on tyl.id_type_learning = act.id_type_learning
                  inner join teacher_activity as tea_act
                  on '".$_SESSION["document"]."'= tea_act.number_document
                  and tea_act.id_activity = act.id_activity
                  inner join course as co
                  on co.id_course =  '".$idCourse."'  and co.id_course = act.id_course
                  inner join strategy as str
                  on str.id_strategy = act.strategy
                  inner join thematic as the
                  on the.id_thematic = '".$thematic."' and act.id_thematic = the.id_thematic
                  inner join performance as perfor
                  on perfor.id_performance = act.id_performance
                  group by act.id_activity, act.state_system_activity, act.description_activity,
                  act.name_activity, tyl.type_learning_description, tea_act.weight, str.description,
                  performance
                  order by idact;";
    $activity = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();
    if($activity[0]['idact']!=""){
                $activityTable = "";
                  for ($i=0; $i <count($activity) ; $i++) {
                    $activityTable.='{
                          "id_activity":"'.$activity[$i]['idact'].'",
                          "state_system_activity":"'.$activity[$i]["stas"].'",
                          "description_activity":"'.$activity[$i]['desa'].'",
                          "name_activity":"'.$activity[$i]['name_act'].'",
                          "strategy":"'.$activity[$i]['strategy'].'",
                          "type_learning":"'.$activity[$i]['tyle'].'",
                          "weight":"'.$activity[$i]['weight'].'",
                          "performance":"'.$activity[$i]['performance'].'"
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
    //mira si existe la actidad en su totalidad
       $id_activity = existActivity($activity);
       if($id_activity===0){

              $id_activity =  existActivityBase($activity);

               if($id_activity===0){//Es una actividad nueva la crea desde cero
                     try {
                          $weight= $activity[4] + $activity[5];
                          if($weight<=100){
                             activityStudentNow($activity);
                             echo "1";
                           }else{
                              $tope = 100 - $activity[5];
                              $data = array($tope ,8);
                              echo json_encode($data);
                           }


                     } catch (Exception $e) {
                       echo "No se pudo insertar el curso, por favor comuníquese con el administrador";
                     }

             }else if($id_activity>0){
                $weight = weightActivity($activity, $id_activity);
                if($activity[4]==$weight){
                      try {
                        activityStudentNow($activity);
                        echo "1";
                      } catch (Exception $e) {
                        echo "No se pudo insertar el curso, por favor comuníquese con el administrador";
                      }
                }else{
                  echo '6';//el porcentaje tiene que ser el mismo.
                }
             }

       }else{
               echo "2";//la actividad ya existe no se puede crear
       }

  }
  //fin de funcion crear

  function activityStudentNow($activity){
    global $objDatos;
     $sql= "INSERT INTO activity (name_activity, id_type_learning, description_activity, state_system_activity, id_course, id_thematic, strategy, id_performance)
           values ('".$activity[0]."','".$activity[1]."','".$activity[2]."', 'Inactivo','".$activity[3]."','".$activity[8]."','".$activity[6]."','".$activity[7]."');";
     $objDatos->executeQuery($sql);
     $id_activity= existActivity($activity);
     $sql = "INSERT INTO teacher_activity (number_document, id_activity, weight) values ('".$_SESSION["document"]."','".$id_activity."', '".$activity[4]."');";
     $objDatos->executeQuery($sql);

     //studentCourse solo se utiliza aquí
     $studentCourse = studentCourse($activity[3]);
     //si hay estudiantes ya registrados en el curso se le inscribe la actividad aquí en este
     //punto es donde se le puede indicar el tipo de actividad al estilo de aprendizaje
     if($studentCourse[0]["id_st"]>0){

        for($i=0; $i <count($studentCourse) ; $i++){

          foreach ($studentCourse[$i] as $key => $val) {
																 if($key=='ac' && $activity[1]==1){
                                   $sql = "INSERT INTO student_activity (number_document, id_activity, activity_note) values ('".$studentCourse[$i]["id_st"]."','".$id_activity."', 0);";
                                   $objDatos->executeQuery($sql);
                                  //  echo "Activo : ".$studentCourse[$i]["id_st"];
																 }elseif ($key=='re' && $activity[1]==2) {
                                   $sql = "INSERT INTO student_activity (number_document, id_activity, activity_note) values ('".$studentCourse[$i]["id_st"]."','".$id_activity."', 0);";
                                   $objDatos->executeQuery($sql);
                                  // echo "Reflexivo : ".$studentCourse[$i]["id_st"];
																 }elseif ($key=='te' && $activity[1]==3) {
                                   $sql = "INSERT INTO student_activity (number_document, id_activity, activity_note) values ('".$studentCourse[$i]["id_st"]."','".$id_activity."', 0);";
                                   $objDatos->executeQuery($sql);
                                  // echo "Teórico : ".$studentCourse[$i]["id_st"];
																 }elseif ($key=='pa'&& $activity[1]==4) {
                                   $sql = "INSERT INTO student_activity (number_document, id_activity, activity_note) values ('".$studentCourse[$i]["id_st"]."','".$id_activity."', 0);";
                                   $objDatos->executeQuery($sql);
                                  // echo "Pragmático : ".$studentCourse[$i]["id_st"];
																 }
													}
        }
     }

     $objDatos->closeConnect();
  }

  //Función para editar actividad
  function editActivity($activity){
             try {
                  global $objDatos;
                   $sql= "UPDATE activity
                   SET name_activity = '".$activity[0]."',
                   id_type_learning = '".$activity[1]."',
                   description_activity = '".$activity[2]."',
                   strategy = '".$activity[5]."',
                   id_performance = '".$activity[7]."'
                   WHERE id_course = '".$activity[3]."'
                   and  id_activity = '".$activity[4]."';";
                   $objDatos->executeQuery($sql);

                   $sql= "UPDATE teacher_activity
                   SET  weight = '".$activity[4]."'
                   WHERE number_document = '".$_SESSION["document"]."'
                   AND id_activity IN (	SELECT act.id_activity  as idact FROM activity as act
	                                      inner join course as co
                                        on co.id_course =  '".$activity[3]."'  and co.id_course = act.id_course
                                        and  replace(LOWER('".$activity[0]."'),' ','') = replace(LOWER(act.name_activity),' ',''));";
                   $objDatos->executeQuery($sql);
               echo "3";
             } catch (Exception $e) {
               echo "No se pudo insertar el curso, por favor comuníquese con el administrador";
             }
  }

  function editActi($activity){
       $id_activity= existActivity($activity);

       if($id_activity==$activity[8]){
         editActivity($activity);
       }elseif ($id_activity==0) {
         editActivity($activity);
       }else{
         echo 2;//la actividad ya existe no se puede crear
       }


  }
  //fin de funcion crear

  //Función para desativar actividad
  function desactivationActivity($activity){
    global $objDatos;
    $sql = "UPDATE activity SET state_system_activity ='Inactivo'
            WHERE  id_activity = '".$activity[0]."';";
            $objDatos->executeQuery($sql);


    $sql = "UPDATE teacher_activity SET weight ='0'
            WHERE id_activity = '".$activity[0]."'
            AND number_document = '".$_SESSION["document"]."'";
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
    echo "12";
  }

  function sumPoceActivity($activity){
    global $objDatos;
        $consulta = "	SELECT  tea_act.weight as weight,
                      act.name_activity AS name_act,
                      tyl.id_type_learning as ty
                      FROM activity as act
                      inner join type_learning as tyl
                      on tyl.id_type_learning = act.id_type_learning and id_thematic ='".$activity[1]."'
                      inner join teacher_activity as tea_act
                      on '".$_SESSION["document"]."'= tea_act.number_document
                      and tea_act.id_activity = act.id_activity
                      inner join course as co
                      on co.id_course =  '".$activity[0]."'   and co.id_course = act.id_course
                      group by weight,  name_act, ty
                      order by name_act;";
                  $activity = $objDatos->executeQuery($consulta);
                  $objDatos->closeConnect();
      $act = [''];
      $total= 0;

      for ($i = 0; $i < count($activity); $i++) {
        $band=0;
      for ( $j = 0; $j < count($act); $j++) {
        if ($act[$j]==$activity[$i]['name_act']) {
          $band=1;
        }
      }
      if($band!=1){
        if($act[0]==''){
          $act[0]=$activity[$i]['name_act'];
          $total=$total + $activity[$i]['weight'];
        }else{
          array_push($act,$activity[$i]['name_act']);
          $total=$total + $activity[$i]['weight'];
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
        $activity = $objDatos->executeQuery($consulta);
        $objDatos->closeConnect();

        $data = array($activity, 9);
        echo json_encode($data);

  }
  function estrategyActivityEdit($id_type_learning){
      global $objDatos;
        $consulta = "	SELECT  str.description as str_des, str.id_strategy as str_id
                      FROM strategy as str
                      WHERE id_type_learning = '".$id_type_learning."'
                      ORDER BY str_id;";
        $activity = $objDatos->executeQuery($consulta);
        $objDatos->closeConnect();

        $data = array($activity, 11);
        echo json_encode($data);

  }

    function  estrategyId($activity){
      global $objDatos;
      $sql = "SELECT id_strategy as id_str from  strategy
      WHERE replace(LOWER('".$activity[0]."'),' ','') = replace(LOWER(description),' ','')
      and '".$activity[1]."' = id_type_learning ";
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
