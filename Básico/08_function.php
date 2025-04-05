<?php

    // Definir una función llamada "suma"
    // Recibe una lista de numeros (array)
    function sum($numbers) {
        // Definir una variable para almacenar la suma de los números
        $sum = 0;

        // Sumamos los números
        foreach ($numbers as $number) {
            $sum += $number;
        }

        // Devuelve la suma total
        return $sum;
    }

    // Ejemplo
    echo sum([1,2,3,4,5,6,7,8,9,10]);

?>