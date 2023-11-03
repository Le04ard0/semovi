<?php
session_start();
require_once "conexion.php";

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    
    // Verifica si se envió un archivo
    if (isset($_FILES["archivo"])) {
        $archivo = $_FILES["archivo"];
        
        // Verifica que no haya errores en la subida del archivo
        if ($archivo["error"] === UPLOAD_ERR_OK) {
            $temp_name = $archivo["tmp_name"];
            
            // Lee el contenido del archivo
            $file_data = file_get_contents($temp_name);
            
            // Escapa los datos para evitar problemas de SQL Injection
            $file_data = $conn->real_escape_string($file_data);
            
            // Prepara la consulta SQL para insertar el archivo en la tabla
            $sql = "INSERT INTO solicitudes (NUE, Solicitud) VALUES (?, ?)";
            
            // Prepara la declaración
            $stmt = $conn->prepare($sql);
            
            // Vincula los parámetros
            $stmt->bind_param("ss", $username, $file_data);
            
            // Ejecuta la consulta
            if ($stmt->execute()) {
                // El archivo se subió correctamente, ahora muestra una alerta con JavaScript
                echo "<script>alert('El archivo se subió correctamente y se registró la solicitud.'); window.location.href='agremiado.php';</script>";
                exit; // Termina el script para evitar que se siga ejecutando después de la redirección
            } else {
                echo "Error al registrar la solicitud en la base de datos: " . $conn->error;
            }
            
            // Cierra la declaración
            $stmt->close();
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "No se recibió ningún archivo.";
    }
    
    $conn->close();
} else {
    echo "Usuario no autenticado.";
}
?>
