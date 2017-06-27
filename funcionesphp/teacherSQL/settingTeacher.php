<?php session_start();

if(!$_SESSION){
  header ("Location: ./chaea/logingIndex.php");
}else if (("administrator"!=$_SESSION["rol"])) {
    header ("Location: ./chaea/logingIndex.php");
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
    $consulta = "SELECT te.state_system, te.number_document, doc.type_document ,te.name, bir.name_birthplace,
     te.birthdate ,u.name_university, te.email, te.number_phone, te.nickname, te.gender, te.password
                 FROM teacher as te, university as u, birthplace as bir, document as doc
                 where te.id_university = u.id_university
                 and te.id_birthplace = bir.id_birthplace
                 and te.id_type_document = doc.id_type_document;";
    $teacher = $objDatos->executeQuery($consulta);
    $objDatos->closeConnect();
    $tabla = "";

    for ($i=0; $i <count($teacher) ; $i++) {

      $tabla.='{
            "password":"'.$teacher[$i]['password'].'",
            "state":"'.$teacher[$i]["state_system"].'",
            "number_document":"'.$teacher[$i]['number_document'].'",
            "type_document":"'.$teacher[$i]['type_document'].'",
            "name":"'.$teacher[$i]['name'].'",
            "birthplace":"'.$teacher[$i]['name_birthplace'].'",
            "birthdate":"'.$teacher[$i]['birthdate'].'",
            "university":"'.$teacher[$i]['name_university'].'",
            "email":"'.$teacher[$i]['email'].'",
            "number_phone":"'.$teacher[$i]['number_phone'].'",
            "nickname":"'.$teacher[$i]['nickname'].'",
            "gender":"'.$teacher[$i]['gender'].'"


          },';
    }

    $tabla = substr($tabla,0, strlen($tabla) - 1);

    echo '{"data":['.$tabla.']}';




 ?>
