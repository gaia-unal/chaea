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

  <table id="dataTableStudentTraking" cellpadding="0" cellspacing="0" border="0" class="dataTable">
    <thead id="cap">
      <tr>
        <th><center>Seleccionar</center></th>
        <th><center>Documento</center></th>
        <th><center>Nombre</center></th>
        <th><center>Nota acumulada</center></th>
      </tr>
    </thead>
  </table>


<br>


<!-- Fin de la configuracion -->
<!-- Carga la info de la tabla -->
<script src="/chaea/js/jsn/studentSettings/t-trackingStudentTable.js" charset="utf-8"></script><!--este es JSN-->
<!-- Carga el funcionamiento de tabla -->
<!-- Este tiene las funcionalidades CRUD de la tabla -->
<!--este es JSN-->
<script src="/chaea/js/jsn/activitySettings/t-actiTableCrud.js" charset="utf-8"></script>
<!-- FIN CRUD -->
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!--Este es JSN-->
<script src="/chaea/js/jsn/controlForm.js"></script>
</body>
