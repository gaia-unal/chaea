<?php
session_start();

if(!$_SESSION){
  header ("Location: logingIndex.php");
}else if (("administrator"!=$_SESSION["rol"])) {
  header ("Location: logingIndex.php");
}
include('partials/head.php');
include('partials/nav.php');

?>
<!-- Tablas -->

<body>

<?php
include('partials/nav/navAdminController.php');
include('partials/viewAdmin/profileAdmin.php');
?>
<div id="particles-js"></div>
<script src="js/jsn/adminSettings/navigationAdmin.js"></script><!--Este es JSN-->
<script src="js/jsn/adminSettings/adminCrud.js"></script><!--Este es JSN-->
<script src="js/jsn/controlForm.js"></script><!--Este es JSN-->
</body>

<?php
include_once("analyticstracking.php");
include('backendPhp/sessionJS.php');
include('partials/pie.html');
?>
<script src="js/jsn/adminSettings/navigationAdmin.js"></script><!--Este es JSN-->
