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


<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >
<link href="/chaea/css/style/varControl.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >

<style media="screen">
  #table-box{
    margin-top: 0% !important;
  }
</style>
<body id="table">
  <div id="particles-js"></div>
    <main class="detalle">
      <div id="table-box" >
        <?php  include(__DIR__.'/../viewStudent/navControlStudent.html');?>
         <div>
            <table id="dataTableCouStuDelete" cellpadding="0" cellspacing="0" border="0" class="dataTable">
              <thead id="cap">
                  <tr>
                    <th><center>ID</center></th>
                    <th><center>Eliminar</center></th>
                    <th><center>Curso</center></th>
                    <th><center>Descripción</center></th>
                  </tr>
                </thead>
            	</table>
            <br><br>
            <div class=" pull-right" id="infoCuourseIns"></div>
          </div>
          <?php
          include(__DIR__.'/../modal/modalError.php');
          include(__DIR__.'/../modal/modalInfoElement.php');
          include(__DIR__.'/../modal/modalInfo.php');
          include(__DIR__.'/../modal/modalDelete.php');
          ?>
        </div>
    </main>



</body>
<!-- Carga la info de la tabla -->
<script src="/chaea/js/jsn/courseSettings/s-tableCourseDelete.js" charset="utf-8"></script><!--este es JSN-->
<!-- Este tiene las funcionalidades CRUD de la tabla -->
<script src="/chaea/js/jsn/courseSettings/s-CourseCrudIns.js" charset="utf-8"></script>
<!-- FIN CRUD -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!--Este es JSN-->
<script src="/chaea/js/jsn/controlForm.js"></script>
<?php
include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/sessionJS.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
