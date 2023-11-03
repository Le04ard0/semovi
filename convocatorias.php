<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descarga de Formatos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: le;
            margin-top: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            background-color: #7f69a5;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        a:hover {
            background-color: #0056b3;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-regresar {
            background-color: #0074D9;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-regresar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="btn-container">
            <a href="index.html" class="btn-regresar">Regresar</a>
        </div>

    <div class="container">
        <ul>
            <?php
            $carpeta = 'convocatorias';
            $archivos = scandir($carpeta);

            foreach ($archivos as $archivo) {
                if ($archivo !== '.' && $archivo !== '..') {
                    $rutaArchivo = "$carpeta/$archivo";
                    echo "<li><a href=\"$rutaArchivo\" download>$archivo</a></li>";
                }
            }
            ?>
        </ul>
        <!-- Contenedor para centrar el botón -->
        
    </div>
</body>
</html>
