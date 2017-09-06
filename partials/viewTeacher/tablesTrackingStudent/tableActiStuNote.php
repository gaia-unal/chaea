<?php
if(!isset($_SESSION)) {
     session_start();
}
if(!$_SESSION){
  header ("Location:/chaea/logingIndex.php");
}else if (("teacher"!=$_SESSION["rol"])) {
  header ("Location:/chaea/logingIndex.php");
}
?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >

 <div>
    <table id="dataTableStudentTrakingAc" cellpadding="0" cellspacing="0" border="0" class="dataTable">
      <thead id="cap">
        <tr>
          <th><center>id</center></th>
          <th><center>Actividad</center></th>
          <th><center>Archivo</center></th>
          <th><center>Editar Nota</center></th>
          <th><center>Nota</center></th>
          <th><center>Porcentaje</center></th>
        </tr>
      </thead>
    </table>
  </div>
    <?php include(__DIR__.'/../../modal/modalEditAcNote.php'); ?>



<br>


<!-- Fin de la configuracion -->
<!-- Carga la info de la tabla -->
<script src="/chaea/js/jsn/studentSettings/t-trackingStudentTableAc.js" charset="utf-8"></script><!--este es JSN-->
<!-- Carga el funcionamiento de tabla -->
<!-- Este tiene las funcionalidades CRUD de la tabla -->
<!--este es JSN-->
<!-- <script src="/chaea/js/jsn/studentSettings/t-trackingStudentTableCrud.js" charset="utf-8"></script> -->



<!-- FIN CRUD -->
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!--Este es JSN-->
<script src="/chaea/js/jsn/controlForm.js"></script>
</body>
