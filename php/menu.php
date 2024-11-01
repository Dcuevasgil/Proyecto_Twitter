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
    <title>Cabecera</title>
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
                <a href="pagina-principal.php">Inicio</a>
            </li>
            <li>
                <a href="userPerfil.php">Perfil</a>
            </li>
            <li>
                <a href="#">AAAA</a>
            </li>
            <li>
                <a href="back-logout.php">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>
    <main>
        <form action="../php/pagina-principal.php" method="post">
            <legend>Postear</legend>
            <fieldset>
                <textarea name="post" placeholder="¿Que estas pensando?"></textarea>
                <button class="btn">
                    <a href="../php/userPerfil.php">Publicar</a>
                </button>
            </fieldset>
        </form>
    </main>
</body>
</html>