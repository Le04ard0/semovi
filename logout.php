<?php
// Inicia la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión o a donde desees
header("Location: index.html");
exit;
?>
