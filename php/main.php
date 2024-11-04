<?php
require_once('../connection/connection.php');
$conexion = connection();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener todas las publicaciones
$sql = "SELECT * FROM publications p LEFT JOIN users u ON u.id = p.userId ORDER BY p.id DESC;";
$result = $conexion->query($sql);
$queryFollow = "SELECT userToFollowId FROM follows WHERE users_id = " . $_SESSION['id'] . " ORDER BY users_id DESC;";
$follow = $conexion->query($queryFollow);
$follows = $follow->fetch_all(MYSQLI_ASSOC);
$myFollows = [];
foreach ($follows as $key) {
    array_push($myFollows, $key['userToFollowId']);
}
// $myFollows = json_encode($myFollows);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="botones-primarios">
        <a href="./pagina-principal.php">
            <button class="active btn-primary">
                Para ti
            </button>
        </a>
        <a href="./publicaciones-seguidos.php">
            <button class="btn-primary">
                Siguiendo
            </button>
        </a>
    </div>
    <section class="publicaciones-usuarios">
        <?php

        if (isset($_SESSION['followingUser'])) {
            echo $_SESSION['followingUser'];
            unset($_SESSION['followingUser']);
        }
        // Verificamos si hay publicaciones
        if ($result->num_rows > 0) {
            // Recorremos cada publicación
            while ($row = $result->fetch_assoc()) {
                $textPublication = htmlspecialchars($row['text']);
                $fecha = htmlspecialchars($row['createDate']);
                $userId = htmlspecialchars($row['userId']);
                $postUsername = htmlspecialchars($row['username'])
        ?>
                <div class="card">
                    <div class="card-body">
                        <a href="../php/userPerfil.php?userId=
                            <?php
                            echo $userId;
                            ?>">
                        </a>
                        <?php
                        // var_dump(in_array($userId, $myFollows), $userId);
                        $publicInfoUser = '';
                        if ($userId ==  $_SESSION['id']) {
                            $publicInfoUser = '
                                    <h5 class="card-title">
                                        <a href="../php/userPerfil.php?userId=' . $userId . '">' . $postUsername . '</a>
                                    </h5>
                                    ';
                        } elseif (!in_array($userId, $myFollows)) {
                            $publicInfoUser = '
                                    <h5 class="card-title">
                                        <a href="../php/userPerfil.php?userId=' . $userId . '">' . $postUsername . '</a>
                                        <form action="../php/back-following.php" method="POST">
                                            <input type="hidden" name="userId" value="' . $userId . '">
                                            <input type="hidden" name="postUsername" value="' . $postUsername . '">
                                            <input type="hidden" name="action" value="Follow">
                                            <button type="submit" class="btn btn-primary" name="seguir">Seguir</button>
                                        </form>
                                    </h5>
                                    ';
                        } else {
                            $publicInfoUser = '
                                    <h5 class="card-title">
                                        <a href="../php/userPerfil.php?userId=' . $userId . '">' . $postUsername . '</a>
                                        <form action="../php/back-following.php" method="POST">
                                            <input type="hidden" name="userId" value="' . $userId . '">
                                            <input type="hidden" name="postUsername" value="' . $postUsername . '">
                                            <input type="hidden" name="action" value="UnFollow">
                                            <button type="submit" class="btn btn-primary" name="siguiendo">Siguiendo</button>
                                        </form>
                                    </h5>
                                    ';
                        }
                        echo $publicInfoUser;

                        ?>
                        <p class="card-text"><?php echo $textPublication; ?></p>
                        <p class="card-date">
                            <small class="text-muted">Publicado el <?php echo $fecha; ?></small>
                        </p>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>No hay publicaciones para mostrar.</p>";
        }
        // Liberamos el resultado y cerramos la conexión
        $result->free();
        ?>
    </section>
</body>

</html>