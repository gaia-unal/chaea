<?php session_start();
if(!$_SESSION){
  header ("Location: /chaea/logingIndex.php");
}else if (("administrator"!=$_SESSION["rol"])) {
    header ("Location: /chaea/logingIndex.php");
}
?>
<?php
require_once("../conexion.php");
require_once("../recoverInfo.php");
$objDatos = new DB();
$objDatos->connect();


$action = json_decode(array_key_exists("action", $_POST) ? $_POST["action"] : null);
$strategy = json_decode(array_key_exists("strategy", $_POST) ? $_POST["strategy"] : null);


switch ($action) {
  case 1:
    tableLoaderStrategy();
    break;
  case 2:
    createNewStrategy($strategy);
    break;
  case 3:
    editStrategy($strategy);
    break;
  case 4:
    deletStrategy($strategy);
    break;

  }
?>
<?php
  //Cargar las actividades que creo el usuario X para  X curso.
  function tableLoaderStrategy(){
    //Se consulta los cursos existentes
    global $objDatos;
    $consulta = "SELECT stra.id_strategy as id_str, stra.description as str_des,
    ty_lear.type_learning_description as ty_lear_des
                  FROM strategy as stra
                  inner join type_learning as ty_lear
                  on ty_lear.id_type_learning = stra.id_type_learning;";
    $strategy = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();
    if($strategy[0]['id_str']!=""){
                $strategyTable = "";
                  for ($i=0; $i <count($strategy) ; $i++) {
                    $strategyTable.='{
                          "id_str":"'.$strategy[$i]['id_str'].'",
                          "str_des":"'.$strategy[$i]["str_des"].'",
                          "ty_lear_des":"'.$strategy[$i]['ty_lear_des'].'"
                        },';
                  }
      }else{
          $strategyTable = "";
      }

    $strategyTable = substr($strategyTable,0, strlen($strategyTable) - 1);
    echo '{"data":['.$strategyTable.']}';
  }
  //Fin de Carga

  //Función para crear una estrategia
  function createNewStrategy($strategy){
    global $objDatos;

       $id_strategy= existStrategy($strategy);

       if($id_strategy==0){
         try {
           $sql= "INSERT INTO strategy (description, id_type_learning) values ('".$strategy[0]."','".$strategy[1]."');";
           $objDatos->executeQuery($sql);
           $objDatos->closeConnect();
           echo "1";
         } catch (Exception $e) {
           echo "No se pudo insertar la estrategia, por favor comuníquese con el administrador";
         }


       }else{
               echo "2";
            }

  }
  //fin de funcion crear

  //Función para editar una estrategia
  function editStrategy($strategy){
    global $objDatos;

       $id_strategy= existStrategy($strategy);

       if($id_strategy==$strategy[2]||$id_strategy==0){
         try {
           $sql ="UPDATE strategy SET description='".$strategy[0]."',
           id_type_learning='".$strategy[1]."'
           WHERE id_strategy ='".$strategy[2]."';";
           $objDatos->executeQuery($sql);
           $objDatos->closeConnect();
           echo "1";
         } catch (Exception $e) {
           echo "No se pudo insertar la estrategia, por favor comuníquese con el administrador";
         }


       }else{
               echo "2";//el curso ya existe no se puede crear
            }

  }
  //fin de funcion editar



  //Función para eliminar una estrategia
  function deletStrategy($strategy){
    global $objDatos;
    $consulta = "DELETE FROM strategy WHERE id_strategy ='".$strategy."';";
    $objDatos->executeQuery($consulta);
    $objDatos->closeConnect();
    echo "Se ha eliminado la estrategia correctamente";
  }
  //fin de funcion eliminar


?>
