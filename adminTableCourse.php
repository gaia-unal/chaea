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

<body>

<?php include('partials/nav/navAdminController.php');?>
<?php include('partials/viewCourseAdmin/tableCourse.php');?>

<script src="js/jsn/courseSettings/courseTable.js" charset="utf-8"></script><!--este es JSN-->
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="js/jsn/adminSettings/navigationAdmin.js"></script><!--Este es JSN-->
</body>

<?php
include_once("analyticstracking.php");
include('backendPhp/sessionJS.php');
include('partials/pie.html');
?>
