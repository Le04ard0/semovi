<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #D7BDE2 ;
        }

        /* Estilo del navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #CCEAF4; /* Fondo del navbar */
            color: #fff; /* Texto en el navbar */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 100;
            padding: 10px 0;
        }

        .navbar h2 {
            text-align: left;
            margin: 0;
            background-color: #CCEAF4; /* Fondo más oscuro para resaltar el texto */
            padding: 10px 0;
        }

        .navbar ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center; /* Distribución espaciada de elementos */
            background-color: #CCEAF4; /* Color de fondo del navbar */
            margin: 0; /* Elimina el margen para alinear con el título */
            padding: 0 20px; /* Espaciado entre los elementos */
        }

        .navbar ul li {
            margin-right: 15px;
        }

        .navbar ul li:last-child {
            margin-right: 0;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #090909;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px; /* Bordes redondeados para los enlaces */
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar ul li a:hover {
            background-color: #0056b3;
            color: #fff;
        }

        /* Estilo del contenido principal con imagen de fondo */
        .content {
            padding-top: 200px;
            padding: 200px;
            background-image: url('imagenes/logo_semovi.png'); /* Ruta de tu imagen de fondo */
            background-size:cover; /* Ajusta la imagen al tamaño del contenedor */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            margin: 20px;
            border-radius: 10px; /* Bordes redondeados para el contenido */
            color: #D7BDE2 ; /* Texto en el contenido */
        }

        /* Estilos adicionales según tus necesidades */
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <h2>Panel de Administrador</h2>
     
        <ul>
            <li><a href="agregar_agremiado.html">Agregar Agremiado</a></li>
            <li><a href="ver_agremiados.php">Ver Agremiados</a></li>
            <li><a href="solicitudes.php">Ver Solicitudes</a></li>
            <li><a href="Notificaciones.php">Enviar avisos</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <!-- Contenido principal aquí -->
    </div>
</body>
</html>
