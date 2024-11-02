<?php

    // Inicio de la sesion del usuario
    session_start();
    // Conexión a la base de datos
    require_once('../connection/connection.php');
    include("menu.php");
    echo "<br>";
    $conn = connection();

    // Verificar la conexión
    if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el nombre de usuario
    // $username = $_POST["username"];

    // Obtener los datos de la tabla users
    $sql_users_publications = "SELECT u.username, p.text, p.createDate
    FROM users u JOIN publications p ON u.id = p.userId;";

    $result_sql_users = $conn->query($sql_users_publications);
    $result_sql_users = $conn->query($sql_users_publications);

    // Verificar si se encontró el nombre de usuario
    if ($result_users->num_rows > 0) {
    // Obtener el userId
    $row_users = $result_users->fetch_assoc();
    $userId = $row_users["userId"];

        // Verificar si se encontraron publicaciones
        if ($result_publications->num_rows > 0) {
            // Mostrar los datos de las publicaciones
            echo "<table>";
                echo "<tr>
                            <th>userId</th>
                            <th>text</th>
                            <th>createDate</th>
                    </tr>";
                while ($row_publications = $result_publications->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>" . $row_publications["userId"] . "</td>";
                        echo "<td>" . $row_publications["text"] . "</td>";
                        echo "<td>" . $row_publications["createDate"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
        }
    } else {
        echo "Nombre de usuario no encontrado.";
    }

    // Cerrar la conexión
    $conn->close();
