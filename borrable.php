<?php
if(!isset($_SESSION)) {
     session_start();
}
do{
	echo key($_SESSION).": ";
	echo "-->".current($_SESSION)."----";
} while(next($_SESSION))

 ?>

<?php
require_once("/funcionesphp/conexion.php");
$objDatos = new DB();
$objDatos->connect();

$person= array(0,"jsnavarroc@unal.edu.co", 2, 3, 4, 5,"jsnavarroc","1053813532");
validationRol($person, "teacher");


function validationRol ($person, $rol){
  // global $objDatos;
  // $consulta = "SELECT rol.number_document, rol.id_type_document,
  // rol.name, bir.name_birthplace, rol.birthdate, u.name_university,
  // rol.email, rol.number_phone, rol.nickname, rol.gender
  //              FROM teacher as rol, birthplace as bir, university as u
  //              where rol.number_document = '".$_SESSION["document"]."'
  //              and rol.id_birthplace = bir.id_birthplace
  //              and rol.id_university = u.id_university;";
  // $administrator = $objDatos->executeQuery($consulta);
  // $objDatos->closeConnect();
  // echo ''.json_encode($administrator).'';

  global $objDatos;
  $sql = "SELECT COUNT(atribut1.n1) as nickname , COUNT(atribut2.n2) as number_document,
          COUNT(atribut3.n3) as email
          FROM ".$rol."
          LEFT JOIN (select count(nickname) AS n1, nickname from ".$rol."
          where nickname = '".$_SESSION['nickname_up']."' and  password = '".$_SESSION['password_up']."'
          GROUP BY nickname)atribut1
          on ".$rol.".nickname=atribut1.nickname

          LEFT JOIN (select count(number_document) AS n2, number_document from ".$rol."
          where number_document = '".$_SESSION['document_up']."' and  password = '".$_SESSION['password_up']."'
          GROUP BY number_document)atribut2
          on ".$rol.".number_document=atribut2.number_document

          LEFT JOIN (select count(email) AS n3, email from ".$rol."
          where email = '".$_SESSION['email_up']."' and  password = '".$_SESSION['password_up']."'
          GROUP BY email)atribut3
          on ".$rol.".email=atribut3.email;";
  $crud = $objDatos->executeQuery($sql);
  echo "<br>".($crud[0]['nickname'])."<br>";
  var_dump($crud);
  return $crud;

}

 ?>
 <!doctype html>
 <html>
 <head>
 <!-- <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <meta name="viewport" content="width=device-width, initial-scale=1"> -->
 	<!-- <title>jQuery simplePagination Plugin Demo Page</title> -->
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous"> -->
 	<style>
       .pager {
         list-style: none;
         margin-top: 10px;
         padding: 0;
       }

       .page {
         border-radius: 3px;
         color: black;
         background: #eee;
         cursor: pointer;
         display: inline;
         font-weight: 200;
         margin: 10px 5px 0px 2px;
         padding: 10px;
         text-align: center;
         width: 10px;
       }

       .activer {
         background: teal;
         color: white;
       }
 </style>
 	</head>

 	<body>
     <!-- <div class="container" style="margin-top:50px;">
         <h1>jQuery simplePagination Plugin Demo Page</h1>
         <div class="jquery-script-ads" style="margin:30px auto;">
            <script type="text/javascript">
                 google_ad_client = "ca-pub-2783044520727903";
                 /* jQuery_demo */
                 google_ad_slot = "2780937993";
                 google_ad_width = 728;
                 google_ad_height = 90;
                 //
             </script>
             <script type="text/javascript"
                 src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
             </script>
          </div> -->

          <!-- class="coursePage table table-inverse" -->
         <table class="coursePage" number-per-page="2" current-page="0">
           <thead>
             <tr>
               <th>Element</th>
               <th>Value</th>
               <th>Options</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td>Johan</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>2 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>3 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>4 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>5 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>6 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>7 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td> 8 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>9 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
             <tr>
               <td>10 Name</td>
               <td>A value</td>
               <td> Edit</td>
             </tr>
           </tbody>
         </table>
     <!-- </div> -->
 </body>

 	<script   src="https://code.jquery.com/jquery-1.12.4.js"></script>
 	<script type="text/javascript" src="simplepagination.js"></script>
 	<script type="text/javascript">
 	$(function(){
 		$(".coursePage").pagination();
 	})
 </script>

 </html>
