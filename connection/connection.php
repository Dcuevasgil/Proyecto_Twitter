<?php

function connection() {
    $host = "localhost:3306";

    $user = "root";

    $pass = "root";

    $bd = "social_network";

    $connect = mysqli_connect($host, $user, $pass);

    if(!$connect) {
        echo "Error de conexion";
    } else {
        echo "Conectado";
    }

    mysqli_select_db($connect, $bd);

    return $connect;
}

connection();