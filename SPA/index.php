<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SPA en PHP</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>✨ Mi Sitio SPA</h1>
        <nav>
            <a data-page="home">Inicio</a>
            <a data-page="servicios">Servicios</a>
            <a data-page="contacto">Contacto</a>
        </nav>
    </header>

    <main>
        <div id="loader">Cargando...</div>
        <div id="contenido"></div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Mi Sitio SPA. Todos los derechos reservados.</p>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>
