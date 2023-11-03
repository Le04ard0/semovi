<?php
require_once "conexion.php"; // Asegúrate de tener el archivo "conexion.php" con la configuración de la base de datos

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $a_paterno = $_POST["a_paterno"];
    $a_materno = $_POST["a_materno"];
    $nombre = $_POST["nombre"];
    $genero = $_POST["genero"];
    $nup = $_POST["nup"];
    $nue = $_POST["nue"];
    $rfc = $_POST["rfc"];
    $nss = $_POST["nss"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $telefono = $_POST["telefono"];
    $cuota = $_POST["cuota"];

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO agremiados (a_paterno, a_materno, nombre, sexo, NUP, NUE, RFC, NSS, f_nacimiento, telefono, cuota) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Enlaza los parámetros
        $stmt->bind_param("sssssssssss", $a_paterno, $a_materno, $nombre, $genero, $nup, $nue, $rfc, $nss, $fecha_nacimiento, $telefono, $cuota);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            $mensaje = "Agremiado agregado correctamente.";
        } else {
            $mensaje = "Error al agregar el agremiado: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensaje = "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Agremiado</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       
       /* Estilos que ya están incluidos en tu archivo */
        /* ... (los estilos previos) ... */
    </style>
</head>
<body>
    <!-- Formulario para agregar un agremiado -->

    <form action="agregar_agremiado.php" method="POST">
        <!-- Los campos del formulario (ya están en el código previo) -->
        <!-- ... (los campos previos) ... -->

        <!-- Botón para agregar agremiado -->
        <input type="submit" class="button" value="Agregar Agremiado">
        <a href="administrador.php" class="button">Regresar al Panel de Administrador</a>
    </form>

    <!-- Muestra mensajes de éxito o error -->
    <p class="message"><?php if (isset($mensaje)) echo $mensaje; ?></p>
</body>
</html>
