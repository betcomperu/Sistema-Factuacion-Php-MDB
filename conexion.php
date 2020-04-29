<?php

    $host="localhost";
    $user="root";
    $password="mysql";
    $db="facturacion";

    $cn = mysqli_connect($host, $user, $password, $db);

    if(!$cn){
        echo "Error en la conexión";
    }


?>