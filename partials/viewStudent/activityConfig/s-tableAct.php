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



 </script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >
<div>

</div>
      <table id="dataTableActiCouStudent" cellpadding="0" cellspacing="0" border="0" class="dataTable">
        <thead id="cap">
          <tr>
            <th><center>ID</center></th>
            <th><center>Nombre de la actividad</center></th>
            <th><center>Detalle de actividad</center></th>
            <th><center>Estilo de aprendizaje</center></th>
            <th><center>Porcentaje %</center></th>
            <th><center>Descargar Actividad</center></th>
            <th><center>Desarrollo</center></th>
          </tr>
        </thead>
    	</table>


<br>

<div class="pull-right">
  <h5><div id="entire"></div></h5>
</div>


</body>
