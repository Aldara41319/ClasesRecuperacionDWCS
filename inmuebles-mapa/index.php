<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root'; // Cambia esto si usas otro usuario
$pass = '';     // Cambia esto si tienes contraseña
$dbname = 'inmuebles';

$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT local, latitud, longitud FROM ubicaciones";
$result = $conn->query($sql);

$datos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $datos[] = [
            "text" => $row["local"],
            "latitude" => $row["latitud"],
            "longitude" => $row["longitud"],
            "url" => "#" // Puedes poner una URL real si tienes
        ];
    }
} else {
    die("No se encontraron registros.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Mapa con Leaflet</title>
	
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>

</head>
<body>

<div id="map" style="width: 800px; height: 600px;"></div>

<script>
	// Crear el mapa
	const map = L.map('map').setView([42.3368, -7.8649], 14); // Centrado en Ourense

	// Agregar capa de OpenStreetMap
	L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,		
	}).addTo(map);

	// Datos PHP -> JavaScript
	const locations = <?php echo json_encode($datos, JSON_PRETTY_PRINT); ?>;

	// Recorrer ubicaciones y añadir marcadores
	locations.forEach(location => {
		L.marker([location.latitude, location.longitude]).addTo(map)
			.bindPopup(`<strong>${location.text}</strong><br><a href="${location.url}"`);
	});
</script>

</body>
</html>
