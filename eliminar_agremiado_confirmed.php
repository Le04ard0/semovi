<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && is_numeric($_GET["id"])) {
    // Obtener el ID del agremiado a eliminar desde la URL
    $id_agremiado = $_GET["id"];

    // Conectar a la base de datos (asegúrate de tener la configuración en "conexion.php")
    require_once "conexion.php";

    // Consulta SQL para eliminar el agremiado
    $sql_delete = "DELETE FROM agremiados WHERE id_agremiado = ?";

    // Preparar la consulta de eliminación
    $stmt_delete = $conn->prepare($sql_delete);

    if ($stmt_delete) {
        // Enlazar el parámetro
        $stmt_delete->bind_param("i", $id_agremiado);

        // Ejecutar la consulta de eliminación
        if ($stmt_delete->execute()) {
            echo "Agremiado eliminado correctamente.";
       
        } else {
            echo "Error al eliminar el agremiado: " . $stmt_delete->error;
        }

        // Cerrar la consulta de eliminación
        $stmt_delete->close();
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
