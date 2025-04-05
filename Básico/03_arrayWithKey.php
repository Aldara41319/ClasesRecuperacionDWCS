<?php 
    // Definir el array
    $phone_numbers = [
        "Alex" => "415-235-8573",
        "Jessica" => "415-492-4856",
    ];
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array with keys</title>
</head>
<body>
  
<!-- Mostrar datos de cada uno -->
<h2>Forma de mostrar los datos a través de la clave</h2>
<p>Con <strong>print_r()</strong> o <strong> $nameVariable["nameKey"]</strong>: </p>
<p>Alex's phone number is <strong> <?php echo $phone_numbers["Alex"] ?> </strong> </p>
<p>Jessica's phone number is <strong> <?php echo $phone_numbers["Jessica"] ?> </strong> </p>

<br>
<h3>Añadir al array</h3>
<!-- AÑADIR AL ARRAY --> 
<p>Sintaxis: <strong> $nameVariable["nameNewKey"] = "newValue" </strong> </p> 
<?php
    $phone_numbers["Michael"] = "415-955-3857";
?>

<!-- Mostrar lo nuevo -->  
<p>Mostrar con lo nuevo: <strong> <?php echo print_r($phone_numbers) ?> </strong> </p>
 
<br>
<h3>Comprobar si existe</h3>
<!-- COMPROBAR SI EXISTE UN ELEMENTO -->  
 <p>Comprobar si existe algo, usamos <strong>array_key_exists("Key", $nameVariable)</strong> </p>
<?php 
    if (array_key_exists("Alex", $phone_numbers)) {
        echo '<p>'."Alex's phone number is "."<strong>". $phone_numbers["Alex"] ."</strong>".'</p>' ;
    } else {
        echo "Alex's phone number is not in the phone book!";
    }
?>

<br>
<h3>Mostrar la llave</h3>
<!-- Mostrar la llave del array -->
<p>Mostrar con lo nuevo: <strong> <?php echo print_r($phone_numbers) ?> </strong> </p>

<?php echo print_r(array_keys($phone_numbers)) ?>

</body>
</html>