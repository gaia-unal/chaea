<?php
session_start();
if(!$_SESSION){
  header ("Location:/chaea/logingIndex.php");
}else if (("teacher"!=$_SESSION["rol"])) {
  header ("Location:/chaea/logingIndex.php");
}
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/head.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/analyticstracking.php');

?>

<body id="table">

<?php include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav/navTeacherController.php');?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >
<!-- <link href="/chaea/css/style/varControl.css" rel="stylesheet" /> -->
<div id="particles-js"></div>
<main class="detalle">
  <div id="table-box" >
   <div>
     <div class="">
       <a id="addCoruse" class="btn btn-success btn-circle"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
       <br>Agregar Curso
     </div>
      <table id="dataTableCourseTeacher">
        <thead id="cap">
            <tr>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>id</th>
                <th>Nombre del curso</th>
                <th>Detalle del curso</th>
                <th>Total de Cupos</th>
                <th># Estudiantes Activos</th>
                <th>Cupos Disponibles</th>
                <th># Estu. q Solicitan </th>
                <th># Actividades creadas</th>
            </tr>
        </thead>
    	</table>
    </div>
    <?php

    include(__DIR__.'/../modal/modalDelete.php');
    include(__DIR__.'/../modal/modalDesactivationCourse.php');
    include(__DIR__.'/../modal/modalEditCourse.php');
    include(__DIR__.'/../modal/modalAddCourse.php');
    include(__DIR__.'/../modal/modalError.php');
    include(__DIR__.'/../modal/modalInfo.php');
    include(__DIR__.'/../modal/modalInfoCourse.php');


    ?>
  </div>

</main>

<!-- Fin de la configuracion -->
<!-- Carga la info de la tabla -->
<script src="/chaea/js/jsn/courseSettings/courseTableTeacher.js" charset="utf-8"></script><!--este es JSN-->
<!-- Carga el funcionamiento de tabla -->
<!-- Este tiene las funcionalidades CRUD de la tabla -->
<!--este es JSN-->
<script src="/chaea/js/jsn/courseSettings/courseTableCrud.js" charset="utf-8"></script>
<!-- FIN CRUD -->
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!--Este es JSN-->
<script src="/chaea/js/jsn/controlForm.js"></script>
</body>

<?php
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/sessionJS.php');
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
