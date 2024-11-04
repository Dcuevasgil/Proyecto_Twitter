<?php
session_start();
require_once('../connection/connection.php');

$conexion = connection();

if (!isset($_SESSION['id'])) {
    echo "<p>Inicia sesión para ver esta página.</p>";
    echo "<button>
                <a href='../index.php'>Iniciar sesión</a>
            </button>";
    exit;
}

$fechaActual = date("Y-m-d H:i:s"); // Corregido para el formato de fecha

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if(isset($_GET['userId'])) {
    $userId = $_GET['userId'];
} else {
    $userId = $_SESSION['id']; // ID del usuario que se ha logueado
}

// Consulta para obtener todas las publicaciones
$sql = "SELECT * FROM users WHERE id = $userId";
$result = mysqli_query($conexion, $sql);
$queryFollow = "SELECT userToFollowId FROM follows WHERE users_id = ".$_SESSION['id']." ORDER BY users_id DESC;";
$follow = $conexion->query($queryFollow);
$follows = $follow->fetch_all(MYSQLI_ASSOC);
$myFollows = [];
foreach($follows as $key) {
    array_push($myFollows, $key['userToFollowId']);
}

if($result) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    // Consulta para obtener solo las publicaciones del usuario logueado
    $query = "SELECT * FROM publications WHERE userId = $userId ORDER BY id DESC";
    $publicaciones = $conexion->query($query);
    ?>
    
    
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <title>Perfil</title>
</head>
<body>
    <div class="container">
        <header>
            <?php
                include_once('header.php');
            ?>
        </header>
        <aside class="sidebar">
            <?php
                include_once('sidebar.php');
            ?>
        </aside>
        <main>
            <section class="perfil">
                <div class="container">
                    <div class="info-usuario">
                        <h1 class="titulo">Tu perfil</h1>
                        <img src="../assets/images/logo_usuario.png" alt="Foto de perfil" width="40">
                        <h2 class="nombre-usuario"><?php echo htmlspecialchars($row['username']); ?></h2>
                        <p><?php echo "@" . htmlspecialchars($row['email']); ?></p>
                        <p>Miembro desde: <?php echo htmlspecialchars($row['createDate']); ?></p>
                    </div>

                    <?php
                        if(isset($_GET['userId']) && $_GET['userId'] != $_SESSION['id']) {
                            if(!in_array($userId, $myFollows)) {
                                echo $publicInfoUser = '
                                <div class="botones">
                                    <form action="../php/back-following.php" method="POST">
                                        <input type="hidden" name="userId" value="'.$userId.'">
                                        <input type="hidden" name="perfilPage" value="perfilPage">
                                        <input type="hidden" name="postUsername" value="'.htmlspecialchars($row['username']).'">
                                        <input type="hidden" name="action" value="Follow">
                                        <button type="submit" class="btn btn-primary" name="seguir">Seguir</button>
                                    </form>
                                </div>
                                ';
                            } else {
                                echo $publicInfoUser = '
                                <div class="botones">
                                    <form action="../php/back-following.php" method="POST">
                                        <input type="hidden" name="userId" value="'.$userId.'">
                                        <input type="hidden" name="perfilPage" value="perfilPage">
                                        <input type="hidden" name="postUsername" value="'.htmlspecialchars($row['username']).'">
                                        <input type="hidden" name="action" value="UnFollow">
                                        <button type="submit" class="btn btn-primary" name="siguiendo">Siguiendo</button>
                                    </form>
                                </div>
                                ';
                            }
                        } else {
                            echo '
                            <div class="botones">
                                <button class="btn"><a href="./editarPerfil.php">Editar perfil</a></button>
                                <button class="btn"><a href="./cambiarContraseña.php">Cambiar contraseña</a></button>
                                <button class="btn"><a href="./back-logout.php">Cerrar sesión</a></button>
                                <button class="btn"><a href="./pagina-principal.php">Inicio</a></button>
                            </div>';
                        }
                    ?>
                    <br>
                </div>
            </section>
            <section class="perfil publicaciones-footer">
                <div class="container">
                    <h2 class="titulo">Mis publicaciones</h2>
                    <section class="publicaciones-usuarios">
                        <?php
                        if ($publicaciones->num_rows > 0) {
                            while ($pub = $publicaciones->fetch_assoc()) {
                                $textPublication = htmlspecialchars($pub['text']);
                                $fecha = htmlspecialchars($pub['createDate']);
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $username; ?></h5>
                                        <p class="card-text"><?php echo $textPublication; ?></p>
                                        <p class="card-date">
                                            <small class="text-muted">Publicado el <?php echo $fecha; ?></small>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p>No tienes publicaciones aún.</p>";
                        }
                        $publicaciones->free();
                        ?>
                    </section>
                </div>
            </section>
        </main>
        <aside class="sidebar-two">
            <?php
                include_once('sidebar-two.php');
            ?>
        </aside>
    </div>
</body>
</html>

<?php
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invitado';

    require_once('../connection/connection.php');

    $conexion = connection()
?>


    <?php
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
?>
