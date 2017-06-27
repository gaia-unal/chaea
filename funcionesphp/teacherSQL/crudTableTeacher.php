<?php session_start();
set_time_limit(300);
if(!$_SESSION){
  header ("Location: ./chaea/logingIndex.php");
}else if (("administrator"!=$_SESSION["rol"])) {
    header ("Location: ./chaea/logingIndex.php");
}
 ?>
<?php
require_once("../conexion.php");
require_once("../recoverInfo.php");
$objDatos = new DB();
$objDatos->connect();
$action= array_key_exists("action", $_POST) ? $_POST["action"] : null;
$person = json_decode(array_key_exists("person", $_POST) ? $_POST["person"] : null);
$informartion=[];

switch ($action) {
  case 1:
    deleteTeacher($person);
    break;
  case 2:
    $tracing =validationRol('teacher');
    controlInsUpdaAdmin($tracing,$person);
    break;
  case 3:
    echo activationUser($person[1]);
    break;
  case 4:
    echo desactivationUser($person[1]);
    break;
  case 5:
      if(session_id() == ""){
        session_start();
      }

    $_SESSION["document_up"]= $person[0];
    $_SESSION["email_up"]= $person[1];
    $_SESSION["nickname_up"]= $person[2];
    $_SESSION["password_up"]= passwordRecover("teacher",$person[0]);
    break;

}

?>

 <?php
 function updateTeacher($person){
   global $objDatos;

      $idUniversity = existUniversity($person[2]);
      if($idUniversity==0){
        $idUniversity = existUniversity($person[2]);
      }

      $idBirthplace = existPlace($person[5]);
      if($idBirthplace==0){
        $idBirthplace = existPlace($person[5]);
      }

     $sql ="UPDATE teacher SET number_document='".$person[8]."', name='".$person[0]."',
             email='".$person[1]."', birthdate='".$person[3]."', number_phone='".$person[6]."', nickname='".$person[7]."',
             id_birthplace='".$idBirthplace."',id_university='".$idUniversity."',gender='".$person[4]."', id_type_document='".$person[9]."'
             WHERE number_document='".$person[8]."';";
             $objDatos->executeQuery($sql);
             $objDatos->closeConnect();
             echo "Se actualizo correctamente";

 }


 function deleteTeacher($number_document){
   global $objDatos;
   $consulta = "DELETE FROM teacher WHERE number_document = '$number_document'";
   $teacher = $objDatos->executeQuery($consulta);
   $objDatos->closeConnect();
   echo "Se ha eliminado el usuario correctamente";
  }


  function activationUser($number_document){
    global $objDatos;
    $sql ="UPDATE teacher SET state_system='Activo'
            WHERE number_document='".$number_document."';";
            $objDatos->executeQuery($sql);
            enviarEmail($number_document);
            $objDatos->closeConnect();
            return 1;

  }

  function desactivationUser($number_document){
    global $objDatos;
    $sql ="UPDATE teacher SET state_system='Inactivo'
            WHERE number_document='".$number_document."';";
            $objDatos->executeQuery($sql);
            $objDatos->closeConnect();
            return 2;

  }

  function enviarEmail($number_document){
    global $objDatos;
    $sql = "SELECT email as e , name  as na FROM teacher
            WHERE number_document='".$number_document."';";
             $crud = $objDatos->executeQuery($sql);
    $email= "21sebas12@gmail.com";//$crud[0]['e'];
    $name = $crud[0]["na"];
    $mensage = "Su cuanta de usuario ya ha sido activada por el administrador\nzMuchas gracias:".$name;
    $asunto="Activado en Chaea UNAL";
    // mail($email,$asunto, $mensage);
    mail($email,$asunto, $mensage);

  }

  //no se puede generalizar porque los atributos cambian de posición
    function  controlInsUpdaAdmin($tracing, $person){
      if($tracing[0]['number_document']!=1){$confirdocument = existDocument($person[8]);}else{$confirdocument=1;};
        if($confirdocument == 1 ){
          if($tracing[0]['email']!=1){$confirmemail = existemail($person[1]);}else{$confirmemail=1;};

                  if($confirmemail==1){
                      if($tracing[0]['nickname']!=1){$confirmnickname = exist($person[7]);}else{$confirmnickname=1;};

                      if($confirmnickname  == 1 ){
                          updateTeacher($person);
                       }else{
                         echo "El nombre de usuario '$person[7]' ya está siendo utilizado<br>
                               no es posible actualizar el usuario.";
                       }
               } else {
                 echo "Ya existe una cuenta de usuario con el correo : ".$person[1]."<br>
                       no es posible actualizar el usuario.";
               }
           }else{echo "Ya existe una cuenta de usuario que registra con el documento : ".$person[8]."<br>
                 no es posible actualizar el usuario.";}
      }
  ?>
