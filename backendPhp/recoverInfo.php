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
      $sql = "SELECT co.id_course as id from  course as co
      WHERE replace(LOWER('".$course."'),' ','') = replace(LOWER(co.name_course),' ','')
      and co.number_document = '".$_SESSION["document"]."';";
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
            return 0;
          }else{
            return $crud;
          }

  } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
  }
}
//saca todas las actividades que tiene el curso
function activityCourse($idCourse){
  try {
          global $objDatos;
          $sql = "SELECT ac.id_activity as id_ac
          FROM activity as ac
          WHERE ac.id_course='".$idCourse."';";
          $crud = $objDatos->executeQuery($sql);

          if($crud[0]['id_ac'] < 1){
            return 0;
          }else{
            return $crud;
          }

  } catch (Exception $e) {
      echo 'Existe un fallo en la conexión';
  }
}

//Miro si existe la tematica del mismo nombre y con el mismo usuario.
function existThematic($thematic){
    try {
          global $objDatos;
          $sql = "SELECT them.id_thematic as id_thematic
                  FROM thematic as them, teacher as te, course_teacher as co_te, course as co
                  WHERE te.number_document = '".$_SESSION["document"]."'
                  and te.number_document = co_te.number_document
                  and co_te.id_course = co.id_course
                  and co.id_course = '".$thematic[1]."'
                  and co.id_course = them.id_course
                  and  replace(LOWER('".$thematic[0]."'),' ','') = replace(LOWER(them.description),' ','')
                  group by id_thematic;";
            $crud = $objDatos->executeQuery($sql);

            if($crud[0]['id_thematic'] < 1){
              return 0;
            }else{
              return $crud[0]['id_thematic'];//retornar el ID
            }

    } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
    }
}
//Miro si existe la actividad del mismo nombre y con el mismo usuario.
function existActivity($activity){
    try {
          global $objDatos;
          $sql = "SELECT act.id_activity as id_activity, act.id_type_learning as act_lear, act.id_performance as id_per
                FROM activity as act, teacher as te, course_teacher as co_te, course as co
                WHERE te.number_document= '".$_SESSION["document"]."'
                and te.number_document = co_te.number_document
                and co_te.id_course = co.id_course
                and co.id_course = '".$activity[3]."'
                and co.id_course = act.id_course
                and replace(LOWER('".$activity[0]."'),' ','') = replace(LOWER(act.name_activity),' ','')
                and act.id_type_learning = '".$activity[1]."'
                and id_performance = '".$activity[7]."'
                group by  id_activity, act_lear, id_per
                order by id_activity;";
            $crud = $objDatos->executeQuery($sql);

            if($crud[0]['id_activity'] < 1){
              return 0;
            }else{
              return $crud[0]['id_activity'];//retornar el ID
            }

    } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
    }
}

//Miro si existe la actividad del mismo nombre y con el mismo usuario.
function existActivityBase($activity){
    try {
          global $objDatos;
          $sql = "SELECT act.id_activity as id_activity, act.id_type_learning as act_lear
                FROM activity as act, teacher as te, course_teacher as co_te, course as co
                WHERE te.number_document= '".$_SESSION["document"]."'
                and te.number_document = co_te.number_document
                and co_te.id_course = co.id_course
                and co.id_course = '".$activity[3]."'
                and co.id_course = act.id_course
                and  replace(LOWER('".$activity[0]."'),' ','') = replace(LOWER(act.name_activity),' ','')
                group by  id_activity, act_lear ;";
            $crud = $objDatos->executeQuery($sql);

            if($crud[0]['id_activity'] < 1){
              return 0;
            }else{
              return $crud[0]['id_activity'];//retornar el ID
            }

    } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
    }
}


