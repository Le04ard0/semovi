<?php
require_once "conexion.php"; // Incluye el archivo de conexión a la base de datos

// Incluir la biblioteca Twilio PHP
require_once 'vendor/autoload.php';

// Configuración de Twilio
$sid = 'TU_SID_DE_TWILIO'; // Reemplaza con tu SID de Twilio
$token = 'TU_TOKEN_DE_AUTENTICACION'; // Reemplaza con tu token de autenticación de Twilio
$from = 'NUMERO_DE_TWILIO'; // Reemplaza con tu número de Twilio (debe ser un número verificado)

// Crear el cliente de Twilio
$twilio = new Twilio\Rest\Client($sid, $token);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el mensaje ingresado en el formulario
    $mensaje = $_POST["mensaje"];

    // Consulta SQL para obtener todos los números de teléfono
    $sql = "SELECT telefono FROM agremiados";

    // Ejecutar la consulta
    $resultado = $conn->query($sql);

    // Enviar el mensaje a cada número de teléfono
    while ($fila = $resultado->fetch_assoc()) {
        $numeroTelefono = $fila["telefono"];

        // Enviar el mensaje usando Twilio
        $message = $twilio->messages->create(
            $numeroTelefono,
            array(
                'from' => $from,
                'body' => $mensaje
            )
        );
    }

    // Cierra la conexión a la base de datos
    $conn->close();

    // Redirige al usuario de vuelta a la página de notificaciones o a donde desees
    header("Location: notificaciones.php");
    exit();
}
?>
