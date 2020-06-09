<main class="detalle">
<br><nav class="navbar navbar-default">
<style media="screen">
.navbar-toggle {
  position: relative;
  float: right;
  margin-right: 15px;
  padding: 9px 10px;
  margin-top: 8px;
  margin-bottom: 8px;
  background-color: rgb(15, 122, 6);
  background-image: none;
  border: 1px solid rgb(15, 122, 6);
  border-radius: 0;
}
.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
    text-decoration: none;
    color: #ffffff;
    background-color: #222222;
}


main.detalle ol li {
    border-bottom: 1px dotted #222222;
    font-size: 1.3em;
    line-height: 1.5em;
    /* padding-bottom: 10px; */
    padding-top: 10px;
    background: #222222;
    text-align: left;
    color: white;
}
.dropdown-menu>li>a {
    color: #3e3c3c;
}

</style>

  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		 <ul class="nav navbar-nav">
				<!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
				<li>
					<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Conocenos<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/chaea/index.php"  role="button">Proyecto</a></li>
						<li><a href="/chaea/objetivos.php"  role="button">Objetivos</a></li>
						<li><a href="/chaea/resultados.php"  role="button">Resultados<BR>Esperados</a></li>
						<li><a href="/chaea/productos.php"  role="button">Productos<BR>Académicos</a></li>
						<li><a href="/chaea/equipo.php"  role="button">Equipo de<BR>Trabajo</a></li>
					</ul>
				</li>
        <li>
          <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cartillas<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/chaea/partials/cartilla/activo.php"  role="button">Activo</a></li>
            <li><a href="/chaea/partials/cartilla/reflexivo.php"  role="button">Reflexivo</a></li>
            <li><a href="/chaea/partials/cartilla/teorico.php"  role="button">Teórico</a></li>
            <li><a href="/chaea/partials/cartilla/pragmatico.php"  role="button">Pragmático</a></li>
          </ul>
        </li>

					<li><a class="btn btn-default dropdown-toggle" href="/chaea/test.php"  role="button">Test Chaea</a></li>
          <!-- <li><a class="btn btn-default dropdown-toggle" href="questionChaea.php"  role="button">Test Chaea Me</a></li> -->

			</ul>

      <ul class="nav navbar-nav navbar-right btn-un ">
				<li><a class="btn  btn-un navbar-right  dropdown-toggle " href="/chaea/contacto.php"  role="button">Contactanos</a></li>
        <!-- Coloco el nickname del perfil -->
        <a id="perfil"></a>
        <li>
             <a href="#" class="btn  dropdown-toggle btn-un " data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i><span class="caret"></span></a>
	            <ul class="dropdown-menu" role="menu">
	            <li id="inis"><a href="/chaea/logingIndex.php">Iniciar sesión</a></li>
              <li><a id="regist" href="/chaea/registration.php">Registrarse</a></li>
          	</ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</main >
