<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="../php/back-register.php" method="POST">
        <legend>Registro</legend>
        <fieldset>
            <input type="text" name="username" placeholder="Username" required>
    
            <input type="email" name="email" placeholder="Email" required>
    
            <input type="password" name="password" placeholder="Password" required>
            
            <input type="password" name="passConfirm" placeholder="Confirm Password" required>

            <button type="submit">
                Registrarse
            </button>
        </fieldset>
    </form>
</body>
</html>

