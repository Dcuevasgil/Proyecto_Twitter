<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit;
        echo $_SESSION['id'] . " " . $_SESSION['username'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="content">
    <?php
    include "menu.php";
    ?>
        <div class="lista-usuarios">
            <ul>
                <?php
                    echo $_SESSION['list-user'];
                ?>
                <button class="seguir">Seguir</button>
                <button class="seguimiento"></button>
            </ul>
        </div>

    </div>
</body>
</html>