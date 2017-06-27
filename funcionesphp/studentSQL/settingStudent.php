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
    $consulta = "SELECT st.state_system, st.number_document, doc.type_document,
    st.name, bir.name_birthplace, st.birthdate, u.name_university,
    st.semester,pro.name_program, st.email, st.number_phone, st.nickname, st.gender
                 FROM student as st, birthplace as bir,
                 university as u, document as doc, academic_program pro
                 where st.id_birthplace = bir.id_birthplace
                 and st.id_university = u.id_university
                 and st.id_type_document = doc.id_type_document
                 and st.id_program = pro.id_program;";
    $student = $objDatos->executeQuery($consulta);
     $objDatos->closeConnect();
    $tabla = "";


    for ($i=0; $i <count($student) ; $i++) {

      $tabla.='{
            "state":"'.$student[$i]["state_system"].'",
            "number_document":"'.$student[$i]['number_document'].'",
            "type_document":"'.$student[$i]['type_document'].'",
            "name":"'.$student[$i]['name'].'",
            "birthplace":"'.$student[$i]['name_birthplace'].'",
            "birthdate":"'.$student[$i]['birthdate'].'",
            "university":"'.$student[$i]['name_university'].'",
            "name_program":"'.$student[$i]['name_program'].'",
            "semester":"'.$student[$i]['semester'].'",
            "email":"'.$student[$i]['email'].'",
            "number_phone":"'.$student[$i]['number_phone'].'",
            "nickname":"'.$student[$i]['nickname'].'",
            "gender":"'.$student[$i]['gender'].'"

          },';
    }

    $tabla = substr($tabla,0, strlen($tabla) - 1);

    echo '{"data":['.$tabla.']}';




 ?>
