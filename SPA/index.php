<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi SPA en PHP</title>
    <style>
        nav a {
            margin-right: 10px;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Mi Web SPA</h1>

    <nav>
        <a data-page="home">Inicio</a>
        <a data-page="servicios">Servicios</a>
        <a data-page="contacto">Contacto</a>
    </nav>

    <div id="contenido">
        <!-- Aquí se carga el contenido dinámico -->
        <p>Cargando contenido...</p>
    </div>

    <script src="js/app.js"></script>
</body>
</html>
