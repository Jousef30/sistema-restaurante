<?php
    $host = "bmcrjxbkell3hhyvuz2t-mysql.services.clever-cloud.com";
    $user = "uxurmjcmet9ae6ry";
    $clave = "EzeiBHLQFG74PK22w1zO";
    $bd = "bmcrjxbkell3hhyvuz2t";
    $puerto = 3306;
    $conexion = mysqli_connect($host,$user,$clave,$bd);
    if (mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos";
        exit();
    }
    mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos");
    mysqli_set_charset($conexion,"utf8");
?>
