<?php
include('partials/head.php');
include('partials/nav.php');
if(isset($_POST['enviar']) == 1){
    //Contadores para almacenar la cantidad de cada tipo de estilo de aprendizaje
    $a=0;
    $r=0;
    $t=0;
    $p=0;

    if(count($_POST) > 1){
        $activo = array(3, 6, 9, 17, 26, 27, 29, 30, 39, 41);
        $reflexivo = array(5, 7, 11, 13, 20, 22, 24, 28, 38, 42, 44);
        $teorico = array(2, 4, 8, 12, 14, 23, 31, 32, 35, 37, 43);
        $pragmatico = array(1, 10, 15, 18, 19, 21, 25, 33, 34, 36, 40);

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
    //else{
      //  echo '<script language="JavaScript">alert("Hacen falta preguntas por responder");</script>';
    //}
}
?>

        <div class="titulos"> TEST DE ESTILOS DE APRENDIZAJE CHAEA JUNIOR</div>


        <p>&nbsp;</p>
        <form action="#" method="POST">
            <input type="hidden" name="enviar" value="1">
        <table border="1" cellpadding="4" cellspacing="1" bordercolor="#566c21">

        <tr>
           <td align="center" width="65" bgcolor="#566c21"><font color="#ffff00" size="2" face="Arial">Más(+)</font></td>
           <td align="center" width="65" bgcolor="#566c21"><font color="#ffff00" size="2" face="Arial">Menos(-)</font></td>
           <td bgcolor="#566c21"><font color="#ffff00" size="3" face="Arial"><center><B>Ítem</B></center></font></td>
        </tr>
        <tr>
        <td align=center width=65><input type=radio name="preg1" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg1" value="-" >-</td>
        <td><font size=2 face=Arial>1. La gente que me conoce opina de mí que digo las cosas tal y como las pienso.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg2" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg2" value="-" >-</td>
        <td><font size=2 face=Arial>2. Distingo claramente lo bueno de lo malo, lo que está bien y lo que está mal.</font></td>

        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg3" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg3" value="-" >-</td>
        <td><font size=2 face=Arial>3. Muchas veces actúo sin mirar las consecuencias.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg4" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg4" value="-" >-</td>
        <td><font size=2 face=Arial>4. Me interesa saber cómo piensan los demás y por qué motivos actúan.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg5" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg5" value="-" >-</td>
        <td><font size=2 face=Arial>5. Valoro mucho cuando me hacen un regalo que sea de gran utilidad.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg6" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg6" value="-" >-</td>
        <td><font size=2 face=Arial>6. Procuro enterarme de lo que ocurre en donde estoy.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg7" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg7" value="-" >-</td>
        <td><font size=2 face=Arial>7. Disfruto si tengo tiempo para preparar mi trabajo y hacerlo lo mejor posible.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg8" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg8" value="-" >-</td>
        <td><font size=2 face=Arial>8. Me gusta seguir un orden, en las comidas, en los estudios y hacer ejercicio físico con regularidad.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg9" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg9" value="-" >-</td>
        <td><font size=2 face=Arial>9. Prefiero las ideas originales y novedosas aunque no sean muy prácticas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg10" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg10" value="-" >-</td>
        <td><font size=2 face=Arial>10. Acepto y me ajusto a las normas sólo si sirven para lograr lo que me gusta.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg11" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg11" value="-" >-</td>
        <td><font size=2 face=Arial>11. Escucho más que hablo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg12" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg12" value="-" >-</td>
        <td><font size=2 face=Arial>12. En mi cuarto tengo generalmente las cosas ordenadas, pues no soporto el desorden.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg13" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg13" value="-" >-</td>
        <td><font size=2 face=Arial>13. Antes de hacer algo estudio con cuidado sus ventajas e inconvenientes.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg14" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg14" value="-" >-</td>
        <td><font size=2 face=Arial>14. En las actividades escolares pongo más interés cuando hago algo nuevo y diferente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg15" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg15" value="-" >-</td>
        <td><font size=2 face=Arial>15. En una discusión me gusta decir claramente lo que pienso.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg16" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg16" value="-" >-</td>
        <td><font size=2 face=Arial>16. Si juego, dejo los sentimientos por mis amigos a un lado, pues en el juego es importante ganar.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg17" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg17" value="-" >-</td>
        <td><font size=2 face=Arial>17. Me siento a gusto con las personas espontáneas y divertidas aunque a veces me den problemas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg18" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg18" value="-" >-</td>
        <td><font size=2 face=Arial>18. Expreso abiertamente como me siento.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg19" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg19" value="-" >-</td>
        <td><font size=2 face=Arial>19. Enlas reuniones y fiestas suelo ser el más divertido.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg20" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg20" value="-" >-</td>
        <td><font size=2 face=Arial>20. Me gusta analizar y dar vueltas a las cosas para lograr su solución.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg21" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg21" value="-" >-</td>
        <td><font size=2 face=Arial>21. Prefiero las ideas que sirven para algo ay que se puedan realizar a soñar o fantasear.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg22" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg22" value="-" >-</td>
        <td><font size=2 face=Arial>22. Tengo cuidado y pienso las cosas antes de sacar conclusiones.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg23" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg23" value="-" >-</td>
        <td><font size=2 face=Arial>23. Intento hacer las cosas para que me queden perfectas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg24" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg24" value="-" >-</td>
        <td><font size=2 face=Arial>24. Prefiero oír las opiniones de los demás antes de exponer la mía.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg25" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg25" value="-" >-</td>
        <td><font size=2 face=Arial>25. En las discusiones me gusta observar como actúan los demás participantes.</font></td>

        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg26" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg26" value="-" >-</td>
        <td><font size=2 face=Arial>26. Me disgusta estar con personas calladas y que piensan mucho todas las cosas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg27" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg27" value="-" >-</td>
        <td><font size=2 face=Arial>27. Me agobio si me obligan a acelerar mucho el trabajo para cumplir un plazo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg28" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg28" value="-" >-</td>
        <td><font size=2 face=Arial>28. Doy ideas nuevas y espontáneas en los trabajos en grupo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg29" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg29" value="-" >-</td>
        <td><font size=2 face=Arial>29. La mayoría de las veces creo que es preciso saltarse las normas más que cumplirlas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg30" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg30" value="-" >-</td>
        <td><font size=2 face=Arial>30. Cuando estoy con mis amigos hablo más que escucho.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg31" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg31" value="-" >-</td>
        <td><font size=2 face=Arial>31. Creo que, siempre, deben hacerse las cosas con lógica y de forma razonada.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg32" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg32" value="-" >-</td>
        <td><font size=2 face=Arial>32Me ponen nervioso/a aquellos que dicen cosas poco importantes o sin sentido.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg33" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg33" value="-" >-</td>
        <td><font size=2 face=Arial>33. Me gusta comprobar que las cosas funcionan realmente.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg34" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg34" value="-" >-</td>
        <td><font size=2 face=Arial>34. Rechazo las ideas originales y espontáneas si veo que no sirven para algo práctico.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg35" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg35" value="-" >-</td>
        <td><font size=2 face=Arial>35. Con frecuencia pienso en las consecuencias de mis actos para prever el futuro.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg36" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg36" value="-" >-</td>
        <td><font size=2 face=Arial>36. En muchas ocasiones, si se desea algo, no importa lo que se haga para conseguirlo.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg37" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg37" value="-" >-</td>
        <td><font size=2 face=Arial>37. Me molestan los compañeros y personas que hacen las cosas a lo loco.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg38" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg38" value="-" >-</td>
        <td><font size=2 face=Arial>38.Suelo reflexionar sobre los asuntos y problemas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg39" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg39" value="-" >-</td>
        <td><font size=2 face=Arial>39. Con frecuencia soy una de las personas que
        más animan las fiestas.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg40" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg40" value="-" >-</td>
        <td><font size=2 face=Arial>40. Los que me conocen suelen pensar que soy poco sensible a sus sentimientos.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg41" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg41" value="-" >-</td>
        <td><font size=2 face=Arial>41. Me cuesta mucho planificar mis tareas y preparar con tiempo mis exámenes.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg42" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg42" value="-" >-</td>
        <td><font size=2 face=Arial>42. Cuando trabajo en grupo me interesa saber lo que opinan los demás.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg43" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg43" value="-" >-</td>
        <td><font size=2 face=Arial>43. Me molesta que la gente no se tome las cosas en serio.</font></td>
        </tr>

        <tr>
        <td align=center width=65><input type=radio name="preg44" value="+" >+</td>
        <td align=center width=65><input type=radio name="preg44" value="-" >-</td>
        <td><font size=2 face=Arial>44. A menudo me doy cuenta de otras formas mejores de hacer las cosas.</font></td>
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
