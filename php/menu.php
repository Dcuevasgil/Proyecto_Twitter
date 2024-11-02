<?php
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invitado';

    require_once('../connection/connection.php');

    $conexion = connection()
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Menu principal</title>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">
                <?php
                    echo "<img src='../assets/images/twitter.jpg' alt='Logo' class='logo' />"
                ?>
            </div>
            <div class="username">
                <?php
                    if (isset($_SESSION['nombre_usuario'])) {
                        echo htmlspecialchars($_SESSION['nombre_usuario']);
                    } else {
                        echo "<a class='enlace' href='userPerfil.php'>" . $username . "</a>"; // O mostrar el nombre de usuario en la barra de navegación o redirigirlo a la página de inicio de sesión si no hay sesión iniciada
                    }
                ?>
            </div>
        </div>
    </nav>
    <nav class="navegador-secundario">
        <ul>

            <li>
                <a href="userPerfil.php">Perfil</a>
            </li>
            <li>
                <a href="#">Seguidores</a>
            </li>
            <li>
                <a href="#">Seguidos</a>
            </li>
            <li>
                <a href="back-logout.php">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>
    <main>
        <section class="lista-mis-publicaciones">
            <form action="../php/back-postear.php" method="post">
                <legend>Postear</legend>
                <fieldset>
                    <input type="hidden" name="userId" value="
                        <?php
                            echo $_SESSION['id']
                        ?>
                    ">
                    <textarea name="text" placeholder="¿Que estas pensando?" required></textarea>
                    <button type="submit" class="btn">Publicar </button>
                </fieldset>
            </form>
        </section>

        <section class="publicaciones-usuarios">

        </section>
    </main>
</body>
</html>
