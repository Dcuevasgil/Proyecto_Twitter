<?php
    session_start();
    require_once('../connection/connection.php');
    $conexion = connection();

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invitado';
    if(!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit;
        echo $_SESSION['id'] . " " . $_SESSION['username'];
    }

    $queryFollow = "SELECT userToFollowId FROM follows WHERE users_id = ".$_SESSION['id']." ORDER BY users_id DESC;";
    $follow = $conexion->query($queryFollow);
    $follows = $follow->fetch_all(MYSQLI_ASSOC);
    $myFollows = [];
    foreach($follows as $key) {
        array_push($myFollows, $key['userToFollowId']);
    }

    if($conexion) {
        $uId = $_SESSION['id'];
        $query =
        "SELECT * FROM users u1 WHERE u1.id IN
        (SELECT users_id FROM follows where userToFollowId = ".$uId.");";
        $result = mysqli_prepare($conexion, $query);


        mysqli_stmt_execute($result);
        $resultados = mysqli_stmt_get_result($result);

    } else {
        echo "No hay conexion con la base de datos";
    }

    $listUser = '';
    while($filas = mysqli_fetch_assoc($resultados)) {
        if(!in_array($filas['id'], $myFollows)) {
            $listUser = $listUser.'
                <li>
                    <div class="info-user">
                        <img src="../assets/images/logo_usuario.png" alt="">
                        <a href="../php/perfil.php?userId='.$filas['id'].'">'.$filas['username'].'</a>
                        <div class="botones">
                            <form action="../php/back-following.php" method="POST">
                                <input type="hidden" name="userId" value="'.$filas['id'].'">
                                <input type="hidden" name="perfilPage" value="userList">
                                <input type="hidden" name="postUsername" value="'.$filas['username'].'">
                                <input type="hidden" name="action" value="Follow">
                                <button type="submit" class="btn btn-primary" name="seguir">Seguir</button>
                            </form>
                        </div>
                    </div>
                </li>
            ';
        } else {
            $listUser = $listUser.'
                <li>
                    <div class="info-user">
                        <img src="../assets/images/logo_usuario.png" alt="">
                        <a href="../php/perfil.php?userId='.$filas['id'].'">'.$filas['username'].'</a>
                        <div class="botones">
                            <form action="../php/back-following.php" method="POST">
                                <input type="hidden" name="userId" value="'.$filas['id'].'">
                                <input type="hidden" name="perfilPage" value="userList">
                                <input type="hidden" name="postUsername" value="'.$filas['username'].'">
                                <input type="hidden" name="action" value="UnFollow">
                                <button type="submit" class="btn btn-primary" name="siguiendo">Siguiendo</button>
                            </form>
                        </div>
                    </div>
                </li>
            ';
        }

    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Lista de usuarios</title>
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
        <div class="content">
                <div class="lista-usuarios">
                    <ul>
                        <?php
                            echo $listUser;
                        ?>
                    </ul>
                </div>

            </div>
        </main>
        
    </div>
</body>
</html>

