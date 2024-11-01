<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit;
        echo $_SESSION['id'] . " " . $_SESSION['username'];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Pagina de inicio</title>
</head>
<body>
    <?php
        include_once "menu.php";
    ?>
    <div class="content"></div>
    <div class="section">
        <?php
            if(isset($_SESSION['save-tweet'])) {
                echo $_SESSION['save-tweet'];
                unset($_SESSION['save-tweet']);
            }
        ?>
    </div>
</body>
</html>
