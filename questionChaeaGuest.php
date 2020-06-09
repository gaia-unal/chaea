<?php
	include('partials/head.php');
	include('partials/nav.php');
  include('backendPhp/send.php');
  $questionChaea="";
	$questionChaea= questionC();
?>
<!-- Configura el texto, el nav y los formularios -->

<link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">

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
<div id="question-box" >
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">

        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle" >1</a>
            <p>Paso 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled" >2</a>
            <p>Paso 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Paso 3</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Paso 4</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
            <p>Paso 5</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
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
									<p class="text-muted">El proyecto titulado "Fortalecimiento de Competencia Digital Basado en Estilos de Aprendizaje: Estrategia Evaluativa para Estudiantes de Primer Semestre", es un estudio que consiste en un proceso de diseño, elaboración y evaluación de estrategias para el seguimiento valorativo de la competencia digital en contextos universitarios, con el fin de generar nuevas propuestas metodologías para el desempeño discente. Los datos aquí suministrados serán usados de forma anónima y solo para la caracterización de la población que participa en el estudio.</p>
								</div>
							  <button class="btn btn-success nextBtn  btn-lg pull-right btn-un" type="button" >siguiente</button>
							</div>
        		</div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Paso 2</h3>
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
			                                  "<td>".$questionChaea[$i]['idc'].". </td>".
			                                  "<td>".$questionChaea[$i]['qu']."</td>".
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
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Paso 3</h3>
                <table class="table table-striped table-hover ">
                  <thead>
                    <tr>
                      <th>#</th><th>Pregunta</th><th>Más<i class="fa fa-plus" aria-hidden="true"></i></th><th>Menos<i class="fa fa-minus" aria-hidden="true"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $color = array( 0 => "cano", 1 => "jsn",); $c = 0;

                        for ($i=20; $i < 40; $i++) { //20 segundas
                            echo  "<tr  id = 'pregunta".$i."' required='required' class =".$color[$c].">".
                                  "<td>".$questionChaea[$i]['idc'].". </td>".
                                  "<td>".$questionChaea[$i]['qu']."</td>".
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

                        for ($i=40; $i < ((count($questionChaea)-20)); $i++) {
                            echo  "<tr id = 'pregunta".$i."' required='required' class =".$color[$c].">".
                                  "<td>".$questionChaea[$i]['idc'].". </td>".
                                  "<td>".$questionChaea[$i]['qu']."</td>".
                                  "<td><input class='radij'  required='required' type=radio name = 'q".$i."' value='+'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-plus' aria-hidden='true'></div></td>".
                                  "<td><input class='radij'  required='required' type=radio name = 'q".$i."' value='-'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-minus' aria-hidden='true'></div></td>".
                                 "</tr>";
                             if ($c == 0) {$c=1;} else {$c=0;}
                          }
                     ?>

                  </tbody>
                </table>
                <button class="btn btn-success nextBtn btn-lg pull-right  btn-un" id="next3"  type="button" >Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-5">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Paso 5</h3>
                <table class="table table-striped table-hover ">
                  <thead>
                    <tr>
                      <th>#</th><th>Pregunta</th><th>Más<i class="fa fa-plus" aria-hidden="true"></i></th><th>Menos<i class="fa fa-minus" aria-hidden="true"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $color = array( 0 => "cano", 1 => "jsn",); $c = 0;

                        for ($i=60; $i < 80; $i++) {
                            echo  "<tr id = 'pregunta".$i."' required='required' class =".$color[$c].">".
                                  "<td>".$questionChaea[$i]['idc'].". </td>".
                                  "<td>".$questionChaea[$i]['qu']."</td>".
                                  "<td><input class='radij'  required='required' type=radio name = 'q".$i."' value='+'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-plus' aria-hidden='true'></div></td>".
                                  "<td><input class='radij'  required='required' type=radio name = 'q".$i."' value='-'><br><div style='text-indent: 0.1em; vertical-align: middle' class='fa fa-minus' aria-hidden='true'></div></td>".
                                 "</tr>";
                             if ($c == 0) {$c=1;} else {$c=0;}
                          }
                     ?>

                  </tbody>
                </table>
                <button class="btn btn-success nextBtn btn-lg pull-right  btn-un" id="nexti4"  type="button" >Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-6">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Paso 6</h3>
								<div id="ans">
									<h1 id="answerh1">Resultados del Test Chaea</h1>
										<h3>Activo</h3><h1 id="result1"></h1>
										<h3>Reflexivo</h3><h1 id="result2"></h1>
										<h3>Teorico</h3><h1 id="result3"></h1>
										<h3>Pragmático</h3><h1 id="result4"></h1>
								</div>
            </div>
        </div>
    </div>



</form>

</main>
</div>


<script src="js/jsn/tabla.js" charset="utf-8"></script><!--este es JSN-->

</body>

<?php
  include_once("analyticstracking.php");
include('backendPhp/sessionJS.php');
  include('partials/pie.html');
?>
