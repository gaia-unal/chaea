<?php
if(!isset($_SESSION)) {
     session_start();
}
if(!$_SESSION){
  header ("Location:/chaea/logingIndex.php");
}else if (("student"!=$_SESSION["rol"])) {
  header ("Location:/chaea/logingIndex.php");
}
?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >

  <table id="dataTableStudentTraking" cellpadding="0" cellspacing="0" border="0" class="dataTable">
    <thead id="cap">
      <tr>
        <th><center>ID</center></th>
        <th><center>Nombre Actividad</center></th>
        <th><center>Nota</center></th>
        <th><center>Porcentaje</center></th>
      </tr>
    </thead>
  </table>


<br>


<!-- Fin de la configuracion -->
<!-- Carga la info de la tabla -->
<script src="/chaea/js/jsn/studentSettings/s-trackingStudentTable.js" charset="utf-8"></script><!--este es JSN-->
<!-- Carga el funcionamiento de tabla -->

<!-- FIN CRUD -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!--Este es JSN-->
<script src="/chaea/js/jsn/controlForm.js"></script>
</body>
