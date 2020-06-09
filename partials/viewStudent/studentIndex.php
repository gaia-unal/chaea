<?php
  session_start();

  if(!$_SESSION){
    header ("Location: /chaea/logingIndex.php");
  }else if (("student"!=$_SESSION["rol"])) {
    header ("Location: /chaea/logingIndex.php");
  }
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/head.php');
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav.php');
?>
<!-- Tablas -->
<link href="/chaea/css/style/varControl.css" rel="stylesheet" />
<body>

<?php
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/viewStudent/profileStudent.php');
?>
<div id="particles-js"></div>
<!-- Configura la parte de consulta AJAX para la carga de datos en el formulario
se hace .js por ROL -->
<script src="/chaea/js/jsn/studentSettings/studentCrud.js"></script>
<!-- Fin -->
<script src="/chaea/js/jsn/controlForm.js"></script><!--Este es JSN-->
</body>

<?php
include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/sessionJS.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
