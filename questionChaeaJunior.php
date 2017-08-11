<?php
	include('partials/head.php');
	include('partials/nav.php');
  include('backendPhp/send.php');
  $questionChaeaJunior="";
	$questionChaeaJunior= questionCJ();
?>
<!-- Configura el texto, el nav y los formularios -->

<link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">
<!--* Pasar a hoja de estilos -->
<style media="screen">
.has-success .control-label{
	color: #000000;
}


h1[number]{
	color: #ffffff !important;
	font-size: 43px !important;
	margin-top: 0px !important;
	text-align: center !important;
	border-bottom: 1px solid #a0a0a0 !important;
}
.form-control:focus {
	border-color: #41ac1d;
	outline: 4px;
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(63, 182, 24, 0.41);
}
</style>

<body id="fondo">
	<div id="particles-js"></div>
	<main class="detalle">

	<div id="question-box">
		<div id="loader" >
			<div class="stepwizard">
			    <div class="stepwizard-row setup-panel">

			        <div class="stepwizard-step">
			            <a href="#step-1" type="button"  class="btn btn-primary btn-circle cerr1" >1</a>
			            <p>Paso 1</p>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-2" type="button" class="btn btn-default btn-circle cerr2" >2</a>
			            <p>Paso 2</p>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-3" type="button" class="btn btn-default btn-circle cerr3" disabled="disabled">3</a>
			            <p>Paso 3</p>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-4" type="button" class="btn btn-default btn-circle cerr4" disabled="disabled">4</a>
			            <p>Paso 4</p>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-5" type="button" class="btn btn-default btn-circle cerr5" disabled="disabled">5</a>
			            <p>Paso 5</p>
			        </div>
							<div class="stepwizard-step">
			            <a href="#step-6" type="button" class="btn btn-default btn-circle cerr6" disabled="disabled">6</a>
			            <p>Paso 6</p>
			        </div>
			    </div>
			</div>
			<form role="form" name = "questionChaea" onsubmit="return false"><!--onsubmit="return onSubmit()"-->

			    <div class="row setup-content" id="step-1">
			        <div class="col-xs-12">
			            <div class="col-md-12">
			                <h3> Paso 1</h3>
			                <div class="form-group">
												<h2>Test de estilos de aprendizaje chaea</h2>
												<p class="text-muted">El proyecto titulado "Fortalecimiento de Competencia Digital Basado en Estilos de Aprendizaje: Estrategia Evaluativa para Estudiantes de Primer Semestre", es un estudio que consiste en un proceso de diseño, elaboración y evaluación de estrategias para el seguimiento valorativo de la competencia digital en contextos universitarios, con el fin de generar nuevas propuestas metodologías para el desempeño discente. Los datos aquí suministrados serán usados de forma anónima y solo para la caracterización de la población que participa en el estudio. Sus datos solo serán vistos por los investigadores vinculados al proyecto.</p>
											</div>
										  <button class="btn btn-success nextBtn  btn-lg pull-right btn-un" type="button" >siguiente</button>
									</div>
			        	</div>
			    </div>



					<div class="row setup-content" id="step-2">
							<div class="col-xs-12">
									<div class="col-md-12">
											<h3> Paso 2</h3>
											<p class="text-muted">Acepta participar en el estudio</p>
											<div class="form-group" id='name_st'>
													<label class="control-label">Firma Nombre</label>
													<input pattern=".{0}|.{12,80}" title="tiene que tener por lo menos 12 caracteres"  maxlength="100" type="text" id="name_s" value="" onKeyPress="return control1(event)" required class="form-control" placeholder="Ej: Jorge Enrique Pineda Torres"  />
											</div>
											<div class="form-group" id="id_sx">
												<label class="control-label">Documento</label>
												<input type="number" value="" class="form-control"  min="1000000" max="10000000000" required onKeyPress="return control2(event)" id="id_user"  class="form-control" placeholder="Ej: 52220080" />
											</div>
											<label class="control-label" >Confirma</label>
											<select id="confirmation" class="form-control" >
												<option>No</option>
												<option>Si</option>
											</select><br>
											<div id='oculto' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>Debe aceptar las condiciones establecidas para concretar el registro. </strong></a> </div>
									</div>
									<button class="btn btn-success nextBtn btn-lg pull-right btn-un" id="next0"   type="button" >siguiente</button>
							</div>
					</div>



			    <div class="row setup-content" id="step-3">
			        <div class="col-xs-12">
			            <div class="col-md-12">
			                <h3> Paso 3</h3>
											<div class="form-group">
						                <table class="table table-striped table-hover">
						                  <thead>
						                    <tr>
						                      <th>#</th><th>Pregunta</th><th>Más<i class="fa fa-plus" aria-hidden="true"></i></th><th>Menos<i class="fa fa-minus" aria-hidden="true"></i></th>
						                    </tr>
						                  </thead>
						                  <tbody>
						                    <?php
						                        $color = array( 0 => "cano", 1 => "jsn",); $c = 0;

						                        for ($i=0; $i < 20; $i++) {  //20 primeras
						                            echo  "<tr  id = 'pregunta".$i."' required='required' class =".$color[$c].">".
						                                  "<td>".$questionChaeaJunior[$i]['idc'].". </td>".
						                                  "<td>".$questionChaeaJunior[$i]['qu']."</td>".
						                                  "<td><input class='radij'  required='required'   type=radio name = 'q".$i."' value='+'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-plus' aria-hidden='true'></div></td>".
						                                  "<td><input class='radij'  required='required'  type=radio name = 'q".$i."' value='-'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-minus' aria-hidden='true'></div></td>".
						                                 "</tr>";
						                             if ($c == 0) {$c=1;} else {$c=0;}
						                          }
						                     ?>
						                  </tbody>
						                </table>
												</div>
			                <button class="btn btn-success nextBtn btn-lg pull-right btn-un" type="button" id="next1" >Siguiente</button>
			            </div>
			        </div>
			    </div>
			    <div class="row setup-content" id="step-4">
			        <div class="col-xs-12">
			            <div class="col-md-12">
			                <h3> Paso 4</h3>
			                <table class="table table-striped table-hover ">
			                  <thead>
			                    <tr>
			                      <th>#</th><th>Pregunta</th><th>Más<i class="fa fa-plus" aria-hidden="true"></i></th><th>Menos<i class="fa fa-minus" aria-hidden="true"></i></th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                    <?php
			                        $color = array( 0 => "cano", 1 => "jsn",); $c = 0;

			                        for ($i=20; $i < 44; $i++) { //20 segundas
			                            echo  "<tr  id = 'pregunta".$i."' required='required' class =".$color[$c].">".
			                                  "<td>".$questionChaeaJunior[$i]['idc'].". </td>".
			                                  "<td>".$questionChaeaJunior[$i]['qu']."</td>".
			                                  "<td><input class='radij'  required='required' type=radio name = 'q".$i."' value='+'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-plus' aria-hidden='true'></div></td>".
			                                  "<td><input class='radij'  required='required' type=radio name = 'q".$i."' value='-'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-minus' aria-hidden='true'></div></td>".
			                                 "</tr>";
			                             if ($c == 0) {$c=1;} else {$c=0;}
			                          }
			                     ?>

			                  </tbody>
			                </table>
			                <button class="btn btn-success nextBtn btn-lg pull-right  btn-un" type="button" id="next2" >Siguiente</button>
			            </div>
			        </div>
			    </div>

					<div class="row setup-content" id="step-5">
							<div class="col-xs-12">
								<div class="form-group">
													 <h3> Paso 5 </h3>
													 <?php include('/partials/viewStudent/studentTableCourse.php'); ?>
											 </div>
											 <button class="btn btn-success nextBtn btn-lg pull-right  btn-un" id="next3"  type="button" >Siguiente</button>

							</div>
					</div>

			    <div class="row setup-content" id="step-6">
			        <div class="col-xs-12">
			            <div class="col-md-12">
			                <h3> Paso 6 </h3>
											<div id="ans">
												<h1 id="answerh1">Resultados del Test Chaea</h1>
													<h3>Activo</h3><h1 id="result1"></h1>
													<h3>Reflexivo</h3><h1 id="result2"></h1>
													<h3>Teorico</h3><h1 id="result3"></h1>
													<h3>Pragmático</h3><h1 id="result4"></h1>
											</div>
			                <button class="btn btn-success btn-lg pull-right" id="next4" type="submit">¡Enviar!</button>
			            </div>
			        </div>
			    </div>

			</form>
		</div>
	</div>
	<script src="js/jsn/controlForm.js" type="text/javascript"></script><!--Este es JSN-->
	<script src="js/jsn/tableJunior.js" charset="utf-8"></script><!--este es JSN-->

	<?php
		include('/partials/modal/modalInfo.php');
		include("analyticstracking.php");
 	?>
</body>
</main>

<?php
  include('partials/pie.html');
?>
