<?php

function getElevationOpenMeteo($lat, $lon) {

// API de Open-Meteo para altitud
$url = "https://api.open-meteo.com/v1/elevation?latitude=$lat&longitude=$lon";

// Obtener la respuesta de la API
$response = file_get_contents($url);

// Decodificar JSON como un objeto
$data = json_decode($response);

// Comprobar altitud (elevation)
    if (isset($data->elevation[0])) {

        return $data->elevation[0] . " metros";

    } else {

        return "Error obteniendo la elevación.";

    }

}



// Coordenadas de Ourense (aproximadas)

$latOurense = 42.3362;

$lonOurense = -7.8683;



echo "Altitud en Ourense: " . getElevationOpenMeteo($latOurense, $lonOurense);
?>