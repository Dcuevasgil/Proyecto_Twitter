<?php
session_start();
require_once('../connection/connection.php');

$conexion = connection();

if (!isset($_SESSION['id'])) {
    echo "<p>Inicia sesión para ver esta página.</p>";
    echo "<button>
                <a href='login.php'>Iniciar sesión</a>
            </button>";
    exit;
}

$userId = $_SESSION['id'];

if ($conexion) {
    $query = "SELECT * FROM social_network.users WHERE id = $userId";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/perfil.css">
            <title>Perfil</title>
        </head>
        <body>
            <main>
                <section class="perfil">
                    <div class="container">
                        <div class="info-usuario">
                            <h1 class="titulo">Tu perfil</h1>
                            <img src="../assets/images/logo_usuario.png" alt="Foto de perfil" width="40">
                            <h2 class="nombre-usuario">
                                <?php
                                    echo htmlspecialchars($row['username']);
                                ?>
                            </h2>
                            <p>
                                <?php
                                    echo "@" . htmlspecialchars($row['email']);
                                ?>
                            </p>
                            <p>Miembro desde:
                                <?php
                                    echo htmlspecialchars($row['createDate']);
                                ?>
                            </p>
                        </div>

                        <div class="botones">
                            <button class="btn">
                                <a href="./editarPerfil.php">Editar perfil</a>
                            </button>
                            <button class="btn">
                                <a href="./cambiarContraseña.php">Cambiar contraseña</a>
                            </button>
                            <button class="btn">
                                <a href="./back-logout.php">Cerrar sesión</a>
                            </button>
                            <button class="btn">
                                <a href="./pagina-principal.php">Inicio</a>
                            </button>
                        </div>
                        <br>
                    </div>
                </section>
            </main>

            <footer>
                <div class="container">
                    <p>&copy; <?php echo date("Y"); ?> Red Social. Todos los derechos reservados.</p>
                </div>
            </footer>

        </body>
        </html>
        <?php
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "Error en la conexión a la base de datos.";
}
?>
