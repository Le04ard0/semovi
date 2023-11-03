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
            // Obtener la información sobre el archivo
            $nombreArchivo = $archivo["name"];
            $tipoArchivo = $archivo["type"];
            
            // Define un array con los tipos de archivos permitidos
            $tiposPermitidos = ["application/pdf", "image/jpeg", "image/png", "image/gif", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "text/plain"];
            
            // Verifica si el tipo de archivo está permitido
            if (in_array($tipoArchivo, $tiposPermitidos)) {
                $tempName = $archivo["tmp_name"];
                
                // Genera un nombre único para el archivo
                $nombreUnico = uniqid() . "_" . $nombreArchivo;
                
                // Define la ruta de destino donde se almacenará el archivo
                $rutaDestino = "archivos_solicitudes/" . $nombreUnico;
                
                // Mueve el archivo a la carpeta de destino
                if (move_uploaded_file($tempName, $rutaDestino)) {
                    // Prepara la consulta SQL para insertar el archivo en la tabla
                    $sql = "INSERT INTO solicitudes (NUE, ruta_archivo, fecha) VALUES (?, ?, now())";
                    
                    // Prepara la declaración
                    $stmt = $conn->prepare($sql);
                    
                    // Vincula los parámetros
                    $stmt->bind_param("ss", $username, $rutaDestino);
                    
                    // Ejecuta la consulta
                    if ($stmt->execute()) {
                        // El archivo se subió correctamente y se registró la solicitud
                        echo "<script>alert('El archivo se subió correctamente y se registró la solicitud.'); window.location.href='agremiado.php';</script>";
                        exit; // Termina el script para evitar que se siga ejecutando después de la redirección
                    } else {
                        echo "Error al registrar la solicitud en la base de datos: " . $conn->error;
                    }
                    
                    // Cierra la declaración
                    $stmt->close();
                } else {
                    echo "Error al mover el archivo a la carpeta de destino.";
                }
            } else {
                echo "Tipo de archivo no permitido. Sube archivos PDF, imágenes (JPEG, PNG, GIF) o archivos de texto (DOCX, TXT).";
            }
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
