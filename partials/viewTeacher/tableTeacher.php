<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">



<body id="table">
<div id="particles-js"></div>
<main class="detalle">
<div id="table-box" >
      <div class="form-group">
        <input type="button" id="btn_listar" class="btn btn-success" value="Refrescar">
      </div>

       <div  >
        <table id="datatable">
            <thead id="cap">
                <tr>
                    <th>Estado</th>
                    <th>Actualizar</th>
                    <th>Borrar</th>
                    <th>Documento</th>
                    <th>Tipo de documento</th>
                    <th>Nombre </th>
                    <th>Lugar de nacimiento</th>
                    <th>Año de nacimiento</th>
                    <th>Universidad</th>
                    <th>Email</th>
                    <th>Numero telefónico</th>
                    <th>Nombre de usuario</th>
                    <th>Genero</th>
                </tr>
            </thead>
      	</table>
      </div>
      <?php
      include(__DIR__.'/../modal/modalDelete.php');
      include(__DIR__.'/../modal/modalTeacherUpdate.php');
      include(__DIR__.'/../modal/modalInfo.php');
      include(__DIR__.'/../modal/modalError.php');
      ?>
    </div>
</main>
