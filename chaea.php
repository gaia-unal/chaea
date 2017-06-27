<?php
include('partials/head.php');
include('partials/nav.php');
include('conexionbd.php');
if(isset($_POST['enviar']) == 1){
    //Contadores para almacenar la cantidad de cada tipo de estilo de aprendizaje


    $a=0;
    $r=0;
    $t=0;
    $p=0;

    if(count($_POST) > 1){
        $activo = array(3, 5, 7, 9, 13, 20, 26, 27, 35, 37, 41, 43, 46, 48, 51, 61, 67, 74, 75, 77);//20
        $reflexivo = array(10, 16, 18, 19, 28, 31, 32, 34, 36, 39, 42, 44, 49, 55, 58, 63, 65, 69, 70, 79);//20
        $teorico = array(2, 4, 6, 11, 15, 17, 21, 23, 25, 29, 33, 45, 50, 54, 60, 64, 66, 71, 78, 80);//20
        $pragmatico = array(1, 8, 12, 14, 22, 24, 30, 38, 40, 47, 52, 53, 56, 57, 59, 62, 68, 72, 73, 76);//20

        for($h=1;$h<=80;$h++){
            if(array_key_exists('preg'.$h,$_POST)){
                if($_POST['preg'.$h]=='+'){
                    switch($h){
                        case in_array($h,$activo):
                            $a++;
                            break;
                        case in_array($h,$reflexivo):
                            $r++;
                            break;
                        case in_array($h,$teorico):
                            $t++;
                            break;
                        case in_array($h,$pragmatico):
                            $p++;
                            break;
                        default:
                            break;
                    }
                }
            }
        }

    }

    echo '<script language="JavaScript">
        alert("Los resultados de cada uno de los Estilos de Aprendizaje son los siguientes:\n\nActivo='.$a.'\nReflexivo='.$r.'\nTeorico='.$t.'\nPragmatico='.$p.'");
        </script>';

    $con = mysql_connect("localhost","root","") or die ("Error");
    mysql_select_db("chaea",$con) or die ("Error2");

    $Nombre = $_POST['Nombre'];
    $Cedula = $_POST['Cedula'];
    $Universidad = $_POST['Universidad'];
    $Email = $_POST['Email'];
    $Genero = $_POST['Genero'];
    $Fecha = $_POST['Fecha'];
    $Ciudad = $_POST['Ciudad'];
    $Carrera = $_POST['Carrera'];
    $Semestre = $_POST['Semestre'];
    $Telefono = $_POST['Telefono'];
    $Acuerdo = $_POST['Acuerdo'];
    $Firma = $_POST['Firma'];


    $a;
    $r;
    $t;
    $p;

    $consulta = "insert into persona values ('$Nombre','$Cedula','$Universidad','$Email', '$Genero', '$Fecha', '$Ciudad', '$Carrera', '$Semestre', '$Acuerdo', '$Telefono', '$Firma', '$a', '$r', '$t','$p')";

    if(mysql_query($consulta,$con)){
        $valor = 1;
    }else{
        $valor = 2;
    }

    mysql_close($con);

}

