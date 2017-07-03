<?php
  if(!isset($_SESSION)) {
       session_start();
  }
  if(!$_SESSION){
    header ("Location: /chaea/logingIndex.php");
  }else if (("teacher"!=$_SESSION["rol"])) {
    header ("Location: /chaea/logingIndex.php");
  }
?>
<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/conexion.php');
// require_once($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/recoverInfo.php');
$objDatos = new DB();
$objDatos->connect();

?>
<?php
  function consultCoruse(){
    try {
          global $objDatos;
          $sql = $sql = "SELECT co.description_course as dc,
                         co.id_course as idco,  co.name_course as namco
                         FROM course as co, course_teacher as ct WHERE co.state_system_course ='Activo'
                         AND ct.number_document = '".$_SESSION["document"]."'
                         group by co.id_course;";
                         $crud = $objDatos->executeQuery($sql);
                         return $crud;
     } catch (Exception $e) {
       echo 'Existe un fallo en la conexión';

     }
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
