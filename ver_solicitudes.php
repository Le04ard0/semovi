<?php
// Incluir el archivo de conexión a la base de datos
require_once "conexion.php";

// Verificar si el usuario está autenticado (cambia esto según tu sistema de autenticación)
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.html"); // Redirige al usuario no autenticado al inicio
    exit();
}

// Obtener el nombre de usuario activo
$username = $_SESSION["username"];

// Consulta SQL para obtener las solicitudes del usuario activo
$sql = "SELECT * FROM solicitudes WHERE NUE = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Solicitudes</title>
    <style>
        /* Estilos CSS aquí */
    </style>
</head>
<body>
    <h2>Mis Solicitudes</h2>
    <table>
        <thead>
            <tr>
                <th>ID Solicitud</th>
                <th>Fecha</th>
                <th>Descargar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["id_solicitud"] . "</td>";
                    echo "<td>" . $fila["fecha"] . "</td>";
                    echo "<td><a class='download-button' href='" . $fila["ruta_archivo"] . "' download>Descargar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No has subido ninguna solicitud.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Enlace para regresar al Panel de Agremiado -->
    <p><a href="agremiado.php" class="button">Volver al Panel de Agremiado</a></p>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>
