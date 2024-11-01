<?php
    session_start();
    require_once('../connection/connection.php');

    $conexion = connection();
    $userId = $_SESSION['id'];

    if($conexion) {
        $query = "SELECT * FROM social_network.users WHERE id = $userId";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo "<br>";
            echo "ID: " . $row['id'] . "<br>";
            echo "Username: " . $row['username'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
            echo "Password: " . $row['password'] . "<br>";
            echo "Description: " . $row['description'] . "<br>";
            echo "CreateDate: " . $row['createDate'] . "<br>";
            echo "<br>";
            echo "<form method='post' action='../php/back-userPerfil.php'>";
            echo  "<legend>Editar Perfil</legend>";

            echo "Username: <input type='text' name='username' value='" . $row['username'] . "'><br>";
            echo "Email: <input type='text' name='email' value='" . $row['email'] . "'><br>";
            echo "Password: <input type='password' name='password' value='" . $row['password'] . "'><br>";
            echo "Description: <textarea name='description'>" . $row['description'] . "</textarea><br>";
            if (!empty($row['description'])) {
                echo "Description: <textarea name='description'>" . htmlspecialchars($row['description']) . "</textarea><br>";
            }

            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button class='btn'>Modificar Datos</button>";
            echo "
                <button class='btn'>
                    <a href='../php/userPerfil.php'>Volver</a>
                </button>";
            echo "</form>";
        } else {
            echo "Error al obtener datos del usuario.";
        }
    } else {
        echo "Error al conectar con la base de datos.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editar-perfil.css">
    <title>Editar Perfil</title>
</head>
<body>
</body>
</html>
