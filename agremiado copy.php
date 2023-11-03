<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel de Agremiado</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Panel de Agremiado</h2>
        <h3>Datos del Usuario</h3>
        <?php
        require_once "conexion.php";

        // Obtener el nombre de usuario del usuario autenticado (NUE)
        session_start();
        $username = $_SESSION["username"];

        // Consulta para obtener los datos del usuario a partir de su NUE
        $sql = "SELECT * FROM agremiados WHERE NUE = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $nombreCompleto = $row["a_paterno"] . ' ' . $row["a_materno"] . ' ' . $row["nombre"];
            $sexo = $row["sexo"];
            $RFC = $row["RFC"];
            $NSS = $row["NSS"];
            $f_nacimiento = $row["f_nacimiento"];
            $telefono = $row["telefono"];
            $cuota = $row["cuota"];

            // Mostrar los datos del usuario
            echo "<form>";
            echo "<label for='nombreCompleto'>Nombre Completo:</label>";
            echo "<input type='text' id='nombreCompleto' value='$nombreCompleto' disabled><br><br>";

            echo "<label for='sexo'>Sexo:</label>";
            echo "<input type='text' id='sexo' value='$sexo' disabled><br><br>";

            echo "<label for='RFC'>RFC:</label>";
            echo "<input type='text' id='RFC' value='$RFC' disabled><br><br>";

            echo "<label for='NSS'>NSS:</label>";
            echo "<input type='text' id='NSS' value='$NSS' disabled><br><br>";

            echo "<label for='f_nacimiento'>Fecha de Nacimiento:</label>";
            echo "<input type='text' id='f_nacimiento' value='$f_nacimiento' disabled><br><br>";

            echo "<label for='telefono'>Teléfono:</label>";
            echo "<input type='text' id='telefono' value='$telefono' disabled><br><br>";

            echo "<label for='cuota'>Cuota:</label>";
            echo "<input type='text' id='cuota' value='$cuota' disabled><br><br>";

            echo "</form>";
        } else {
            echo "No se encontraron datos para este usuario.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
