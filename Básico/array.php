<?php 
    // Crear un array
    $array = [1, 4, 5, 7, 2];

    // Añadir un número al final 
    array_push($array, 4);
    // Eliminar último elemento
    array_pop($array);

    // Añadir un número al principio 
    array_unshift($array, 0);
    // Eliminar el primer elemento
    array_shift($array);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
    <style>
        p{ font-size: 18px; }
    </style>
</head>
<body>

<!-- MOSTRAR EL ARRAY -->
<p>Array -> <strong> <?php  echo implode(', ', $array) ?> </strong> </p>


<h2>Formas de mostrar un array</h2> 
<p>Usando <strong> print_r() </strong> (muestra los valores del array de manera legible) -> <strong> <?php echo print_r($array); ?> </strong> </p>
<p>Usando <strong> var_dump() </strong> (muestra el tipo de cada elemento) -> <strong> <?php echo var_dump($array); ?> </strong> </p>
<p>Usando <strong> implode() </strong> (lo convierte en una cadena de texto) -> <strong> <?php echo implode(', ',$array); ?> </strong> </p>
<p>Usando <strong> json_encode() </strong> (usa una presentación de formato JSON) -> <strong> <?php echo json_encode($array); ?> </strong> </p>

<br>

<h2>Otras funciones</h2>
<p>Número en la posición 3 -> <strong> <?php echo $array[3] ?> </strong> </p>

<p>Longitud del array -> <strong> <?php echo count($array) ?> </strong> </p>
<?php
    // Guardar el primer número
    $first_item = reset($array);
?>
<p>Primer elemento -> <strong> <?php  echo $first_item ?> </strong> </p>
<?php
    $last_index = count($array) - 1;
    $last_item = $array[$last_index];
?>
<p>Último elemento -> <strong> <?php  echo $last_item ?> </strong> </p>
<?php
    // Concatenar números
    $odd_numbers = [1,3,5,7,9];
    $even_numbers = [2,4,6,8,10];
    $all_numbers = array_merge($odd_numbers, $even_numbers);
?>
<p>Resultado de concatenar los arrays: <br> <strong> <?php  echo implode(', ',$odd_numbers) ?> </strong> y <strong>  <?php  echo implode(', ',$even_numbers) ?>  </strong> -> <br>  <?php  echo implode(', ',$all_numbers) ?>  </p>

<?php
    // Poner el array ordenador
    sort($array);
?>
<p>Array ordenado -> <strong> <?php  echo implode(', ', $array) ?> </strong> </p>

<br>
<h2>Funciones avanzadas</h2>

<?php
// Nuevo array
$numbers = [1,2,3,4,5,6];
?>

<!-- MOSTRAR EL NUEVO ARRAY -->
<p>Nuevo Array -> <strong> <?php  echo implode(', ', $numbers) ?> </strong> </p>



<p>Mostrar a partir de la 3ra posición -> <strong> <?php  echo implode(', ',array_slice($numbers, 3)) ?> </strong> </p>

<?php
// Descartando las 3 primeras posiciones y cogiendo los 2 siguientes digitos
array_slice($numbers, 3, 2);
?>

<p>Mostrar a partir de la 3ra posición y cogiendo los 2 siguientes digitos -> <strong> <?php  echo implode(', ', $numbers) ?> </strong> </p>


</body>
</html>