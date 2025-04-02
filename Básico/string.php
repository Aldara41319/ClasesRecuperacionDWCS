<?php

    // Definir un String y mostrarlo
    $name = "John";
    $introduction = "Hello $name";
    echo $introduction;
    
    echo '<br>';
    // Concatenar string
    $first_name = "John";
    $last_name = "Doe";
    $name = $first_name . " " . $last_name;
    echo $name;

    echo '<br>';
    // Mostrar tamaño/logitud del string
    $string = "The length of this string is 43 characters.";
    echo strlen($string);

    echo '<br>';
    // Cortar cadena y guardarla
    $filename = "image.png";
    $extension = substr($filename, strlen($filename) - 3);
    echo "The extension of the file is $extension";

    echo '<br>';
    // Separar el string
    $fruits = "apple,banana,orange";
    $fruit_list = explode(",", $fruits);
    echo "The second fruit in the list is ".'<strong>'. $fruit_list[1].'</strong>';


?> 
