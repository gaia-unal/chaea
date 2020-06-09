<?php
if(!isset($_SESSION)) {
     session_start();
}
if(!$_SESSION){
  header ("Location: /chaea/logingIndex.php");
}else if (("student"!=$_SESSION["rol"])) {
    header ("Location: /chaea/partials/viewStudent/studentIndex.php");
}
  require_once($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/conexion.php');
  $objDatos = new DB();
  $objDatos->connect();
 require_once($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/recoverInfo.php');
?>
<?php
    //nombre del archivo
    $namefile = $_FILES['fileActivity']['name'];
    $ex = explode(".",$namefile)[1];
    //nombre de la ruta en la que almacena temparalmente el archivo
    $tmp_name = $_FILES["fileActivity"]["tmp_name"];



    //nombre de la carpeta raiz
    $vowels = array(":", "'\'", "'/'" , "*", "?", "<", ">", "|");
    $error=0;
    $url = $_SESSION["urlFiles"];
    $url = str_replace($vowels, "", $url);
    $error=extencion($ex);
    $url= __DIR__."/../../".$url;
    $url = preg_replace('[\s+]',"", $url);



  if($error==1){
    // Mira si la no ruta existe
    if (!file_exists($url)) {
    //Si no existe la ruta la crea con el MKDIR
      if(mkdir($url, 0777, true)){
        // función de guardar BD ruta directa al archivo;
        load($url, $tmp_name, $namefile);
      }else{
        unset( $_SESSION["band"] );
        echo "No se creo la carpeta";
      }
    }else{
      load($url, $tmp_name, $namefile);
    }
  }else{
    unset( $_SESSION["band"] );
  }


  function load($url, $tmp_name, $namefile){
    if($namefile!=null){
        //nombre del archivo a subir
      	$nombre_final = explode(".",$namefile)[0];
        //saca la extencion del archivo .jpg,.png,.word, etc...
      	$extension = explode(".",$namefile)[1];

        //Nombre ruda con el archivo "ruta directa"
        $nombre_ruta_archivo = $url.'/'.$nombre_final.'.'.$extension;

        if(!file_exists($nombre_ruta_archivo)){

                if (move_uploaded_file($tmp_name, $nombre_ruta_archivo)){
                  echo "4";
                  urlActivity();
                  unset( $_SESSION["urlFiles"] );
                  // se guarda ruta bd
                }else{
                  echo "4";
                }

          }else{

                if(isset($_SESSION["band"])){
                  if($_SESSION["band"]==1){
                        if (move_uploaded_file($tmp_name, $nombre_ruta_archivo)){
                          echo "4";
                          unset( $_SESSION["urlFiles"] );
                          unset( $_SESSION["band"] );

                        }else{
                          echo "Ocurrió algún error al subir el fichero. No pudo guardarse.<br>";
                        }
                    }else{;
                      unset( $_SESSION["band"]);
                    }
                }else{
                  unset( $_SESSION["band"]);
                  echo 1;
                }
          }

    }else{
      echo "2";//no ha seleccionado ningún archivo.
    }
}

 ?>
