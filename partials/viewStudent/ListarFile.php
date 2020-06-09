  <?php
      include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/head.php');
      include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav.php');
      include($_SERVER["DOCUMENT_ROOT"].'/chaea/analyticstracking.php');
  ?>
  <!-- No lo tenia  -->
  <link href="/chaea/css/style/varControl.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">
  <link rel="stylesheet" type="text/css" href="/chaea/css/style/slider.css" >
  <link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >

  <style media="screen">
  .leftTextButon {
      margin-left: -49px !important;
  }
  .leftButton {
      margin-left: -16% !important;
  }
  .w3-modal-content {
      margin-top:  42% !important;
  }

  </style>

  <body id="table">
    <div id="particles-js"></div>
      <main class="detalle">
        <div id="table-boxi" >

     <table class="table table-striped table-hover coursePage" >
          <thead>
            <tr>
              <th><center>Archivo</center></th><th><center>Abrir</center></th>
            </tr>
          </thead>
          <tbody>
          <?php  include(__DIR__.'/../viewStudent/navControlStudent.html');?>
              <?php
              $path_ac = $_SESSION["path_ac"];
              // unsset($_SESSION["path_ac"]) ;
              $url = $_SERVER['DOCUMENT_ROOT'].$path_ac;
              $url= preg_replace('[\s+]',"", $url);
              listFiles($url, $path_ac);
                //Creamos Nuestra Función
                function listFiles($directorio, $url1){ //La función recibira como parametro un directorio
                  if (is_dir($directorio)) { //Comprovamos que sea un directorio Valido
                    if ($dir = opendir($directorio)) {//Abrimos el directorio
                      $color = array( 0 => "cano", 1 => "jsn",); $c = 0;
                      while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo

                        echo '<tr class ='.$color[$c].'>'; //Abrimos una lista HTML para mostrar los archivos

                        if ($archivo != '.' && $archivo != '..'){//Omitimos los archivos del sistema . y ..

                          $nuevaRuta = $directorio.$archivo.'/';//Creamos unaruta con la ruta anterior y el nombre del archivo actual

                            if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un directorio entonces:
                              // echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
                                // listFiles($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese directorio.

                            } else { //si no es un directorio
                              echo "<td>".$archivo."</td>"; //Abrimos un elemento de lista
                              echo ''; //Abrimos un elemento de lista
                              echo "<td>
                                      <center>
                                        <a target='_blank' href='".$url1."/".$archivo."'>
                                            <button type='button' id='listActi' class='btn btn-success' >
                                              <i class='fa fa-angle-double-down fa-2x' aria-hidden='true'></i>
                                            </button>
                                        </a>
                                      </center>
                                    </td>";
                            }

                        }
                        echo '</tr>';//Se cierra la lista
                        if ($c == 0) {$c=1;} else {$c=0;}
                      }//finaliza While
                      closedir($dir);//Se cierra el archivo
                    }
                  }else{//Finaliza el If de la linea 12, si no es un directorio valido, muestra el siguiente mensaje
                    echo 'No Existe el directorio';
                  }
                }//Fin de la Función

              ?>
            </tbody>
          </table>
          </div>
       </main>
  </body>

  <!-- Este tiene las funcionalidades CRUD de la tabla -->
  <script type="text/javascript" src="/chaea/js/cookies.js"></script>
  <script src="/chaea/js/jsn/courseSettings/s-CourseCrudIns.js" charset="utf-8"></script>

  <script type="text/javascript" src="/chaea/js/jsn/courseSettings/courActiUpload.js"></script>
  <script  src="/chaea/js/jsn/slider.js" charset="utf-8"></script>
  <!--Este es JSN-->
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <script src="/chaea/js/jsn/controlForm.js"></script>

  <!-- Carga la info de la tabla -->







  <?php
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/sessionJS.php');
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
  ?>
