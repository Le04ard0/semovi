<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Solicitudes</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin-top: 20px;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            width: 80%;
        }

        li {
            background-color: #f2f2f2;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .solicitud {
            flex: 1;
        }

        .solicitud a {
            text-decoration: none;
            color: #333;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Solicitudes del Usuario</h2>

    <ul>
        <?php
        require_once "conexion.php"; // Asegúrate de tener el archivo "conexion.php" con la configuración de la base de datos

        session_start();

        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];

            // Consulta para obtener las solicitudes del usuario basadas en su NUE
            $sql = "SELECT * FROM solicitudes WHERE NUE = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<div class='solicitud'>";
                    echo "<a href='descargar_solicitud.php?id=" . $row['id_solicitud'] . "'>" . $row["Solicitud"] . "</a>"; // Enlaza a un script de descarga
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "<li>No se encontraron solicitudes para este usuario.</li>";
            }
        } else {
            echo "<li>Usuario no autenticado.</li>";
        }

        $conn->close();
        ?>
    </ul>

    <div class="back-link">
        <a href="agremiado.php">Volver a la página principal</a>
    </div>
</body>
</html>
