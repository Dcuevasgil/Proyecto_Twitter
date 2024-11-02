<?php
    session_start(); // Inicia una nueva sesión o reanuda una sesión existente
    // Verifica si existe una sesión previa, si existe, reanuda la sesion del usuario;  si no existe, crea una nueva sesión
    // Despues de iniciar la sesion, se pueden almacenar datos en la variable $_SESSION[''] para ser utilizados en diferentes paginas
    session_unset(); // Libera todas las variables de sesion. Esto significa que elimina todas las variables almacenadas en la sesion actual pero no destruye la sesion.
    session_destroy(); // Este metodo destruye la sesion del usuario
    
    header("Location: ../index.php");
    exit;
?>
