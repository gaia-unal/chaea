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
require_once($_SERVER["DOCUMENT_ROOT"].'/chaea/funcionesphp/conexion.php');
// require_once($_SERVER["DOCUMENT_ROOT"].'/chaea/funcionesphp/recoverInfo.php');
$objDatos = new DB();
$objDatos->connect();

?>
<?php
  function consultCoruse(){
    try {
          global $objDatos;
          $sql = $sql = "SELECT description_course as dc,
                         id_course as idco, name_course as namco
                         FROM course";
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
