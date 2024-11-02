<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="shortcut icon" href="./assets/images/twitter.jpg" type="image/x-icon">
    <title>Registro</title>
</head>
<body>
    <div class="image">
        <img src="./assets/images/twitter-borde.jpg" alt="Logo de Twitter">
    </div>
    <form action="./php/back-login.php" method="POST">
        <fieldset>
            <legend>Login</legend>
            <input type="email" name="email" placeholder="Email" required>
    
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Loguearse</button>

            <p>¿No tienes cuenta? <a href="./php/registerForm.php">Registrate</a></p>
        </fieldset>
    </form>
</body>
</html>

<!-- // Esta linea convierte caracteres especiales en su representacion HTML
    // La constante ENT_QUOTES se utiliza con la funcion "htmlspecialchars()" para especificar como se deben controlar las comillas al escapar los caracteres especiales
    // 'UTF-8' especifica la codificacion de caracyeres que se deben usar para procesar las cadenas de entrada
    // Elimina el elemento de la matriz asociativa de la sesion -->