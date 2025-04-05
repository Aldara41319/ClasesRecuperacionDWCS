<?php

    // Excepción básica. Dará error porque no se puede dividir por 0 
    // try {
    //     echo 2 / 0;
    // } catch (Exception $e) {
    //     echo "Caught exception: Division by zero!";
    // }

// ----------------------------------------------

    // Se pueden lanzar (o volver a lanzar) excepciones dentro de un blqoue catch
    // if (4/2 == 2) {
    //     echo "Right!";
    // } else {
    //     throw new Exception("Wrong answer!");
    // }

// ----------------------------------------------

    // Con el bloque "finally" podemos lanzar un mensaje independientemente si se ha lanzado el error o no
    // try {
    //     echo 4/0;
    // } catch (Exception $e) {
    //     echo "Divided by zero!";
    // } finally {
    //     echo "This will be outputed even if exception will happen!";
    // }

// ----------------------------------------------

    // 


?>