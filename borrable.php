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
require_once("/backendPhp/conexion.php");
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
 <html>
 <head>


   <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script>
   <!-- <link rel="stylesheet" type="text/css" href="/css/result-light.css"> -->
   <title> by ishandemon</title>
  <script type="text/javascript">//<![CDATA[
   $(window).load(function(){
   $(document).ready(function() {
       $('#example').dataTable({

   		"footerCallback": function ( row, data, start, end, display ) {
         				var api = this.api(), data;
                alert(data);
         				// Remove the formatting to get integer data for summation
         				var intVal = function ( i ) {
         					return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ?	i : 0;
         				};

         				// total_salary over all pages
         				total_salary = api.column( 1 ).data().reduce( function (a, b) {
         					return intVal(a) + intVal(b);
         				},0 );

         				// total_page_salary over this page
         				total_page_salary = api.column( 1, { page: 'current'} ).data().reduce( function (a, b) {
         					return intVal(a) + intVal(b);
         				}, 0 );

         				total_page_salary = parseFloat(total_page_salary);
         				total_salary = parseFloat(total_salary);
         				// Update footer
         				$('#totalSalary').html(total_page_salary.toFixed(2)+"/"+total_salary.toFixed(2));
   			}
   	});
   });

   });//]]>

   </script>


 </head>

 <body>
     <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
     <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"> </script>
 <div class="container">

     <div id="example_wrapper" class="dataTables_wrapper">

         <table cellpadding="0" cellspacing="0" border="0" class="dataTable" id="example" role="grid" aria-describedby="example_info">
             <thead>
                 <tr >
                   <th>Name</th>
                   <th>Salary</th>
                 </tr>
             </thead>
             <tbody>
                <tr  class="odd">
                      <td class="sorting_1">abc</td>
                     <td class="sorting_1">100</td>
                 </tr>
                 <tr  class="even">
                     <td class="sorting_1">abc</td>
                     <td class="sorting_1">100</td>
                 </tr><tr  class="odd">
                     <td class="sorting_1">aeda</td>
                     <td class="sorting_1">100</td>
                 </tr><tr  class="even">
                      <td class="sorting_1">lod</td>
                     <td class="sorting_1">100</td>
                 </tr><tr  class="odd">
                      <td class="sorting_1">xyz</td>
                     <td class="sorting_1">100</td>
                 </tr><tr  class="even">
                     <td class="sorting_1">xyz</td>
                     <td class="sorting_1">100</td>
                 </tr><tr  class="odd">
                     <td class="sorting_1">xyz</td>
                     <td class="sorting_1">150</td>
                 </tr></tbody>
             <tfoot>
             		<tr>
                  <td colspan="1" rowspan="1">
                  <span style="float:right;" id="totalSalary">700.00/6400.00</span>
                </td>
              </tr>
             </tfoot>
        </table>

     </div>
 </div>







 </body>
 </html>
