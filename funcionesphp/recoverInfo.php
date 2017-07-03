 <?php
 // Se mira si existe la universidad que se esta registrando en el formilario
 //si no existe se agrega. y si esta me da el ID para registrarlo con ese ID
 function existUniversity($university){
     try {
       global $objDatos;
       $sql = "SELECT id_university as un from  university
       WHERE replace(LOWER('$university'),' ','') = replace(LOWER(name_university),' ','')";
       $crud = $objDatos->executeQuery($sql);

       if($crud[0]['un'] < 1){
         $sql = "INSERT INTO university (name_university) values ('$university')";
         $objDatos->executeQuery($sql);
         return 0;
       }else{
         return $crud[0]['un'];//retornar el ID
       }

     } catch (Exception $e) {
         echo 'Existe un fallo en la conexión';
     }
 }

 //Se mira si existe el lugar de nacimiento del registro en el formulario.
 //si no esta se agrega y si esta me da el ID para registrarlo con ese ID
 function existPlace($place){
     try {
       global $objDatos;
       $sql = "SELECT id_birthplace as pl from  birthplace
       WHERE replace(LOWER('$place'),' ','') = replace(LOWER (name_birthplace),' ','')";
       $crud = $objDatos->executeQuery($sql);

       if($crud[0]['pl'] < 1){
         $sql = "INSERT INTO birthplace (name_birthplace) values ('$place')";
         $objDatos->executeQuery($sql);
         return 0;
       }else{
         return $crud[0]['pl'];//retornar el IDplace
       }

     } catch (Exception $e) {
       echo 'Existe un fallo en la conexión';
     }

 }

 //Se mira si existe el programa academico del registro en el formulario.
 //si no esta se agrega y si esta me da el ID para registrarlo con ese ID
 function existProgram($program){
   try {
     global $objDatos;
     $sql = "SELECT id_program as pr from  academic_program
     WHERE replace(LOWER('$program'),' ','') = replace(LOWER(name_program),' ','')";
     $crud = $objDatos->executeQuery($sql);

     if($crud[0]['pr'] < 1){
       $sql = "INSERT INTO academic_program (name_program) values ('$program')";
       $objDatos->executeQuery($sql);
       return 0;
     }else{
       return $crud[0]['pr'];//retornar el IDplace
     }

   } catch (Exception $e) {
     echo 'Existe un fallo en la conexión';
   }

 }

 //FUNCIONES DE REGISTRO
 //_____________________________________________________________________________
 //mira si el Document ya existe en la BD
 function existDocument($attributes){
   try {
     global $objDatos;

     $sql = "SELECT count(st.number_document) as v from  student as st, administrator as ad, teacher as te
     WHERE '$attributes'= st.number_document or '$attributes'= ad.number_document or '$attributes'= te.number_document";
     $crud = $objDatos->executeQuery($sql);

     if($crud[0]['v'] >= 1){
       return 2;
     }else{
       return 1;
     }
     return 1;
   } catch (Exception $e) {
     echo 'Existe un fallo en la conexión';
   }
 }
 // fin

 //mira si el email ya existe en la BD
 function existemail($attributes){
   try {
         global $objDatos;
         $sql = "SELECT count(st.email) as v from  student as st, administrator as ad, teacher as te
         WHERE '$attributes'= st.email or '$attributes'= ad.email or '$attributes'= te.email";
         $crud = $objDatos->executeQuery($sql);

         if($crud[0]['v'] >= 1){
           return 2;
         }else{
           return 1;
         }
         return 1;

   } catch (Exception $e) {
     echo 'Existe un fallo en la conexión';
   }
 }
 // fin

 //mira si el nickname existe en la BD
 function exist($attributes){
     try {
       global $objDatos;
       $sql = "SELECT count(st.nickname) as v from  student as st, administrator as ad, teacher as te
       WHERE '$attributes'= st.nickname or '$attributes'= ad.nickname or '$attributes'= te.nickname";
       $crud = $objDatos->executeQuery($sql);
       if($crud[0]['v'] >= 1){
         return 2;
       }else{
         return 1;
       }

     } catch (Exception $e) {
       echo 'Existe un fallo en la conexión';
     }
 }
 // fin

//Funcion para mirar que no sea de la misma BD
function validationRol ($rol){

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
  return $crud;

}

function passwordRecover($rol,$document){
  global $objDatos;
  $sql = "SELECT password as pas FROM ".$rol."
  WHERE ".$document."= number_document;";
  $crud = $objDatos->executeQuery($sql);
  return $crud[0]['pas'];
}

function nameInstitution($rol){
  global $objDatos;
  $sql = "SELECT u.name_university as uni
  FROM ".$_SESSION['rol']." as rol, university as u
  WHERE  rol.id_university = u.id_university AND nickname = '".$_SESSION['nickname']."'";
  $crud = $objDatos->executeQuery($sql);
  return $crud[0]['uni'];
}

//Miro si existe el curso y si existe regreso le ID si no existe lo crea.
function existCourse($course){
    try {
      global $objDatos;
      $sql = "SELECT id_course as id from  course
      WHERE replace(LOWER('$course'),' ','') = replace(LOWER(name_course),' ','')";
      $crud = $objDatos->executeQuery($sql);

      if($crud[0]['id'] < 1){
        return 0;
      }else{
        return $crud[0]['id'];//retornar el ID
      }

    } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
    }
}

function quotasCourse($idCourse){
  $numActiStudent = numEstudentActi($idCourse);
  global $objDatos;
  //Consulto el # Cupos totales ofertados en el curso
  $sql = "SELECT quotas_course as  numc FROM  course
          WHERE  '".$idCourse."' = id_course;";
  $numQuotas = $objDatos->executeQuery($sql);

  if(intval($numQuotas[0]["numc"])!= "N/A"){
    return (intval($numQuotas[0]["numc"]) - intval($numActiStudent));
  }else{
    return -1;
  }

}
//Saca el numero de estudiantes activos en un curso X.
function numEstudentActi($idCourse){
  global $objDatos;
  $sql = "SELECT count (state_course_student) as nums
          FROM  course_student
          WHERE 'Activo' = state_course_student and '".$idCourse."' = id_course;";
  $numActiStudent = $objDatos->executeQuery($sql);
  return $numActiStudent[0]["nums"];

}

?>
