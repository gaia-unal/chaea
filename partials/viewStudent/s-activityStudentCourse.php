<?php
session_start();
if(!$_SESSION){
  header ("Location:/chaea/logingIndex.php");
}else if (("student"!=$_SESSION["rol"])) {
  header ("Location:/chaea/logingIndex.php");
}
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/head.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/nav.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/analyticstracking.php');
include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/courseSQL/s-course.php');
$courses="";
$courses= courseInscriptionStudentActi();
$coursesLet = count($courses);
?>
<!-- No lo tenia  -->
<link href="/chaea/css/style/varControl.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">
<link rel="stylesheet" type="text/css" href="/chaea/css/style/slider.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >

<style media="screen">
.leftTextButon {
    margin-left: -49px !important;
}
.leftButton {
    margin-left: -16% !important;
}
.w3-modal-content {
    margin-top:  42% !important;
}

</style>
<script type="text/javascript">
  var coursesLet = "<?php echo $coursesLet; ?>" ;
</script>


<body id="table">
<div id="particles-js"></div>
<main class="detalle">
  <div id="table-boxi" >
    <center><h1>Desarrollo de las actividades en los cursos</h1></center><br>

             <div class="stepwizard">
                 <div class="stepwizard-row setup-panel">

                     <div class="stepwizard-step">
                         <a href="#step-1" type="button" class="btn btn-primary btn-circle"  >1</a>
                         <p>Cursos</p>
                     </div>
                     <div class="stepwizard-step">
                         <a href="#step-2" type="button" id="next1" class="btn btn-default btn-circle" disabled="disabled">2</a>
                         <p>Actividades</p>
                     </div>
                 </div>
             </div>
             <?php  include(__DIR__.'/../viewStudent/navControlStudent.html');?>

             <form role="form" name = "questionChaea" onsubmit="return false"><!--onsubmit="return onSubmit()"-->

                 <div class="row setup-content" id="step-1">
                        <div class="col-xs-12">
                              <div class="col-md-12">
                                <h3>Selecciona un curso</h3>
                 								<div class="form-group">
                       			             <table class="table table-striped table-hover coursePage" >
                       			                  <thead>
                       			                    <tr>
                       			                      <th>Curso</th><th>Descripción</th><th>ID</th><th>Seleccionar</th>
                       			                    </tr>
                       			                  </thead>
                       			                  <tbody>
                             			                    <?php
                             			                        $color = array( 0 => "cano", 1 => "jsn",); $c = 0;
                                                          if($courses[0]['namco']!=""){
                             			                        for ($i=0; $i < count($courses); $i++) {  //20 primeras
                                                            $description_course = getSubString($courses[$i]['dc'], null);
                             			                            echo  "<tr required='required' class =".$color[$c].">".
                                 			                                  "<td id='nameCourse'>".$courses[$i]['namco']."</td>".
                                 			                                  "<td>".$description_course.". </td>".
                                 			                                  "<td id='idCourse'>".$courses[$i]['idco']."</td>".
                                                                        "<td><input class='radij'  required='required' name='courseId' type=radio><br></td>".
                             			                                   "</tr>";
                             			                             if ($c == 0) {$c=1;} else {$c=0;}
                             			                          }
                                                          }else{
                                                            echo  "<tr required='required' class =".$color[0].">".
                                                                      "<td id='nameCourse'></td>".
                                                                      "<td></td>".
                                                                      "<td id='idCourse'><h4><center>No se han activado aun los cursos...</center></h4></td>".
                                                                      "<td></td>".
                                                                   "</tr>".
                                                                   "<script>
                                                                   $(window).load(function() {
                                                                          $('#next1-1').prop('disabled', true);
                                                                    });
                                                                   </script>";
                                                          }
                             			                     ?>
                       			                  </tbody>
                       			                </table>
                                </div>
                                <div id="errorCourse"></div>
                 							</div>
                             <button class="btn btn-success nextBtn btn-lg pull-right btn-un" type="button" id="next1-1" >Siguiente</button>
                        </div>
                  </div>
                 <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                             <div class="form-group">
                                 <h3><div id="nameActiCou"></div></h3>
                                  <?php include(__DIR__.'/../viewStudent/activityConfig/s-tableAct.php'); ?>
                             </div>
                        </div>

                        <button  class="btn btn-success backBtn btn-lg pull-left  btn-un" type="button" id="next3" >Atras</button>
                    </div>
                 </div>
             </form>
             <?php
               include(__DIR__.'/../modal/modalInfoElement.php');
               include(__DIR__.'/../modal/modalActivityUpload.php');
               include(__DIR__.'/../modal/modalInfo.php');
               include(__DIR__.'/../modal/modalError.php');
               include(__DIR__.'/../modal/modalConfirm.php');
             ?>
  </div>
</main>




</body>

<!-- Este tiene las funcionalidades CRUD de la tabla -->
<script type="text/javascript" src="/chaea/js/cookies.js"></script>
<!-- <script src="/chaea/js/jsn/courseSettings/s-CourseCrudIns.js" charset="utf-8"></script> -->

<script type="text/javascript" src="/chaea/js/jsn/courseSettings/courActiUpload.js"></script>
<script  src="/chaea/js/jsn/slider.js" charset="utf-8"></script>
<!--Este es JSN-->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- Este controla toda la parte de ingreso de datos a los campos. -->
<script src="/chaea/js/jsn/controlForm.js"></script>

<!-- Carga la info de la tabla -->







<?php
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/sessionJS.php');
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
