<?php
    session_start();
    require_once('../connection/connection.php');

    // Obtener datos del formulario
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $conexion = connection();

    if($conexion) {
        // Prepara la consulta para buscar al usuario por email
        $query = "SELECT * FROM social_network.users WHERE email = ?";
        $result = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($result, "s", $email);
        mysqli_stmt_execute($result);
        $resultados = mysqli_stmt_get_result($result);

        // Verificar si el usuario existe
        if($filas = mysqli_fetch_assoc($resultados)) {
            // Verificar la contraseña
            if(password_verify($password, $filas['password'])) {
                // Iniciar sesion y establecer variables de sesion
                $_SESSION['id'] = $filas['id'];
                $_SESSION['username'] = $filas['username'];

                // Redirigir a la pagina principal
                header("Location: ../php/pagina-principal.php");
                exit;
            } else {
                echo "Contrasena incorrecta";
                header("Location: ../index.php");
                exit;
            }
        } else {
            echo "El usuario no existe";
        }
    }

    mysqli_close($conexion);
?>
