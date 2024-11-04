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
    <div class="container">
        <header>
            <?php
                include_once('./header.php');
            ?>
        </header>
        <aside class="sidebar">
            <?php
                include_once('./sidebar.php');
            ?>
        </aside>
        <main>
            <?php
                include_once('./main.php');
            ?>
        </main>
        <aside class="sidebar-two">
            <?php
                include_once('./sidebar-two.php');
            ?>
        </aside>
    </div>
</body>
</html>
