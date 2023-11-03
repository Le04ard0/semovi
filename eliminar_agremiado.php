<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && is_numeric($_GET["id"])) {
    // Obtener el ID del agremiado a eliminar desde la URL
    $id_agremiado = $_GET["id"];

    // Conectar a la base de datos (asegúrate de tener la configuración en "conexion.php")
    require_once "conexion.php";

    // Consulta SQL para obtener los datos del agremiado antes de eliminarlo (puedes personalizarla según tus necesidades)
    $sql_select = "SELECT a_paterno, a_materno, nombre FROM agremiados WHERE id_agremiado = ?";
    
    // Preparar la consulta de selección
    $stmt_select = $conn->prepare($sql_select);

    if ($stmt_select) {
        // Enlazar el parámetro
        $stmt_select->bind_param("i", $id_agremiado);

        // Ejecutar la consulta de selección
        $stmt_select->execute();

        // Enlazar los resultados
        $stmt_select->bind_result($a_paterno, $a_materno, $nombre);

        if ($stmt_select->fetch()) {
            // Mostrar una alerta de confirmación antes de eliminar
            echo "<script>";
            echo "if (confirm('¿Estás seguro de que deseas eliminar a $nombre $a_paterno $a_materno?')) {";
            echo "  window.location.href = 'eliminar_agremiado_confirmed.php?id=$id_agremiado';";
            echo "} else {";
            echo "  window.location.href = 'ver_agremiados.php';"; // Redirigir de vuelta a la lista de agremiados
            echo "}";
            echo "</script>";
        } else {
            echo "No se encontró el agremiado.";
        }

        // Cerrar la consulta de selección
        $stmt_select->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de agremiado no válido.";
    exit();
}
?>
