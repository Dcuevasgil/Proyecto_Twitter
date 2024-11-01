<?php
    session_start();
    require_once('../connection/connection.php');

    $conexion = connection();
    $userId = $_POST['id'];
    $descripcion = trim($_POST['description']); // Elimina los espacios en blanco alrededor de la descripcion al enviarla

    if(empty($descripcion)) {
        $_SESSION['warning'] = "La descripción no puede ser nula ni estar vacía.";
        header("Location: editarPerfil.php");
        exit;
    }

    if($conexion) {
        $query = "SELECT * FROM social_network.users";
        $result = mysqli_prepare($conexion, $query);

        if ($result) {
            mysqli_stmt_execute($result);
            $resultados = mysqli_stmt_get_result($result);

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
            $_SESSION['list-user'] = $listUser;
            header("Location: lista-usuarios.php");
        } else {
            echo "Error al ejecutar la consulta";
        }
    } else {
        echo "No hay conexion con la base de datos";
    }
?>
