<?php
$servername = "localhost"; // Cambia a la dirección de tu servidor de base de datos si es diferente.
$username = "root"; // Cambia a tu nombre de usuario de MySQL.
$password = ""; // Cambia a tu contraseña de MySQL.
$dbname = "delegacion_3a602"; // Cambia al nombre de tu base de datos.

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Configurar la codificación de caracteres a UTF-8
$conn->set_charset("utf8");

?>
