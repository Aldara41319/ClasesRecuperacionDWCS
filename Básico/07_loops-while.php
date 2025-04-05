<?php
    // Bucle básico while
    $counter = 0;

    while ($counter < 10) {
        $counter += 1;
        // echo "Executing - counter is $counter".'<br>';
    }

    // Hacemos lo mismo pero diciendo cuales son pares
    $counter = 0;

    while ($counter < 10) {
        $counter += 1;

        if ($counter % 2 == 0) {
            echo "Skipping number $counter because it is even".'<br>';
            continue;
        }

        echo "Executing - counter is $counter".'<br>';
    }

    // 
    $counter = 0;

    while ($counter < 10) {
        $counter += 1;

        if ($counter > 8) {
            echo "counter is larger than 8, stopping the loop.\n";
            break;
        }

        if ($counter % 2 == 0) {
            echo "Skipping number $counter because it is even.\n";
            continue;
        }

        echo "Executing - counter is $counter.\n";
    }


?>