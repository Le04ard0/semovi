<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Notificaciones</title>
    <!-- Tus estilos aquí -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #0074D9;
            text-align: center;
            margin: 20px 0;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
        }

        .button {
            background-color: #0074D9;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Enviar Notificaciones</h2>
    
    <!-- Formulario para enviar notificaciones -->
    <form method="POST" action="procesar_notificaciones.php"> <!-- Crea un archivo "procesar_notificaciones.php" para manejar el envío -->
        <label for="mensaje">Mensaje:</label>
        <textarea name="mensaje" id="mensaje" rows="4" required></textarea>

        <input type="submit" class="button" value="Enviar">
    </form>

    <!-- Más contenido de tu página principal aquí -->
</body>
</html>
