<?php
// Verificar si el usuario es un administrador (debe tener su propio sistema de autenticación)

// Incluir el archivo de conexión a la base de datos
require_once "conexion.php";

if (isset($_GET["id"])) {
    $idSolicitud = $_GET["id"];
    
    // Consulta SQL para obtener la ruta del archivo
    $sql = "SELECT ruta_archivo FROM solicitudes WHERE id_solicitud = ?";
    
    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    
    // Vincular el parámetro
    $stmt->bind_param("i", $idSolicitud);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Vincular el resultado
    $stmt->bind_result($rutaArchivo);
    
    // Obtener la ruta del archivo
    if ($stmt->fetch()) {
        // Ruta completa al archivo
        $archivo = $rutaArchivo;
        
        // Verificar si el archivo existe
        if (file_exists($archivo)) {
            // Establecer las cabeceras para la descarga
            header("Content-Description: File Transfer");
            
            // Obtener el tipo MIME del archivo (esto es una forma básica, puedes mejorarla)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $archivo);
            finfo_close($finfo);
            header("Content-Type: " . $mime_type);
            
            header("Content-Disposition: attachment; filename=" . basename($archivo));
            header("Content-Length: " . filesize($archivo));
            ob_clean();
            flush();
            readfile($archivo);
            exit;
        } else {
            echo "El archivo no existe.";
        }
    } else {
        echo "Solicitud no encontrada.";
    }
    
    // Cerrar la declaración
    $stmt->close();
    
    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "Parámetros no válidos.";
}
?>
