<?php
if(!isset($_SESSION)) {
     session_start();
} ?>
<!DOCTYPE html>
<html class="no-js ie9 lang_0" id="html" lang="es">
	<head>

		<meta charset="utf-8">

		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
		<link rel="shortcut icon" href="/chaea/images/favicon.ico" type="image/x-icon; charset=binary">
		<title>Universidad Nacional de Colombia: GAIA - Grupo de Ambientes Inteligentes Adaptativos</title>
		<meta name="revisit-after" content="1 hour">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0.5, maximum-scale=2.5, user-scalable=yes">
    <!-- Lo del boton -->
    <!-- <link rel="stylesheet" type="text/css" href="/chaea/css/materialbutton.css" media="all"> -->

		<link rel="stylesheet" type="text/css" href="/chaea/css/style/login.css" media="all">
		<link rel="stylesheet" type="text/css" href="/chaea/css/bootstrap.min.css" media="all">
		<link rel="stylesheet" type="text/css" href="/chaea/css/reset.css" media="all">
		<link rel="stylesheet" type="text/css" href="/chaea/css/unal.css" media="all">
		<link rel="stylesheet" type="text/css" href="/chaea/css/tablet.css" media="only screen and (min-width: 992px) and (max-width: 1199px)">
		<link rel="stylesheet" type="text/css" href="/chaea/css/phone.css" media="only screen and (min-width: 768px) and (max-width: 991px)">
		<link rel="stylesheet" type="text/css" href="/chaea/css/small.css" media="only screen and (max-width: 767px)">
		<link rel="stylesheet" type="text/css" href="/chaea/css/form.css" media="all">
    <link rel="stylesheet" type="text/css" href="/chaea/css/style/estilos.css" media="all"> 		<!--Maneja los estilos de la cartilla y el loging -->
		<link rel="stylesheet" type="text/css" href="/chaea/css/bootstrap-select.min.css" media="all">
		<link rel="stylesheet" type="text/css" href="/chaea/engine0/style.css" />

		<script src="/chaea/js/jquery.js" type="text/javascript"></script>
		<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
		<!-- Temas de la pagina -->
		<!-- Configura el texto, el nav y los formularios -->
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-h21C2fcDk/eFsW9sC9h0dhokq5pDinLNklTKoxIZRUn3+hvmgQSffLLQ4G4l2eEr" crossorigin="anonymous">

		<!--Esto es para terner la fuente de iconos-->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
		<!--FIN -->
		<!-- Configuración del lector JSON que permite el autocompletado  -->
		<script src="/chaea/js/jsn/jquery.easy-autocomplete.js"></script>
		<link rel="stylesheet" href="/chaea/css/style/easy-autocomplete.css">
		<link rel="stylesheet" href="/chaea/css/style/easy-autocomplete.themes.css">
		<!-- end -->
		<!-- Formularios -->

		<!--tablas-->
	  <script src="/chaea/js/jsn/questionChaea.js" charset="utf-8"></script>
		<!-- END -->
		<!-- <script src="/chaea/js/unal.js" type="text/javascript"></script> -->
		<!-- Formularios -->
    <!-- Para crear archivos en linea -->
    <script src="//cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>

		<!--Este es JSN-->
		<!--  Tablas CSS -->
		 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">



		    <!--[if lt IE 9]><script src="js/html5shiv.js" type="text/javascript"></script><![endif]-->
		    <!--[if lt IE 9]><script src="js/respond.js" type="text/javascript"></script><![endif]-->
				<div>
						<div id="services">
							<div class="indicator"></div>
							<ul>
								<li><img src="/chaea/images/icnServEmail.png" width="32" height="32" border="0" alt=""><a href="http://correo.unal.edu.co" target="_blank">Correo institucional</a></li>
								<li><img src="/chaea/images/icnServSia.png" width="32" height="32" border="0" alt=""><a href="http://www.sia.unal.edu.co" target="_blank">Sistema de Información Académica</a></li>
								<li><img src="/chaea/images/icnServLibrary.png" width="32" height="32" border="0" alt=""><a href="http://www.sinab.unal.edu.co" target="_blank">Bibliotecas</a></li>
								<li><img src="/chaea/images/icnServCall.png" width="32" height="32" border="0" alt=""><a href="http://168.176.5.43:8082/Convocatorias/indice.iface" target="_blank">Convocatorias</a></li>
							</ul>
						</div>
						<!-- Imagen de la barra de navegación -->
						 <div class="home-image">
							<img src="/chaea/images/img_demo.jpg" width="2000" height="80" border="0" alt="">
						</div>
				</div>

	</head>
	<header id="unalTop">
			<div class="logo">
				<a href="http://unal.edu.co">
				<img alt="Escudo de la Universidad Nacional de Colombia" src="/chaea/images/escudoUnal.png" width="189" height="70" title="Escudo de la Universidad Nacional de Colombia"/>
				</a>
				<div class="diag">
				</div>
			</div>
			<div class="seal">
				<img alt="Escudo Universidad de Caldas" src="/chaea/images/UC.png" width= "100" height= auto title="Escudo Universidad de Caldas"/>
			</div>


			<div class="firstMenu">
				<div class="btn-group tx-srlanguagemenu">
					<div class="btn btn-default dropdown-toggle" data-toggle="dropdown"> ES <span class="caret"></span>
					</div>
					<ul class="dropdown-menu" role="menu"></ul>
				</div>
			</div>

			<div class="navigation">
				<div class="site-url">
					<div class="icon"></div>
					Fortalecimiento de Competencia Digital Basado en Estilos de Aprendizaje:
					<br><br>Estrategia Evaluativa para Estudiantes de Primer Semestre
				</div>
			</div>
		</header>

<!-- Esta no se cierra porque funcia para todos los contenidos... -->
