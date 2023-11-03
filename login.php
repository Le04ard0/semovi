<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Realiza la validación de credenciales en la base de datos
    $sql = "SELECT * FROM usuarios WHERE NUE = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["id_rol"] = $row["id_rol"];

        if ($row["id_rol"] == 1) {
            header("Location: administrador.php");
        } elseif ($row["id_rol"] == 2) {
            header("Location: agremiado.php");
        } else {
            echo "Rol desconocido";
        }
    } else {
        header("Location:index.html");
    }
}

$conn->close();
?>
