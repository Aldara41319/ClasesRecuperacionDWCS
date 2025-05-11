<?php
// Si se recibe una petición POST con lat y lon, se devuelve la altitud.
if (isset($_POST['lat']) && isset($_POST['lon'])) {
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    function getElevationOpenMeteo($lat, $lon) {
        $url = "https://api.open-meteo.com/v1/elevation?latitude=$lat&longitude=$lon";
        $response = file_get_contents($url);
        $data = json_decode($response);
        if (isset($data->elevation[0])) {
            return $data->elevation[0];
        } else {
            return null;
        }
    }

    $elevation = getElevationOpenMeteo($lat, $lon);
    echo $elevation !== null ? $elevation : "Error";
    exit; // Finaliza para que no cargue el HTML de abajo en la respuesta AJAX
}
?>

<?php
    $latitude=42.343059;
    $longitude=-7.870041;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Mapa con Altitud</title>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .leaflet-container {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>

<div id="map" style="width: 800px; height: 600px;"></div>

<script>
    const map = L.map('map').setView([<?php echo "$latitude" ?>, <?php echo "$longitude" ?>], 15);

    map.doubleClickZoom.disable();

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 25
    }).addTo(map);

    map.on('dblclick', function(e) {
        const lat = e.latlng.lat;
        const lon = e.latlng.lng;

        // Enviar coordenadas al mismo archivo PHP mediante fetch (AJAX)
        fetch("", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `lat=${lat}&lon=${lon}`
        })
        .then(response => response.text())
        .then(data => {
            alert("Altitud: " + data + " metros");
        })
        .catch(error => {
            alert("Error al obtener la altitud.");
            console.error(error);
        });
    });
</script>

</body>
</html>
