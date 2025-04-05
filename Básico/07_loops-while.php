<?php
    // Bucle básico while
    // $counter = 0;

    // while ($counter < 10) {
    //     $counter += 1;
    //     echo "Executing - counter is $counter".'<br>';
    // }

    // Hacemos lo mismo pero diciendo cuales son pares
    // $counter = 0;

    // while ($counter < 10) {
    //     $counter += 1;

    //     if ($counter % 2 == 0) {
    //         echo "Skipping number $counter because it is even".'<br>';
    //         continue;
    //     }

    //     echo "Executing - counter is $counter".'<br>';
    // }

    // Haremos como el anterior pero al llegar a 8 para el bucle.
    $counter = 0;

    while ($counter < 10) {
        $counter += 1;

        if ($counter > 8) {
            echo "counter is larger than 8, stopping the loop".'<br>';
            break;
        }

        if ($counter % 2 == 0) {
            echo "Skipping number $counter because it is even".'<br>';
            continue;
        }

        echo "Executing - counter is $counter".'<br>';
    }

?>