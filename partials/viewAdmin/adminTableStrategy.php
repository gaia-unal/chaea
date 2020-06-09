<?php
session_start();

if(!$_SESSION){
  header ("Location: logingIndex.php");
}else if (("administrator"!=$_SESSION["rol"])) {
  header ("Location: logingIndex.php");
}
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/head.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav.php');

?>

<body>

<?php include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav/navAdminController.php');?>

  <body id="table">
  <div id="particles-js"></div>
  <main class="detalle">
    <div id="table-box" >
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
      <div>
        <div class="pull-left">
          <a id="addStrategy" class="btn btn-success btn-circle"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
          <br>Agregar Estrategia
        </div>
      </div>
            <table id="dataTableStrategy" cellpadding="0" cellspacing="0" border="0" class="dataTable">
              <thead id="cap">
                <tr>
                  <th><center>Editar</center></th>
                  <th><center>ID</center></th>
                  <th><center>Estrategia</center></th>
                  <th><center>Estilo</center></th>
                  <th><center>Eliminar</center></th>
                </tr>
              </thead>
          	</table>


      <br>
      <?php
      include(__DIR__.'/../modal/modalAddStrategy.php');
      include(__DIR__.'/../modal/modalDelete.php');
      include(__DIR__.'/../modal/modalEditStrategy.php');
      include(__DIR__.'/../modal/modalInfo.php');
      include(__DIR__.'/../modal/modalError.php');
      ?>
    </div>
  </main>
  </body>
</body>

<?php

include($_SERVER["DOCUMENT_ROOT"].'/chaea/analyticstracking.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/sessionJS.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
<!--Cargo contenido en la tabla  -->
<script src="/chaea/js/jsn/strategySettings/a-StrategyTable.js" charset="utf-8"></script><!--este es JSN-->
<script src="/chaea/js/jsn/strategySettings/strategyCrud.js" charset="utf-8"></script><!--este es JSN-->
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="/chaea/js/jsn/adminSettings/navigationAdmin.js"></script><!--Este es JSN-->
