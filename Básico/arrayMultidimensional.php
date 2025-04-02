<?php 
    $multiArray = [ 
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays multidimensionales</title>
</head>
<body>
    <p>Usando <strong>print_r($nameVariable[pos])</strong> -> <?php print_r($multiArray[0]) ?>  </p>
    <p>Usando <strong>print_r($nameVariable[pos][pos])</strong> -> <?php print_r($multiArray[0][2]) ?>  </p>

    <br>
    <?php 
        $people = [
            "john_doe" => [
                "name" => "John",
                "surname" => "Doe",
                "age" => 25,
            ],
            "jane_doe" => [
                "name" => "Jane",
                "surname" => "Doe",
                "age" => 25,
            ]
        ];

        print_r($people);
    ?>   
    <p>Por ejemplo tenemos el siguiente array. Vamos a pedir que imprima el nombre de <strong>John</strong></p>
    <p> Para ello ponemos lo siguiente <strong>print_r($people['john_doe']['name']);</strong>. Resultado -> <?php print_r($people['john_doe']['name']); ?> </p>


</body>
</html>