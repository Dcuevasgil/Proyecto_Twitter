<?php
    session_start();
    require_once('../connection/connection.php');

    $conexion = connection();

    if($conexion) {
        $query = "SELECT * FROM social_network.users";
        $result = mysqli_prepare($conexion, $query);


        mysqli_stmt_execute($result);
        $resultados = mysqli_stmt_get_result($result);

    } else {
        echo "No hay conexion con la base de datos";
    }

    $listUser = '';
    while($filas = mysqli_fetch_assoc($resultados)) {
        $listUser = $listUser.'
            <li>
                <div class="info-user">
                    <img src="../assets/images/logo_usuario.png" alt="">
                    <a href="../php/perfil.php?userId='.$filas['id'].'">'.$filas['username'].'</a>
                </div>
            </li>
            ';
    }
    $_SESSION['list-user'];
    header("Location: lista-usuarios.php");
?>
