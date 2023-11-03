<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección de Agremiado</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: 1fr 1fr; /* Divide la página en dos columnas */
            text-align: center; /* Alinea el contenido en el centro horizontal */
        }

        h2, h3 {
            margin-top: 20px; /* Agrega un margen superior para separarlos del borde superior */
            text-align: center; /* Centra el texto horizontalmente */
        }

        table-container {
            grid-column: span 2; /* Ocupa ambas columnas */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto; /* Centra la tabla horizontalmente en su contenedor */
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 4px; /* Reduce aún más el padding para hacer la tabla muy compacta */
            border-bottom: 1px solid #ddd;
            border-left: 1px solid #ddd; /* Agrega bordes izquierdos */
            border-right: 1px solid #ddd; /* Agrega bordes derechos */
            max-width: 50px; /* Ancho máximo muy reducido de las celdas */
            white-space: nowrap; /* Evita el salto de línea en el contenido largo */
            overflow: hidden;
            text-overflow: ellipsis; /* Agrega puntos suspensivos para contenido truncado */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .logout-link {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .upload-form {
            text-align: center; /* Centra el contenido horizontalmente */
            margin: 20px auto; /* Centra el formulario verticalmente y ajusta el margen */
            grid-column: 2; /* Coloca el formulario en la segunda columna */
        }

        .view-solicitudes {
            margin-top: 20px; /* Espacio adicional entre el botón y el formulario */
        }

        @media screen and (max-width: 600px) {
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <a class="logout-link" href="logout.php">Cerrar Sesión</a>
    <div>
        <h2>Delegación 6A302</h2>
        <h3>Datos del Usuario Actual</h3>
    </div>

    <table-container>
        <?php
        require_once "conexion.php";
        session_start();

        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];

            // Consulta para obtener los datos del usuario a partir de su NUE
            $sql = "SELECT * FROM agremiados WHERE NUE = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Mapeo de nombres de columnas de la base de datos a nombres personalizados
                $columnNames = array(
                    "id_agremiado" => "Identificador del Agremiado",
                    "a_paterno" => "Apellido Paterno",
                    "a_materno" => "Apellido Materno",
                    "nombre" => "Nombre(s)",
                    "sexo" => "Sexo",
                    "NUP" => "NUP",
                    "NUE" => "NUE",
                    "RFC" => "RFC",
                    "NSS" => "NSS",
                    "f_nacimiento" => "Fecha de Nacimiento",
                    "telefono" => "Teléfono",
                    "cuota" => "Cuota Sindical"
                );

        ?>

        <table>
            <?php
            foreach ($row as $key => $value) {
                $label = $columnNames[$key]; // Obtener el nombre personalizado
                echo "<tr>";
                echo "<td><label for='$key'>$label</label></td>";
                echo "<td>$value</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
            } else {
                echo "No se encontraron datos para este usuario.";
            }
        } else {
            echo "Usuario no autenticado.";
        }

        $conn->close();
        ?>
    </table-container>

    <div class="upload-form">
        <form action="subir_archivo.php" method="POST" enctype="multipart/form-data">
            <h3>Subir Solicitud</h3>
            <input type="file" name="archivo" accept=".pdf, .docx, .jpg, .png" required>
            <input type="submit" value="Enviar">
        </form>
    </div>

    <div class="view-solicitudes">
        <a href="ver_solicitudes.php">Ver Solicitudes</a>
    </div>
</body>
</html>
