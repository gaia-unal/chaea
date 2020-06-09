<?php

/**
* Class DB
*
* @package system/DB.php
*
* @author Johan Navarro
* @date 23/05/2017
* 
* pasos conexión php con BD
* 1. conexión con el  servidor de datos
* 2. conexión con la base de datos
* 3. hacer la consulta SQL
* 4. extraer informacion
* 5. cierre de la conexión
*
*/
class DB {
    //variable global declarada para establecer la conexión con la base de datos.
    private $connection;
    const SERVER    = "127.0.0.1";
    const PORT      = "5432";
    const DATA_BASE = "chaea";
    const USER      = "postgres";
    const PASSWORD  = "%froac$";

    public function __construct(){
      #connect();
    }

    /**
    * CUMPLE CON EL PASO 1 Y PASO 2, es el metodo de construcción donde se establece
    * la conección con la base de datos y el servidor postgresql.
    *
    */
    public function connect(){
        global $connection;
        $connection=pg_connect("host='".self::SERVER."'
                                port='".self::PORT."'
                                dbname='".self::DATA_BASE."'
                                user='".self::USER."'
                                password='".self::PASSWORD."'");
        if(!$connection){
            echo"<p><center><h1>No hay conexión con la base de datos. <br> INTENTE MAS TARDE</h1></center></p>";
            exit;
        }else{
            // echo"<p><center><h1>Conexión exitosa</center></p>";
        }
    }

    /**
    * CUMPLE CON EL PASO 3, 4
    *
    * @param    string  Sentencia SQL
    * @return   array   Resultado de la consulta SQL
    */
    public function executeQuery($sql){
        global $connection;
        #echo $connection;
        return pg_fetch_all(pg_query($connection, $sql));
    }

    /**
    * CUMPLE CON EL PASO 3, 4
    *
    * @param string $sql
    * @return array resultado de la consulta sql, extrae un unico registro.
    */
    public function consultarUnRegistro($sql){
        $arreglo = executeQuery($sql);
        return $arreglo[0];
    }

    /**
    * CUMPLE CON EL PASO 3 para consultas sql de update, insert o delete.
    *
    * @param string $sql
    */
    public function operacionesCrud($sql){
        global $connection;
        pg_query($connection, $sql);
    }

    /**
    * CUMPLE CON EL PASO 5 cierre de la conexión
    */
    public function closeConnect(){
        global $connection;
        pg_close($connection);
    }
}
?>
