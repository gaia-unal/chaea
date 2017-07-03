<?php
session_start();
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
$action= array_key_exists("action", $_POST) ? $_POST["action"] : null;
$person = json_decode(array_key_exists("person", $_POST) ? $_POST["person"] : null);
switch ($action) {
  case 1:
    $_SESSION["email_up"] = $person[1];
    $_SESSION["document_up"] = $person[7];
    $_SESSION["nickname_up"] = $person[6];
    $_SESSION["password_up"]= $_SESSION["password"];
    $tracing = validationRol("teacher");
    controlInsUpdaAdmin($tracing,$person);
    break;

  default:
    getTeahcer();
    break;
}

?>
<?php
    function getTeahcer(){
        global $objDatos;
        $consulta = "SELECT rol.number_document, rol.id_type_document,
        rol.name, bir.name_birthplace, rol.birthdate, u.name_university,
        rol.email, rol.number_phone, rol.nickname, rol.gender
                     FROM teacher as rol, birthplace as bir, university as u
                     where rol.number_document = '".$_SESSION["document"]."'
                     and rol.id_birthplace = bir.id_birthplace
                     and rol.id_university = u.id_university;";
        $administrator = $objDatos->executeQuery($consulta);
        $objDatos->closeConnect();
        echo ''.json_encode($administrator).'';
    }


    function updateAdministrator($person){
      global $objDatos;
        $idUniversity = existUniversity($person[9]);
        if($idUniversity==0){
          $idUniversity = existUniversity($person[9]);
        }

         $idBirthplace = existPlace($person[4]);
         if($idBirthplace==0){
           $idBirthplace = existPlace($person[4]);
         }

        $sql ="UPDATE teacher SET number_document='".$person[7]."', name='".$person[0]."',
                email='".$person[1]."', birthdate='".$person[2]."',
                number_phone='".$person[5]."', nickname='".$person[6]."',
                id_university = '".$idUniversity."',id_birthplace='".$idBirthplace."',
                gender='".$person[3]."', id_type_document='".$person[8]."'
                WHERE number_document= '".$_SESSION['document']."';";
                  $objDatos->executeQuery($sql);
                    $_SESSION['document']= $person[7];
                $objDatos->closeConnect();
                echo "Se actualizo correctamente";

    }

//no se puede generalizar porque los atributos cambian de posición
  function  controlInsUpdaAdmin($tracing, $person){
      // echo $tracing[0]['email']." ".$tracing[0]['nickname']." ".$tracing[0]['number_document'];

    if($tracing[0]["number_document"]!=1){$confirdocument = existDocument($person[7]);}else{$confirdocument=1;};
      if($confirdocument == 1 ){
        if($tracing[0]["email"]!=1){$confirmemail = existemail($person[1]);}else{$confirmemail=1;};

                if($confirmemail==1){
                      if($tracing[0]["nickname"]!=1){$confirmnickname = exist($person[6]);}else{$confirmnickname=1;};


                    if($confirmnickname  == 1 ){
                        updateAdministrator($person);
                     }else{
                       echo "El nombre de usuario ".$person[6]." ya está siendo utilizado.";
                     }
             } else {
               echo "Ya existe una cuenta de usuario con el correo : ".$person[1];
             }
         }else{echo "Ya existe una cuenta de usuario que registra con el documento : ".$person[7];}
    }
 ?>
