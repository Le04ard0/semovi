<?php
// Verificar si se ha enviado un formulario para editar el agremiado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí deberías validar y sanitizar los datos del formulario antes de usarlos en la consulta SQL

    // Conectar a la base de datos (asegúrate de tener la configuración en "conexion.php")
    require_once "conexion.php";

    // Recoger los datos del formulario
    $id_agremiado = $_POST["id_agremiado"];
    $a_paterno = $_POST["a_paterno"];
    $a_materno = $_POST["a_materno"];
    $nombre = $_POST["nombre"];
    // Agregar aquí los otros campos que deseas editar

    // Consulta SQL para actualizar los datos del agremiado
    $sql = "UPDATE agremiados SET a_paterno=?, a_materno=?, nombre=? WHERE id_agremiado=?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Enlazar los parámetros
        $stmt->bind_param("sssi", $a_paterno, $a_materno, $nombre, $id_agremiado);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir al usuario de nuevo a la lista de agremiados o a donde lo necesites
            header("Location: ver_agremiados.php");
            exit();
        } else {
            echo "Error al actualizar el agremiado: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Obtener el ID del agremiado a editar desde la URL
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id_agremiado = $_GET["id"];

        // Conectar a la base de datos (asegúrate de tener la configuración en "conexion.php")
        require_once "conexion.php";

        // Consulta SQL para obtener los datos del agremiado por su ID
        $sql = "SELECT * FROM agremiados WHERE id_agremiado = ?";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Enlazar el parámetro
            $stmt->bind_param("i", $id_agremiado);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el resultado de la consulta
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                // Obtener los datos del agremiado
                $row = $result->fetch_assoc();
                $a_paterno = $row["a_paterno"];
                $a_materno = $row["a_materno"];
                $nombre = $row["nombre"];
                // Agregar aquí los otros campos que deseas editar
            } else {
                echo "No se encontró ningún agremiado con ese ID.";
                exit();
            }

            // Cerrar la conexión
            $stmt->close();
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "ID de agremiado no válido.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Agremiado</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Estilos adicionales según tus necesidades */
    </style>
</head>
<body>
    <!-- Contenido principal -->
    <div class="content">
        <h2>Editar Agremiado</h2>

        <!-- Formulario para editar el agremiado -->
        <form action="editar_agremiado.php" method="post">
            <!-- Campo oculto para enviar el ID del agremiado -->
            <input type="hidden" name="id_agremiado" value="<?php echo $id_agremiado; ?>">

            <label for="a_paterno">Apellido Paterno:</label>
            <input type="text" name="a_paterno" id="a_paterno" value="<?php echo $a_paterno; ?>" required><br><br>

            <label for="a_materno">Apellido Materno:</label>
            <input type="text" name="a_materno" id="a_materno" value="<?php echo $a_materno; ?>" required><br><br>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required><br><br>

            <!-- Otros campos para los datos del agremiado -->

            <input type="submit" value="Guardar Cambios">
        </form>

        <!-- Enlace para regresar a la lista de agremiados -->
        <a href="ver_agremiados.php">Regresar a la Lista de Agremiados</a>
    </div>
</body>
</html>
