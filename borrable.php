<?php
if(!isset($_SESSION)) {
     session_start();
}
do{
	// echo key($_SESSION).": ";
	// echo "-->".current($_SESSION)."----";
} while(next($_SESSION))

 ?>

<?php
require_once("/backendPhp/conexion.php");
$objDatos = new DB();
$objDatos->connect();

$person= array(0,"jsnavarroc@unal.edu.co", 2, 3, 4, 5,"jsnavarroc","1053813532");
// validationRol($person, "teacher");
activityStudent('1053845616', '33');


function validationRol ($person, $rol){
  // global $objDatos;
  // $consulta = "SELECT rol.number_document, rol.id_type_document,
  // rol.name, bir.name_birthplace, rol.birthdate, u.name_university,
  // rol.email, rol.number_phone, rol.nickname, rol.gender
  //              FROM teacher as rol, birthplace as bir, university as u
  //              where rol.number_document = '".$_SESSION["document"]."'
  //              and rol.id_birthplace = bir.id_birthplace
  //              and rol.id_university = u.id_university;";
  // $administrator = $objDatos->executeQuery($consulta);
  // $objDatos->closeConnect();
  // echo ''.json_encode($administrator).'';

  global $objDatos;
  $sql = "SELECT COUNT(atribut1.n1) as nickname , COUNT(atribut2.n2) as number_document,
          COUNT(atribut3.n3) as email
          FROM ".$rol."
          LEFT JOIN (select count(nickname) AS n1, nickname from ".$rol."
          where nickname = '".$_SESSION['nickname_up']."' and  password = '".$_SESSION['password_up']."'
          GROUP BY nickname)atribut1
          on ".$rol.".nickname=atribut1.nickname

          LEFT JOIN (select count(number_document) AS n2, number_document from ".$rol."
          where number_document = '".$_SESSION['document_up']."' and  password = '".$_SESSION['password_up']."'
          GROUP BY number_document)atribut2
          on ".$rol.".number_document=atribut2.number_document

          LEFT JOIN (select count(email) AS n3, email from ".$rol."
          where email = '".$_SESSION['email_up']."' and  password = '".$_SESSION['password_up']."'
          GROUP BY email)atribut3
          on ".$rol.".email=atribut3.email;";
  $crud = $objDatos->executeQuery($sql);
  echo "<br>".($crud[0]['nickname'])."<br>";
  var_dump($crud);
  return $crud;

}



//saca todas las actividades que tiene ya el estudiante inscritas
function activityStudent($idStudent, $idCourse){
  try {
          global $objDatos;
          $sql = "SELECT st_ac.id_activity as id_ac
                  FROM student_activity as st_ac, activity as ac
                  WHERE ac.id_course = '".$idCourse."'
                  and ac.id_activity = st_ac.id_activity
                  and st_ac.number_document = '".$idStudent."';";
          $crud = $objDatos->executeQuery($sql);
          // echo $crud[0]['id_ac']+'hola';
          if($crud[0]['id_ac'] < 1){
            echo 0;
          }else{
            for ($i=0; $i < COUNT($crud[0]['id_ac']); $i++) {
              # code...
              echo $crud[$i]['id_ac'];
            }
          }

  } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
  }
}

?>
