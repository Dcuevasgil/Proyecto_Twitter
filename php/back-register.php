<?php
    require_once("../connection/connection.php");
    $conexion = connection();

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    } else {
        echo "Conexión exitosa.";
    }

    // Configurar el conjunto de caracteres y activar el modo de errores
    $conexion->set_charset("utf8");
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $user = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $passConfirm = $_POST['passConfirm'] ?? null;
    $description = '';
    $createDate = date("Y-m-d H:m:s");

    if ($user && $email && $password && $passConfirm) {
        if ($password === $passConfirm) {
            // Encriptar la contraseña
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Preparar la consulta
            $sql = "INSERT INTO users (username, email, password, description, createDate) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sssss", $user, $email, $hashedPassword, $description, $createDate);

                // Ejecutar la consulta y verificar el resultado
                if ($stmt->execute()) {
                    echo "Registro insertado correctamente.";
                    echo "<button>
                                <a href='../index.php'>Volver al inicio</a>
                          </button>";
                } else {
                    echo "Error en la ejecución: " . $stmt->error;
                }

                $stmt->close(); // Liberar el statement
            } else {
                echo "Error en la preparación de la consulta.";
            }

        } else {
            echo "Las contraseñas no coinciden.";
            echo "
                <button>
                    <a href='../index.php'>Volver</a>
                </button>";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
?>

