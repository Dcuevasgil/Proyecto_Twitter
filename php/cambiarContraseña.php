<?php
session_start();
require_once('../connection/connection.php');

$conexion = connection();
$userId = $_SESSION['id'];

if ($conexion) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        // Verificar que la nueva contraseña y la confirmación coincidan
        if ($newPassword !== $confirmPassword) {
            echo "<p>Las contraseñas no coinciden.</p>";
        } else {
            // Obtener la contraseña actual del usuario
            $query = "SELECT password FROM social_network.users WHERE id = $userId";
            $result = mysqli_query($conexion, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                // Verificar la contraseña actual
                if (password_verify($currentPassword, $row['password'])) {
                    // Si es correcto, actualizar la contraseña
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateQuery = "UPDATE social_network.users SET password = '$hashedNewPassword' WHERE id = $userId";
                    if (mysqli_query($conexion, $updateQuery)) {
                        echo "<p>Contraseña cambiada con éxito.</p>";
                    } else {
                        echo "<p>Error al cambiar la contraseña: " . mysqli_error($conexion) . "</p>";
                    }
                } else {
                    echo "<p>La contraseña actual es incorrecta.</p>";
                }
            } else {
                echo "<p>Error en la consulta: " . mysqli_error($conexion) . "</p>";
            }
        }
    }
} else {
    echo "<p>Error en la conexión a la base de datos.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cambiar-contraseña.css">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <div class="container">
        <h2>Cambiar Contraseña</h2>
        <form method="POST" action="">
            <div class="form-group">
                <input type="password" name="current_password" placeholder="Contraseña Actual" required>
            </div>
            <div class="form-group">
                <input type="password" name="new_password" placeholder="Nueva Contraseña" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
            </div>
            <button type="submit">Cambiar Contraseña</button>
        </form>
        <a href="../php/userPerfil.php">Volver al perfil</a>
    </div>
</body>
</html>