function weightActivity($activity ,$id_activity){
  global $objDatos;
  $sql =" SELECT   te_ac.weight as te_we
          FROM activity as act, teacher_activity as te_ac
          WHERE te_ac.number_document= '".$_SESSION["document"]."'
          and te_ac.id_activity = '".$id_activity."'
          and  replace(LOWER('".$activity[0]."'),' ','') = replace(LOWER(act.name_activity),' ','')
          group by  te_we;";
          $we = $objDatos->executeQuery($sql);
          return $we[0]['te_we'];//retornar el porcenta
}

function studentCourse($id_course){
  try {
    global $objDatos;
    $consulta = " SELECT st.number_document AS id_st, st_sty.activo as ac,
                  st_sty.reflexivo as re, st_sty.teorico as te, st_sty.pragmatico as pa
                  FROM student as st
                  inner join course_student
                  on st.number_document = course_student.number_document
                  inner join course as co
                  on course_student.id_course = co.id_course
                  and co.id_course = '".$id_course."'
                  inner join student_style_point as st_sty
                  on st_sty.number_student = st.number_document
                  group by id_st,ac, re, te, pa
                  order by id_st;";
    $crud = $objDatos->executeQuery($consulta);
      for ($i=0; $i < COUNT($crud) ; $i++) {
        $a=0;
        $V[$i] = array("ac"=>$crud[$i]['ac'],"re"=>$crud[$i]['re'],"te"=>$crud[$i]['te'],"pa"=>$crud[$i]['pa']);
        arsort($V[$i]);//ordena el vector
        foreach ($V[$i] as $key => $val) {
          if($a<=$val){
            $a=$val;
            $V2[$i][$key]=$val;
          }
        }
      }

    for ($i=0; $i < COUNT($crud); $i++) {
      $V2[$i]['id_st']=$crud[$i]['id_st'];
      foreach ($V2[$i] as $key => $val) {
      }
    }
    return $V2;
  } catch (Exception $e) {

  }


}


//Miro si existe la actividad del mismo nombre y con el mismo usuario.
function existStrategy($strategy){
    try {
          global $objDatos;
          $sql = "SELECT str.id_strategy as id
                  FROM strategy as str
                  WHERE replace(LOWER(str.description),' ','')=  replace(LOWER( '".$strategy[0]."'),' ','')
                  AND str.id_type_learning = '".$strategy[1]."' ;";
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

//funcion que activa estudiante si esta Inactivo

function  studentActiveSystem($idStudent){
    try {
          global $objDatos;
          $sql = "UPDATE student SET state_system ='Activo'
                  WHERE number_document ='".$idStudent."'
                  AND state_system = 'Inactivo';";
            $crud = $objDatos->executeQuery($sql);
            //ENVIAR EMAIL!!
    } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
    }
}

//sacar estilos de aprendizaje
function studentStyle(){
    $V2 = array(); $a=0;
    global $objDatos;
    $sql = "SELECT activo as ac, reflexivo as re, teorico as te, pragmatico as pa
            FROM student_style_point
            WHERE number_student = '".$_SESSION["document"]."';";
    $crud = $objDatos->executeQuery($sql);
    $V = array("ac"=>$crud[0]['ac'],"re"=>$crud[0]['re'],"te"=>$crud[0]['te'],"pa"=>$crud[0]['pa']);
    arsort($V);
    foreach ($V as $key => $val) {
      if($a<=$val){
            $a=$val;
            $V2[$key]=$val;
          }
      }


      $_SESSION['style']=$V2;
}

function extencion($ex){
  $extencion = array("doc", "pdf", "docx","jpg", "gif", "png","xlsx","zip");
  for ($i=0; $i < count($extencion); $i++) {
    if($ex==$extencion[$i]){
      return 1;
    }
  }
}


function  urlActivity(){
    try {
          $url='chaea'.$_SESSION["urlFiles"];
          global $objDatos;
          $sql = "UPDATE student_activity SET activity_path ='".$url."'
                  WHERE id_activity ='".$_SESSION["id_activity"]."'
                  AND number_document  = '".$_SESSION["document"]."';";
            $crud = $objDatos->executeQuery($sql);

    } catch (Exception $e) {
        echo 'Existe un fallo en la conexión';
    }
}
?>
