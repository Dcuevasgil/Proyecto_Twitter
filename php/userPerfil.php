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
                
                    <!-- <section class="lista-mis-publicaciones">
                        <div class="contenedor">
                            <h2>Últimas Publicaciones</h2>

                            <?php
                            session_start();
                            require_once("../connection/connection.php");
                            $conexion = connection();

                            // Verifica la conexión a la base de datos
                            if (!$conexion) {
                                die("Error al conectar a la base de datos: " . mysqli_connect_error());
                            }

                            $userId = $_SESSION['id'];
                            $publicacion = $_POST['text'] ?? null;
                            $createDate = date("Y-m-d");

                            // Valida los datos de entrada
                            if ($userId && !empty($publicacion)) {

                                // Sanitiza la entrada para evitar la inyección de código SQL
                                $publicacion = mysqli_real_escape_string($conexion, $publicacion);

                                // Inserta la publicación en la base de datos
                                $query = "INSERT INTO social_network.publications (userId, text, createDate) VALUES (?, ?, ?)";
                                $stmt = $conexion->prepare($query);
                                $stmt->bind_param("iss", $userId, $publicacion, $createDate);

                                if ($stmt->execute()) {
                                    // Redirigir a la página de inicio después de una inserción exitosa
                                    header("Location: ./pagina-principal.php");
                                    exit;
                                } else {
                                    echo "Error al guardar la publicación: " . $stmt->error;
                                }

                                $stmt->close();
                            }

                            $conexion->close();
                            ?>
                        </div>
                    </section> -->
                </main>

                <footer>
                    <div class="container">
                        <p>&copy;
                            <?php
                                echo date("Y");
                            ?>
                            Codigo hecho por David
                        </p>
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
