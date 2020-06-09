
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >
<link href="/chaea/css/style/varControl.css" rel="stylesheet" />
      <table id="dataTableCouStu" cellpadding="0" cellspacing="0" border="0" class="dataTable">
        <thead id="cap">
          <tr>
            <th><center>ID</center></th>
            <th><center>Inscribir</center></th>
            <th><center>Curso</center></th>
            <th><center>Descripción</center></th>
          </tr>
        </thead>
    	</table>


<br>


<?php
    include(__DIR__.'/../modal/modalError.php');
    include(__DIR__.'/../modal/modalInfoElement.php');
?>
<!-- Carga la info de la tabla -->
<script src="/chaea/js/jsn/courseSettings/s-tableCourse.js" charset="utf-8"></script>
<!-- Este tiene las funcionalidades CRUD de la tabla -->
<script src="/chaea/js/jsn/courseSettings/s-CourseCrud.js" charset="utf-8"></script>
<!-- FIN CRUD -->
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!--Este es JSN-->
<script src="/chaea/js/jsn/controlForm.js"></script>
</body>
