<?php
if(!isset($_SESSION)) {
     session_start();
}
do{
	echo key($_SESSION).": ";
	echo "-->".current($_SESSION)."----";
} while(next($_SESSION));


// var_dump($_SESSION['style']);

 ?>

<script>
var act = [''];
var band=0;
var c1 = ['A','B','C','D','A','B'];
var c2 = ['1','2','3','4','5','6'];

for (var i = 0; i < c1.length; i++) {
  for (var j = 0; j < act.length; j++) {
    if (act[j]==c1[i]) {
      band=1;
    }
  }
  if(band!=1){
    if(act[0]==''){
      act[0]=c1[i];
    }else{act.push(c1[i]);}
  }
}
console.log(act);

</script>
<?php
require_once("/backendPhp/conexion.php");
$objDatos = new DB();
$objDatos->connect();

// $person= array(0,"jsnavarroc@unal.edu.co", 2, 3, 4, 5,"jsnavarroc","1053813532");
// validationRol($person, "teacher");
// activityStudent('1053845616', '33');
// $courses = courseInscriptionStudent();
// echo "<br> Valor: ".count($courses);
// UrlActivity();
// studentStyle();

sumPoceActivity(2);
function sumPoceActivity($id_course){
            global $objDatos;
                  $consulta = "	SELECT  tea_act.weight as weight,
                                act.name_activity AS name_act,
                                tyl.id_type_learning as ty
                                FROM activity as act
                                inner join type_learning as tyl
                                on tyl.id_type_learning = act.id_type_learning
                                inner join teacher_activity as tea_act
                                on '".$_SESSION["document"]."'= tea_act.number_document
                                and tea_act.id_activity = act.id_activity
                                inner join course as co
                                on co.id_course =  '".$id_course."'   and co.id_course = act.id_course
                                group by weight,  name_act, ty
                                order by name_act;";
                            $activity = $objDatos->executeQuery($consulta);
                            $objDatos->closeConnect();
                $act = [''];
                $total= 0;

                for ($i = 0; $i < count($activity); $i++) {
                  $band=0;
                    for ( $j = 0; $j < count($act); $j++) {
                      echo '<br>'.($act[$j].'=='.$activity[$i]['name_act']).'<br>';
                      if ($act[$j]==$activity[$i]['name_act']) {
                        $band=1;
                      }
                    }
                    if($band!=1){
                        if($act[0]==''){
                          $act[0]=$activity[$i]['name_act'];
                          $total=$total + $activity[$i]['weight'];
                          echo '<br>'.$act[0].'<br>';
                        }else{
                          array_push($act,$activity[$i]['name_act']);
                          echo '<br>'.$activity[$i]['name_act'].'<br>';
                          $total=$total + $activity[$i]['weight'];
                        }

                    }
              }//fin for
                // var_dump($activity);
            echo $total;

    }





function studentStyle(){

  global $objDatos;
  $consulta = " SELECT st.number_document AS id_st, st_sty.activo as ac,
                st_sty.reflexivo as re, st_sty.teorico as te, st_sty.pragmatico as pa
                FROM student as st
                inner join course_student
                on st.number_document = course_student.number_document
                inner join course as co
                on course_student.id_course = co.id_course
                and co.id_course = '2'
                inner join student_style_point as st_sty
                on st_sty.number_student = st.number_document
                group by id_st,ac, re, te, pa
                order by id_st;";
  $crud = $objDatos->executeQuery($consulta);
            $objDatos->closeConnect();
    for ($i=0; $i < COUNT($crud) ; $i++) {
      $a=0;
      # code...
      $V[$i] = array("ac"=>$crud[$i]['ac'],"re"=>$crud[$i]['re'],"te"=>$crud[$i]['te'],"pa"=>$crud[$i]['pa']);
      arsort($V[$i]);//ordena el vector
echo '<br><br>';
      foreach ($V[$i] as $key => $val) {
        echo '<br>|'.$key.'|<-->|'.$val.'|';
        if($a<=$val){
          $a=$val;
          $V2[$i][$key]=$val;
        }
      }
      echo '<br><br>';
    }

  for ($i=0; $i < COUNT($crud); $i++) {
    $V2[$i]['id_st']=$crud[$i]['id_st'];
    echo "<br><br>".$i."<br><br> ";
    foreach ($V2[$i] as $key => $val) {
      echo  '<dd>'.$key.'-->'.$V2[$i][$key];
    }
    echo "<br><br>";
  }

}


function UrlActivity(){
  global $objDatos;
  $consulta = "  SELECT activity_path as url
            FROM student_activity as st_act
	          WHERE number_document = '910436652'
	          and id_activity = '3';";
  $url = $objDatos->executeQuery($consulta);
            $objDatos->closeConnect();
            $url1='/'.$url[0]['url'];
            $url = $_SERVER['DOCUMENT_ROOT'].'/'.$url[0]['url'];
            listFiles($url, $url1);
}

//Creamos Nuestra Función
  function listFiles($directorio, $url1){ //La función recibira como parametro un directorio
    if (is_dir($directorio)) { //Comprovamos que sea un directorio Valido
      if ($dir = opendir($directorio)) {//Abrimos el directorio

        echo '<ul>'; //Abrimos una lista HTML para mostrar los archivos

        while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo

          if ($archivo != '.' && $archivo != '..'){//Omitimos los archivos del sistema . y ..

            $nuevaRuta = $directorio.$archivo.'/';//Creamos unaruta con la ruta anterior y el nombre del archivo actual

            echo '<li>'; //Abrimos un elemento de lista

              if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un directorio entonces:
                echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
                  listFiles($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese directorio.

              } else { //si no es un directorio:
                echo $url1.$archivo.'<br>';
                echo 'Archivo: <a href="'.$url1.$archivo.'">'.$archivo.'</a><b><br>'; //simplemente imprimimos el nombre del archivo actual
              }

            '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo

          }

        }//finaliza While
        echo '</ul>';//Se cierra la lista

        closedir($dir);//Se cierra el archivo
      }
    }else{//Finaliza el If de la linea 12, si no es un directorio valido, muestra el siguiente mensaje
      echo 'No Existe el directorio';
    }
  }//Fin de la Función

  //Llamamos a la función y le pasamos el nombre de nuestro directorio.
  // listFiles("./files/");

function courseInscriptionStudent(){
    global $objDatos;
    $consulta = " SELECT co.id_course as idco,
                  co.description_course as dc,
                  co.name_course as namco,
                  co_st.number_document
                  From course  as co
                  Left Outer Join course_student as co_st
                  ON  co.id_course = co_st.id_course
                  where co.state_system_course = 'Activo'
                  AND co_st.number_document = '".$_SESSION["document"]."'
                  order by co.id_course;";
    $course = $objDatos->executeQuery($consulta);
              $objDatos->closeConnect();
              return $course;
  }


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
