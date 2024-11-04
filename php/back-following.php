<?php
// Inicio de la sesion del usuario
session_start();
// Conexión a la base de datos
require_once('../connection/connection.php');
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
$userFollowId = $_POST['userId']; // Suponiendo que el ID del usuario está en la sesión
$userId = $_SESSION['id'];
$action = $_POST['action'];
$postUsername = $_POST['postUsername'];
$redireccionPage = $_POST['perfilPage'];
unset($_SESSION['followingUser']);
if($action == "Follow") {
    $sql = "INSERT INTO follows (users_id, userToFollowId) VALUES (?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincula los parámetros
    $stmt->bind_param("ss", $userId, $userFollowId);
    if ($stmt->execute()) {
        $_SESSION['followingUser'] = "<p>Ahora estás siguiendo a $postUsername</p>";
    } else {
        echo "Error al seguir a $postUsername: " . $stmt->error;
    }
}

if($action == "UnFollow") {
    $sql = "DELETE FROM follows WHERE users_id = ? AND userToFollowId = ?";
    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    // Vincula los parámetros
    $stmt->bind_param("ss", $userId, $userFollowId);
    if ($stmt->execute()) {
        $_SESSION['followingUser'] = "<p>Has dejado de seguir a $postUsername</p>";
    } else {
        echo "Error al dejar de seguir a $username: " . $stmt->error;
    }
}

// Ejecutar la sentencia
$query = "SELECT * FROM users WHERE id = '$userFollowId' LIMIT 1";
$result = $conn->query($query);
$result = $result->fetch_all(MYSQLI_ASSOC);
// Cerrar la conexión
$stmt->close(); // Cerrar la sentencia

$conn->close();
if($redireccionPage == "userList") {
    header("Location: ../php/lista-usuarios.php?userId=$userFollowId");
} elseif($redireccionPage == "perfilPage") {
    header("Location: ../php/userPerfil.php?userId=$userFollowId");
} else {
    header("Location: ../php/pagina-principal.php");
}
?>