<?php
// Incluir el archivo de conexión a la base de datos
require_once "conexion.php";

// Definir variables para el filtro de fechas
$fechaInicio = "";
$fechaFin = "";

// Procesar el filtro si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaInicio = $_POST["fecha_inicio"];
    $fechaFin = $_POST["fecha_fin"];

    // Consulta SQL para obtener solicitudes dentro del rango de fechas
    $sql = "SELECT id_solicitud, NUE, fecha, ruta_archivo FROM solicitudes WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";

    // Ejecutar la consulta
    $resultado = $conn->query($sql);
} else {
    // Consulta SQL para obtener todas las solicitudes si no se aplica el filtro
    $sql = "SELECT id_solicitud, NUE, fecha, ruta_archivo FROM solicitudes";

    // Ejecutar la consulta
    $resultado = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Solicitudes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #0074D9;
            text-align: center;
            margin: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .filter-form {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-form label {
            font-weight: bold;
        }

        .filter-form input[type="date"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .filter-form input[type="submit"] {
            background-color: #0074D9;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #0074D9 ;
        }

        .download-button {
            padding: 5px 10px;
            background-color: #0074D9;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .download-button:hover {
            background-color: #0056b3;
        }

        .return-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #0074D9;
        }

        .return-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Listado de Solicitudes</h2>
        
        <!-- Formulario de filtro por fechas -->
        <form method="POST" class="filter-form">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fechaInicio; ?>">

            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="date" name="fecha_fin" id="fecha_fin" value="<?php echo $fechaFin; ?>">

            <input type="submit" value="Filtrar">
        </form>

        <table>
            <thead>
                <tr>
                    <th>NUE</th>
                    <th>Fecha</th>
                    <th>Descargar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["NUE"] . "</td>";
                        echo "<td>" . $fila["fecha"] . "</td>";
                        echo "<td><a class='download-button' href='" . $fila["ruta_archivo"] . "' download>Descargar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay solicitudes disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Enlace para regresar al Panel de Administrador -->
    

        <p class="return-link">
    <button onclick="window.location.href='administrador.php'" style="background-color: #0066CC; color: #fff; font-size: 20px;">Regresar al panel de administrador</button>
</p>



    </div>
</body>
</html>

