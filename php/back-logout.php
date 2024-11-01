<?php
    session_start(); // Este metodo inicia la sesion siempre que se loguea el usuario
    session_unset(); // Este metodo borra los datos de la sesion
    session_destroy(); // Este metodo destruye la sesion del usuario
    
    header("Location: ../index.php");
    exit;
?>
