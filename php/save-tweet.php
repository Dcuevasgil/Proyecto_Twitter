<?php
    session_start();
    require_once('../connection/connection.php');
    $conexion = connection();

    $tweet = $_POST['tweet'];
    $userId = $_SESSION['id'];
    $fecha = date("Y-m-d");

    if($conexion) {
        $query = "INSERT INTO publications (userId, text, createDate) VALUES (?, ?, ?)";
        $result = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($result, "sss", $userId, $tweet, $fecha);
        if(mysqli_stmt_execute($result)) {
            $_SESSION['save-tweet'] =
            "<div class='message-tweet-save'>
                <p>Tweet guardado exitosamente</p>
            </div>";
        } else {
            $_SESSION['save-tweet'] =
            "<div class='message-tweet-save'>
                <p>No se guardo tu Tweet</p>
            </div>";
        }
    } else {
        echo "No hay conexion con la base de datos";
    }
    header("Location: pagina-principal.php");
