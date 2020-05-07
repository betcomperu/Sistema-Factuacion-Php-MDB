<?php

    $host="localhost";
    $user="root";
    $password="mysql";
    $db="facturacion";

    $cn = new mysqli($host, $user, $password, $db);
    mysqli_query($cn,"SET NAMES 'utf8'");

    if(!$cn){
        echo "Error en la conexión";
    }


?>