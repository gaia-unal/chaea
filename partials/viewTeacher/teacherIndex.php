<?php
session_start();

if(!$_SESSION){
  header ("Location: /chaea/logingIndex.php");
}else if (("teacher"!=$_SESSION["rol"])) {
  header ("Location: /chaea/logingIndex.php");
}
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/head.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav.php');

?>
<!-- Tablas -->

<body>

<?php
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav/navTeacherController.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/viewTeacher/profileTeacher.php');
?>
<div id="particles-js"></div>
<!-- Configura la parte de consulta AJAX para la carga de datos en el formulario
se hace .js por ROL -->
<script src="/chaea/js/jsn/teacherSettings/teacherCrud.js"></script>
<!-- Fin -->
<script src="/chaea/js/jsn/controlForm.js"></script><!--Este es JSN-->
</body>

<?php
include($_SERVER["DOCUMENT_ROOT"].'/chaea/funcionesphp/sessionJS.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
