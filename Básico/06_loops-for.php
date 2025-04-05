<?php

    // Ejemplo de bucle 
    $odd_numbers = [1,3,5,7,9];
    for ($i = 0; $i < count($odd_numbers); $i=$i+1) {
        $odd_number = $odd_numbers[$i];
        echo $odd_number . "\n";
    }

    echo '<br>';
    // Ejemplo más avanzado
    $phone_numbers = [
        "Alex" => "415-235-8573",
        "Jessica" => "415-492-4856",
    ];
    
    foreach ($phone_numbers as $name => $number) {
        echo "$name's number is $number.\n";
    }
    
?>