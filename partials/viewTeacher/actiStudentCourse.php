<?php
session_start();
if(!$_SESSION){
  header ("Location:/chaea/logingIndex.php");
}else if (("teacher"!=$_SESSION["rol"])) {
  header ("Location:/chaea/logingIndex.php");
}
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/head.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/analyticstracking.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/funcionesphp/courseSQL/courseEstudentActiv.php');
$courses="";
$courses= consultCoruse();
?>
<link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">

<body id="table">

<?php include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav/navTeacherController.php');?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >
<link href="/chaea/css/style/varControl.css" rel="stylesheet" />
<div id="particles-js"></div>
<main class="detalle">
  <div id="table-box" >
   <div id="question-box">
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
                       <h3> Activación del Estudiantes en el Curso</h3>
                       <div class="form-group">
       									<p class="text-muted">En esta parte podrás activar los estudiantes
                           a cada uno de los cursos que hayas creado.</p>
       								</div>
       							  <button class="btn btn-success nextBtn  btn-lg pull-right btn-un" type="button" >siguiente</button>
       							</div>
               		</div>
           </div>
           <div class="row setup-content" id="step-2">
               <div class="col-xs-12">
                   <div class="col-md-12">
                       <h3>Selecciona un Curso</h3>
       								<div class="form-group">
       			                <table class="table table-striped table-hover">
       			                  <thead>
       			                    <tr>
       			                      <th>Curso</th><th>Descripción</th><th>ID</th>
       			                    </tr>
       			                  </thead>
       			                  <tbody>
       			                    <?php
       			                        $color = array( 0 => "cano", 1 => "jsn",); $c = 0;

       			                        for ($i=0; $i < count($courses); $i++) {  //20 primeras
                                      $description_course = getSubString($courses[$i]['dc'], null);
       			                            echo  "<tr  id = 'pregunta".$i."' required='required' class =".$color[$c].">".
       			                                  "<td><a href='#'>".$courses[$i]['namco'].".</a></td>".
       			                                  "<td>".$description_course.". </td>".
       			                                  "<td>".$courses[$i]['idco']."</td>".
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
                       <button class="btn btn-success nextBtn btn-lg pull-right  btn-un" id="next4"  type="button" >Siguiente</button>
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
     </div>


    <?php

    include(__DIR__.'/../modal/modalDelete.php');
    include(__DIR__.'/../modal/modalEditCourse.php');
    include(__DIR__.'/../modal/modalAddCourse.php');
    include(__DIR__.'/../modal/modalInfo.php');
    include(__DIR__.'/../modal/modalInfoCourse.php');


    ?>
  </div>

</main>

<!-- Fin de la configuracion -->
<!-- Da la funcionalidad de lo radian bouton -->
<script src="/chaea/js/jsn/tabla.js" charset="utf-8"></script><!--este es JSN-->

<!-- Carga la info de la tabla -->
<script src="/chaea/js/jsn/courseSettings/courseTableTeacher.js" charset="utf-8"></script><!--este es JSN-->
<!-- Carga el funcionamiento de tabla -->
<!-- Este tiene las funcionalidades CRUD de la tabla -->
<!--este es JSN-->
<script src="/chaea/js/jsn/courseSettings/courseTableCrud.js" charset="utf-8"></script>
<!-- FIN CRUD -->
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!--Este es JSN-->
</body>

<?php
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/funcionesphp/sessionJS.php');
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
