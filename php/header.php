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