?>
        <br><br><br>
        <div class="titulos"> ENCUESTA SOCIO-DEMOGRAFICA</div>
        <br>
        <br>

        <form action="#"  method="POST">

            <br>
            <br>
            El proyecto titulado "Fortalecimiento de Competencia Digital Basado en Estilos de Aprendizaje: Estrategia Evaluativa para Estudiantes de Primer Semestre", es un estudio que consiste en un proceso de diseño, elaboración y evaluación de estrategias para el seguimiento valorativo de la competencia digital en contextos universitarios, con el fin de generar nuevas propuestas metodologías para el desempeño discente. Los datos aquí suministrados serán usados de forma anónima y solo para la caracterización de la población que participa en el estudio. Sus datos solo serán vistos por los investigadores vinculados al proyecto.
            <br>
            <br>
            <label for="Acuerdo">Acepta participar en el estudio:</label>
            <select name="Acuerdo" required>
            <option>Si</option>
            <option>No</option>
            </select>
            <br>
            <label for="Firma"> Firma:</label>
            <input type_="text" name="Firma" placeholder="Firma estudiante" required/><br>
            <br>
            <br>
            <br>

            <div class="titulos"> TEST DE ESTILOS DE APRENDIZAJE CHAEA</div>

        <p>&nbsp;</p>

            <input type="hidden" name="enviar" value="1">
        <table border="1" cellpadding="4" cellspacing="1" bordercolor="#566c21">

        <tr>
           <td align="center" width="65" bgcolor="#566c21"><font color="#ffff00" size="2" face="Arial">Más(+)</font></td>
           <td align="center" width="65" bgcolor="#566c21"><font color="#ffff00" size="2" face="Arial">Menos(-)</font></td>
           <td bgcolor="#566c21"><font color="#ffff00" size="3" face="Arial"><center><B>Ítem</B></center></font></td>
        </tr>
        <tr>
        <td align=center width=65><input type=radio name="preg1" value="+">+</td>
        <td align=center width=65><input type=radio name="preg1" value="-">-</td>
        <td><font size=2 face=Arial>1. Tengo fama de decir lo que pienso claramente y sin rodeos.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg2" value="+">+</td>
        <td align=center width=65><input type=radio name="preg2" value="-">-</td>
        <td><font size=2 face=Arial>2. Estoy seguro lo que es bueno y lo que es malo, lo que está bien y lo que está mal.</font></td>

        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg3" value="+">+</td>
        <td align=center width=65><input type=radio name="preg3" value="-">-</td>
        <td><font size=2 face=Arial>3. Muchas veces actúo sin mirar las consecuencias.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg4" value="+">+</td>
        <td align=center width=65><input type=radio name="preg4" value="-">-</td>
        <td><font size=2 face=Arial>4. Normalmente trato de resolver los problemas metódicamente y paso a paso.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg5" value="+">+</td>
        <td align=center width=65><input type=radio name="preg5" value="-">-</td>
        <td><font size=2 face=Arial>5. Creo que los formalismos coartan y limitan la actuación libre de las personas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg6" value="+">+</td>
        <td align=center width=65><input type=radio name="preg6" value="-">-</td>
        <td><font size=2 face=Arial>6. Me interesa saber cuáles son los sistemas de valores de los demás y con qué criterios actúan.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg7" value="+">+</td>
        <td align=center width=65><input type=radio name="preg7" value="-">-</td>
        <td><font size=2 face=Arial>7. Pienso que el actuar intuitivamente puede ser siempre tan válido como actuar reflexivamente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg8" value="+">+</td>
        <td align=center width=65><input type=radio name="preg8" value="-">-</td>
        <td><font size=2 face=Arial>8. Creo que lo más importante es que las cosas funcionen.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg9" value="+">+</td>
        <td align=center width=65><input type=radio name="preg9" value="-">-</td>
        <td><font size=2 face=Arial>9. Procuro estar al tanto de lo que ocurre aquí y ahora.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg10" value="+">+</td>
        <td align=center width=65><input type=radio name="preg10" value="-">-</td>
        <td><font size=2 face=Arial>10. Disfruto cuando tengo tiempo para preparar mi trabajo y realizarlo a conciencia.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg11" value="+">+</td>
        <td align=center width=65><input type=radio name="preg11" value="-">-</td>
        <td><font size=2 face=Arial>11. Estoy a gusto siguiendo un orden, en las comidas, en el estudio, haciendo ejercicio regularmente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg12" value="+">+</td>
        <td align=center width=65><input type=radio name="preg12" value="-">-</td>
        <td><font size=2 face=Arial>12. Cuando escucho una nueva idea en seguida comienzo a pensar cómo ponerla en práctica.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg13" value="+">+</td>
        <td align=center width=65><input type=radio name="preg13" value="-">-</td>
        <td><font size=2 face=Arial>13. Prefiero las ideas originales y novedosas aunque no sean prácticas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg14" value="+">+</td>
        <td align=center width=65><input type=radio name="preg14" value="-">-</td>
        <td><font size=2 face=Arial>14. Admito y me ajusto a las normas sólo si me sirven para lograr mis objetivos.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg15" value="+">+</td>
        <td align=center width=65><input type=radio name="preg15" value="-">-</td>
        <td><font size=2 face=Arial>15. Normalmente encajo bien con personas reflexivas, analíticas y me cuesta sintonizar con personas demasiado espontáneas, imprevisibles.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg16" value="+">+</td>
        <td align=center width=65><input type=radio name="preg16" value="-">-</td>
        <td><font size=2 face=Arial>16. Escucho con más frecuencia que hablo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg17" value="+">+</td>
        <td align=center width=65><input type=radio name="preg17" value="-">-</td>
        <td><font size=2 face=Arial>17. Prefiero las cosas estructuradas a las desordenadas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg18" value="+">+</td>
        <td align=center width=65><input type=radio name="preg18" value="-">-</td>
        <td><font size=2 face=Arial>18. Cuando poseo cualquier información, trato de interpretarla bien antes de manifestar alguna conclusión.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg19" value="+">+</td>
        <td align=center width=65><input type=radio name="preg19" value="-">-</td>
        <td><font size=2 face=Arial>19. Antes de tomar una decisión estudio con cuidado sus ventajas e inconvenientes.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg20" value="+">+</td>
        <td align=center width=65><input type=radio name="preg20" value="-">-</td>
        <td><font size=2 face=Arial>20. Me crezco con el reto de hacer algo nuevo y diferente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg21" value="+">+</td>
        <td align=center width=65><input type=radio name="preg21" value="-">-</td>
        <td><font size=2 face=Arial>21. Casi siempre procuro ser coherente con mis criterios y sistemas de valores. Tengo principios y los sigo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg22" value="+">+</td>
        <td align=center width=65><input type=radio name="preg22" value="-">-</td>
        <td><font size=2 face=Arial>22. Cuando hay una discusión no me gusta ir con rodeos.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg23" value="+">+</td>
        <td align=center width=65><input type=radio name="preg23" value="-">-</td>
        <td><font size=2 face=Arial>23. Me disgusta implicarme afectivamente en mi ambiente de trabajo. Prefiero mantener relaciones distantes.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg24" value="+">+</td>
        <td align=center width=65><input type=radio name="preg24" value="-">-</td>
        <td><font size=2 face=Arial>24. Me gustan más las personas realistas y concretas que las teóricas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg25" value="+">+</td>
        <td align=center width=65><input type=radio name="preg25" value="-">-</td>
        <td><font size=2 face=Arial>25. Me cuesta ser creativo/a, romper estructuras.</font></td>

        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg26" value="+">+</td>
        <td align=center width=65><input type=radio name="preg26" value="-">-</td>
        <td><font size=2 face=Arial>26. Me siento a gusto con personas espontáneas y divertidas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg27" value="+">+</td>
        <td align=center width=65><input type=radio name="preg27" value="-">-</td>
        <td><font size=2 face=Arial>27. La mayoría de las veces expreso abiertamente cómo me siento.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg28" value="+">+</td>
        <td align=center width=65><input type=radio name="preg28" value="-">-</td>
        <td><font size=2 face=Arial>28. Me gusta analizar y dar vueltas a las cosas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg29" value="+">+</td>
        <td align=center width=65><input type=radio name="preg29" value="-">-</td>
        <td><font size=2 face=Arial>29. Me molesta que la gente no se tome en serio las cosas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg30" value="+">+</td>
        <td align=center width=65><input type=radio name="preg30" value="-">-</td>
        <td><font size=2 face=Arial>30. Me atrae experimentar y practicar las últimas técnicas y novedades.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg31" value="+">+</td>
        <td align=center width=65><input type=radio name="preg31" value="-">-</td>
        <td><font size=2 face=Arial>31. Soy cauteloso/a a la hora de sacar conclusiones.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg32" value="+">+</td>
        <td align=center width=65><input type=radio name="preg32" value="-">-</td>
        <td><font size=2 face=Arial>32. Prefiero contar con el mayor número de fuentes de información. Cuantos más datos reúna para reflexionar, mejor.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg33" value="+">+</td>
        <td align=center width=65><input type=radio name="preg33" value="-">-</td>
        <td><font size=2 face=Arial>33. Tiendo a ser perfeccionista.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg34" value="+">+</td>
        <td align=center width=65><input type=radio name="preg34" value="-">-</td>
        <td><font size=2 face=Arial>34. Prefiero oír las opiniones de los demás antes de exponer la mía.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg35" value="+">+</td>
        <td align=center width=65><input type=radio name="preg35" value="-">-</td>
        <td><font size=2 face=Arial>35. Me gusta afrontar la vida espontáneamente y no tener que planificar todo previamente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg36" value="+">+</td>
        <td align=center width=65><input type=radio name="preg36" value="-">-</td>
        <td><font size=2 face=Arial>36. En las discusiones me gusta observar cómo actúan los demás participantes.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg37" value="+">+</td>
        <td align=center width=65><input type=radio name="preg37" value="-">-</td>
        <td><font size=2 face=Arial>37. Me siento incómodo con las personas calladas y demasiado analíticas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg38" value="+">+</td>
        <td align=center width=65><input type=radio name="preg38" value="-">-</td>
        <td><font size=2 face=Arial>38. Juzgo con frecuencia las ideas de los demás por su valor práctico.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg39" value="+">+</td>
        <td align=center width=65><input type=radio name="preg39" value="-">-</td>
        <td><font size=2 face=Arial>39. Me agobio si me obligan a acelerar mucho el trabajo para cumplir un plazo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg40" value="+">+</td>
        <td align=center width=65><input type=radio name="preg40" value="-">-</td>
        <td><font size=2 face=Arial>40. En las reuniones apoyo las ideas prácticas y realistas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg41" value="+">+</td>
        <td align=center width=65><input type=radio name="preg41" value="-">-</td>
        <td><font size=2 face=Arial>41. Es mejor gozar del momento presente que deleitarse pensando en el pasado o en el futuro.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg42" value="+">+</td>
        <td align=center width=65><input type=radio name="preg42" value="-">-</td>
        <td><font size=2 face=Arial>42. Me molestan las personas que siempre desean apresurar las cosas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg43" value="+">+</td>
        <td align=center width=65><input type=radio name="preg43" value="-">-</td>
        <td><font size=2 face=Arial>43. Aporto ideas nuevas y espontáneas en los grupos de discusión.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg44" value="+">+</td>
        <td align=center width=65><input type=radio name="preg44" value="-">-</td>
        <td><font size=2 face=Arial>44. Pienso que son más consistentes las decisiones fundamentadas en un minucioso análisis que las basadas en la intuición.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg45" value="+">+</td>
        <td align=center width=65><input type=radio name="preg45" value="-">-</td>
        <td><font size=2 face=Arial>45. Detecto frecuentemente la inconsistencia y puntos débiles en las argumentaciones de los demás.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg46" value="+">+</td>
        <td align=center width=65><input type=radio name="preg46" value="-">-</td>
        <td><font size=2 face=Arial>46. Creo que es preciso saltarse las normas muchas más veces que cumplirlas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg47" value="+">+</td>
        <td align=center width=65><input type=radio name="preg47" value="-">-</td>
        <td><font size=2 face=Arial>47. A menudo caigo en la cuenta de otras formas mejores y más prácticas de hacer las cosas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg48" value="+">+</td>
        <td align=center width=65><input type=radio name="preg48" value="-">-</td>
        <td><font size=2 face=Arial>48. En conjunto hablo más que escucho.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg49" value="+">+</td>
        <td align=center width=65><input type=radio name="preg49" value="-">-</td>
        <td><font size=2 face=Arial>49. Prefiero distanciarme de los hechos y observarlos desde otras perspectivas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg50" value="+">+</td>
        <td align=center width=65><input type=radio name="preg50" value="-">-</td>
        <td><font size=2 face=Arial>50. Estoy convencido/a que debe imponerse la lógica y el razonamiento.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg51" value="+">+</td>
        <td align=center width=65><input type=radio name="preg51" value="-">-</td>
        <td><font size=2 face=Arial>51. Me gusta buscar nuevas experiencias.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg52" value="+">+</td>
        <td align=center width=65><input type=radio name="preg52" value="-">-</td>
        <td><font size=2 face=Arial>52. Me gusta experimentar y aplicar las cosas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg53" value="+">+</td>
        <td align=center width=65><input type=radio name="preg53" value="-">-</td>
        <td><font size=2 face=Arial>53. Pienso que debemos llegar pronto al grano, al meollo de los temas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg54" value="+">+</td>
        <td align=center width=65><input type=radio name="preg54" value="-">-</td>
        <td><font size=2 face=Arial>54. Siempre trato de conseguir conclusiones e ideas claras.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg55" value="+">+</td>
        <td align=center width=65><input type=radio name="preg55" value="-">-</td>
        <td><font size=2 face=Arial>55. Prefiero discutir cuestiones concretas y no perder el tiempo con charlas vacías.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg56" value="+">+</td>
        <td align=center width=65><input type=radio name="preg56" value="-">-</td>
        <td><font size=2 face=Arial>56. Me impaciento con las argumentaciones irrelevantes e incoherentes en las reuniones.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg57" value="+">+</td>
        <td align=center width=65><input type=radio name="preg57" value="-">-</td>
        <td><font size=2 face=Arial>57. Compruebo antes si las cosas funcionan realmente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg58" value="+">+</td>
        <td align=center width=65><input type=radio name="preg58" value="-">-</td>
        <td><font size=2 face=Arial>58. Hago varios borradores antes de la redacción definitiva de un trabajo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg59" value="+">+</td>
        <td align=center width=65><input type=radio name="preg59" value="-">-</td>
        <td><font size=2 face=Arial>59. Soy consciente de que en las discusiones ayudo a los demás a mantenerse centrados en el tema, evitando divagaciones.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg60" value="+">+</td>
        <td align=center width=65><input type=radio name="preg60" value="-">-</td>
        <td><font size=2 face=Arial>60. Observo que, con frecuencia, soy uno de los más objetivos y desapasionados en las discusiones.</font></td>

        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg61" value="+">+</td>
        <td align=center width=65><input type=radio name="preg61" value="-">-</td>
        <td><font size=2 face=Arial>61. Cuando algo va mal, le quito importancia y trato de hacerlo mejor.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg62" value="+">+</td>
        <td align=center width=65><input type=radio name="preg62" value="-">-</td>
        <td><font size=2 face=Arial>62. Rechazo ideas originales y espontáneas si no las veo prácticas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg63" value="+">+</td>
        <td align=center width=65><input type=radio name="preg63" value="-">-</td>
        <td><font size=2 face=Arial>63. Me gusta sopesar diversas alternativas antes de tomar una decisión.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg64" value="+">+</td>
        <td align=center width=65><input type=radio name="preg64" value="-">-</td>
        <td><font size=2 face=Arial>64. Con frecuencia miro hacia adelante para prever el futuro.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg65" value="+">+</td>
        <td align=center width=65><input type=radio name="preg65" value="-">-</td>
        <td><font size=2 face=Arial>65. En los debates prefiero desempeñar un papel secundario antes que ser el líder o el que más participa.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg66" value="+">+</td>
        <td align=center width=65><input type=radio name="preg66" value="-">-</td>
        <td><font size=2 face=Arial>66. Me molestan las personas que no siguen un enfoque lógico.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg67" value="+">+</td>
        <td align=center width=65><input type=radio name="preg67" value="-">-</td>
        <td><font size=2 face=Arial>67. Me resulta incómodo tener que planificar y prever las cosas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg68" value="+">+</td>
        <td align=center width=65><input type=radio name="preg68" value="-">-</td>
        <td><font size=2 face=Arial>68. Creo que el fin justifica los medios en muchos casos.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg69" value="+">+</td>
        <td align=center width=65><input type=radio name="preg69" value="-">-</td>
        <td><font size=2 face=Arial>69. Suelo reflexionar sobre los asuntos y problemas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg70" value="+">+</td>
        <td align=center width=65><input type=radio name="preg70" value="-">-</td>
        <td><font size=2 face=Arial>70. El trabajar a conciencia me llena de satisfacción y orgullo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg71" value="+">+</td>
        <td align=center width=65><input type=radio name="preg71" value="-">-</td>
        <td><font size=2 face=Arial>71. Ante los acontecimientos trato de descubrir los principios y teorías en que se basan.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg72" value="+">+</td>
        <td align=center width=65><input type=radio name="preg72" value="-">-</td>
        <td><font size=2 face=Arial>72. Con tal de conseguir el objetivo que pretendo soy capaz de herir sentimientos ajenos.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg73" value="+">+</td>
        <td align=center width=65><input type=radio name="preg73" value="-">-</td>
        <td><font size=2 face=Arial>73. No me importa hacer todo lo necesario para que sea efectivo mi trabajo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg74" value="+">+</td>
        <td align=center width=65><input type=radio name="preg74" value="-">-</td>
        <td><font size=2 face=Arial>74. Con frecuencia soy una de las personas que más anima las fiestas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg75" value="+">+</td>
        <td align=center width=65><input type=radio name="preg75" value="-">-</td>
        <td><font size=2 face=Arial>75. Me aburro enseguida con el trabajo metódico y minucioso.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg76" value="+">+</td>
        <td align=center width=65><input type=radio name="preg76" value="-">-</td>
        <td><font size=2 face=Arial>76. La gente con frecuencia cree que soy poco sensible a sus sentimientos.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg77" value="+">+</td>
        <td align=center width=65><input type=radio name="preg77" value="-">-</td>
        <td><font size=2 face=Arial>77. Suelo dejarme llevar por mis intuiciones.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg78" value="+">+</td>
        <td align=center width=65><input type=radio name="preg78" value="-">-</td>
        <td><font size=2 face=Arial>78. Si trabajo en grupo procuro que se siga un método y un orden.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg79" value="+">+</td>
        <td align=center width=65><input type=radio name="preg79" value="-">-</td>
        <td><font size=2 face=Arial>79. Con frecuencia me interesa averiguar lo que piensa la gente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg80" value="+">+</td>
        <td align=center width=65><input type=radio name="preg80" value="-">-</td>
        <td><font size=2 face=Arial>80. Esquivo los temas subjetivos, ambiguos y poco claros.</font></td>
        </tr>
        </table>

        <br>
        <center>
        <p align="center">
            <input type="submit" value="Calcular valores de Estilos de Aprendizaje" >
            <input type="button" value="Atrás" onclick="window.location.href='test.php'">
        </p>

        </form>
        </center>
        <BR>
        <BR>

        <CENTER>

        <P><B><FONT COLOR="#566c21" FACE="ARIAL" size=-1>Copyright &copy; 2006-2008 estilosdeaprendizaje.es - Última revision 01/04/08<BR></FONT></B>
        <FONT COLOR="#566c21" FACE="ARIAL"><I><FONT SIZE=-1>CHAEA. Cuestionario Honey-Alonso de Estilos de Aprendizaje<BR>
        Autores: Catalina M. Alonso García y Domingo J. Gallego Gil
        <BR>
        Home Page y programación: José Luis García Cué</FONT></I> </FONT></P></CENTER>
    <?php
    include('partials/pie.html');
    ?>
