<?php
    // Inicio de la sesion del usuario
    session_start();
    // Conexión a la base de datos
    require_once('../connection/connection.php');
    echo "<br>";
    $conn = connection();

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    
    if(!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit;
    }

    // Obtener los datos del formulario
    $userId = $_POST['userId']; // Suponiendo que el ID del usuario está en la sesión
    $texto_publicacion = $_POST["text"]; // Cambiado a "text"

    // Preparar la sentencia SQL
    $sql = "INSERT INTO publications (userId, text, createDate) VALUES (?, ?, NOW())";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincula los parámetros
    $stmt->bind_param("ss", $userId, $texto_publicacion);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo "<br>Publicación guardada correctamente.";
        echo " <br>
        <button class='btn'>
            <a href='./pagina-principal.php'>Volver al inicio</a>
        </button>";
    } else {
        echo "Error al guardar la publicación: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close(); // Cerrar la sentencia

    $conn->close();
?>
