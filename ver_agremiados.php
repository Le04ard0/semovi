<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agremiados</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Estilos adicionales según tus necesidades */
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #0074D9;
            margin-top: 0;
        }

        /* Establece la orientación de la página en horizontal */
        @page {
            size: landscape;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th, td {
            padding: 5px;
            text-align: left;
            border: 1px solid #000; /* Bordes negros sólidos en pantalla */
        }

        th {
            background-color: #0074D9;
            color: #fff;
        }

        /* Estilos para los botones */
        .button {
            display: inline-block;
            padding: 10px 5px;
            background-color: #0074D9;
            color: #fff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button-edit {
            background-color: #0056b3;
        }

        .button-delete {
            background-color: #d9534f;
        }

        .button:hover {
            background-color: #003c80;
        }

        .button-delete:hover {
            background-color: #c9302c;
        }

        /* Estilos para la versión de impresión */
        @media print {
            /* Agregamos bordes negros sólidos en la versión de impresión */
            th, td {
                border: 1px solid #000 !important; /* !important para asegurarse de que se apliquen */
            }

            /* Restablecemos los colores originales */
            th {
                background-color: #0074D9 !important;
                color: #fff !important;
            }

            /* Ocultar el botón de impresión en la vista de impresión */
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- Contenido principal -->
    <div class="content">
        <h2>Agremiados de la delegación A12345</h2>


        <!-- Botón para regresar al panel de administrador (con la clase "no-print") -->
        <a href="administrador.php" class="button no-print">Regresar al Panel de Administrador</a>

        <!-- Botón para imprimir la tabla -->
        <button onclick="window.print()" class="button no-print">Imprimir Lista</button>

        <!-- Tabla para mostrar la lista de agremiados -->
        <table>
            <thead>
                <tr>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombre(s)</th>
                    <th>Sexo</th>
                    <th>NUP</th>
                    <th>NUE</th>
                    <th>RFC</th>
                    <th>NSS</th>
                    <th>Fecha de nacimiento</th>
                    <th>Telefono</th>
                    <th>Cuota</th>
                    <th class="no-print">Acciones</th> <!-- Nueva columna para las acciones -->
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "conexion.php"; // Asegúrate de tener el archivo "conexion.php" con la configuración de la base de datos

                // Consulta para obtener la lista de agremiados
                $sql = "SELECT * FROM agremiados";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["a_paterno"] . "</td>";
                        echo "<td>" . $row["a_materno"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["sexo"] . "</td>";
                        echo "<td>" . $row["NUP"] . "</td>";
                        echo "<td>" . $row["NUE"] . "</td>";
                        echo "<td>" . $row["RFC"] . "</td>";
                        echo "<td>" . $row["NSS"] . "</td>";
                        echo "<td>" . $row["f_nacimiento"] . "</td>";
                        echo "<td>" . $row["telefono"] . "</td>";
                        echo "<td>" . $row["cuota"] . "</td>";
                        echo "<td class='no-print'>";
                        echo "<a href='editar_agremiado.php?id=" . $row["id_agremiado"] . "' class='button button-edit'>Editar</a>";
                        echo "<a href='eliminar_agremiado.php?id=" . $row["id_agremiado"] . "' class='button button-delete'>Eliminar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No se encontraron agremiados.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
