<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >

<body id="table">
<div id="particles-js"></div>
<main class="detalle">
  <div id="table-box" >
   <div>
      <table id="dataTableCourse">
        <thead id="cap">
            <tr>
                <th>Estado</th>
                <th>id</th>
                <th>Nombre del curso</th>
                <th>Detalle del curso</th>
                <th># Esudiantes inscritos</th>
                <th># Actividades creadas</th>
            </tr>
        </thead>
    	</table>
    </div>
    <?php include(__DIR__.'/../modal/modalInfoCourse.php'); ?>

  </div>
</main>
</body>
