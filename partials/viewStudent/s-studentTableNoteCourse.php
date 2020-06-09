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
$courses= courseNoteActiv();
$coursesLet = count($courses);
?>
<script src="https://code.jquery.com/jquery-1.11.2.js" integrity="sha256-WMJwNbei5YnfOX5dfgVCS5C4waqvc+/0fV7W2uy3DyU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="/chaea/js/jsn/courseSettings/actiStudentCourse.js"></script>
<!-- No lo tenia  -->
<link href="/chaea/css/style/varControl.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/chaea/css/style/questionChaea.css" media="all">
<link rel="stylesheet" type="text/css" href="/chaea/css/style/slider.css" >
<link rel="stylesheet" type="text/css" href="/chaea/css/style/switch.css" >
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" >

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
    <center><h1>Notas finales</h1></center><br>
             <div class="stepwizard">
                 <div class="stepwizard-row setup-panel">

                     <div class="stepwizard-step">
                         <a href="#step-1" type="button" class="btn btn-primary btn-circle" >1</a>
                         <p>Cursos</p>
                     </div>
                     <div class="stepwizard-step">
                         <a href="#step-2" id="car" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                         <p>Actividad/es</p>
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
                       			             <table class="table table-striped table-hover coursePage" number-per-page="5" current-page="0">
                       			                  <thead>
                       			                    <tr>
                       			                      <th>ID</th><th>Curso</th><th>Descripción</th><th>Nota Definitiva</th><th>Seleccionar</th>
                       			                    </tr>
                       			                  </thead>
                       			                  <tbody>
                       			                    <?php
                       			                        $color = array( 0 => "cano", 1 => "jsn",); $c = 0;
                                                    if($courses[0]['co_name']!=""){
                       			                        for ($i=0; $i < count($courses); $i++) {  //20 primeras
                                                      $note_st = number_format(floatval($courses[$i]['note_st']), 1, '.', ' ');
                                                      $description_course = getSubString($courses[$i]['co_des'], null);
                       			                            echo  "<tr required='required' class =".$color[$c].">".
                                                                  "<td id='idCourse'>".$courses[$i]['id_co']."</td>".
                           			                                  "<td id='nameCourse'>".$courses[$i]['co_name']."</td>".
                           			                                  "<td>".$description_course.". </td>".
                                                                  "<td id='noteCourse'><center>".$note_st."</center></td>".
                                                                  "<td><center><input class='radij'  required='required' name='courseId' type=radio><br></center></td>".
                       			                                   "</tr>";
                       			                             if ($c == 0) {$c=1;} else {$c=0;}
                       			                          }
                                                    }else{
                                                      echo  "<tr required='required' class =".$color[0].">".
                                                                "<td id='nameCourse'></td>".
                                                                "<td></td>".
                                                                "<td id='idCourse'><h4><center>No se tienen regisitro de notas...</center></h4></td>".
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
                                <div id="erroCourse"></div>
                 							</div>
                             <button class="btn btn-success nextBtn btn-lg pull-right btn-un" type="button" id="next1-1" >Siguiente</button>
                        </div>
                 </div>

                 <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                             <div class="form-group">
                                 <h3><div id="nameCouNote"></div></h3>
                                  <?php include(__DIR__.'/../viewStudent/s-tablesTrackingStudent/s-tableActivStudentSelect.php'); ?>
                             </div>
                        </div>
                        <button  class="btn btn-success backBtn btn-lg pull-left  btn-un" type="button" id="next2" >atras</button>
                    </div>
                </div>
  </div>
</main>




<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/chaea/js/jsn/simplepagination.js"></script>
<script type="text/javascript" src="/chaea/js/jsn/controlForm.js"></script>
<script type="text/javascript" src="/chaea/js/cookies.js"></script>





<!--Este es JSN-->
</body>

<?php
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/backendPhp/sessionJS.php');
  include($_SERVER["DOCUMENT_ROOT"].'/chaea/partials/pie.html');
?>
