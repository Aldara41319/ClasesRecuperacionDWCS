<?php
// Incluir archivo de configuración
require_once "config.php";

// Inicializar variables
$marca = $modelo = $serie = "";
$marca_err = $modelo_err = $serie_err = "";

// Procesar formulario cuando se envíe
if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    // Validar marca
    $input_marca = trim($_POST["marca"]);
    if(empty($input_marca)) {
        $marca_err = "Por favor ingresa la marca.";
    } else {
        $marca = $input_marca;
    }

    // Validar modelo
    $input_modelo = trim($_POST["modelo"]);
    if(empty($input_modelo)) {
        $modelo_err = "Por favor ingresa el modelo.";
    } else {
        $modelo = $input_modelo;
    }

    // Validar serie
    $input_serie = trim($_POST["serie"]);
    if(empty($input_serie)) {
        $serie_err = "Por favor ingresa la serie.";
    } else {
        $serie = $input_serie;
    }

    // Verificar errores antes de actualizar
    if(empty($marca_err) && empty($modelo_err) && empty($serie_err)) {
        $sql = "UPDATE información SET marca=?, modelo=?, serie=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_marca, $param_modelo, $param_serie, $param_id);

            $param_marca = $marca;
            $param_modelo = $modelo;
            $param_serie = $serie;
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)) {
                // Opcional: reorganizar IDs aquí (poco común para UPDATE)
                /*
                mysqli_query($link, "SET @count = 0");
                mysqli_query($link, "UPDATE información SET id = (@count := @count + 1)");
                mysqli_query($link, "ALTER TABLE información AUTO_INCREMENT = 1");
                */
                
                header("location: index.php");
                exit();
            } else {
                echo "Algo salió mal. Inténtalo más tarde.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {
    // Obtener datos para el formulario
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM información WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $marca = $row["marca"];
                    $modelo = $row["modelo"];
                    $serie = $row["serie"];
                } else {
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Algo salió mal. Intenta más tarde.";
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else {
        header("location: error.php");
        exit();
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Coche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper { width: 600px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <h2 class="mt-5">Actualizar Coche</h2>
            <p>Edita los datos y pulsa "Guardar cambios" para actualizar.</p>
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" name="marca" class="form-control <?php echo (!empty($marca_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $marca; ?>">
                    <span class="invalid-feedback"><?php echo $marca_err;?></span>
                </div>
                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" name="modelo" class="form-control <?php echo (!empty($modelo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $modelo; ?>">
                    <span class="invalid-feedback"><?php echo $modelo_err;?></span>
                </div>
                <div class="form-group">
                    <label>Serie</label>
                    <input type="text" name="serie" class="form-control <?php echo (!empty($serie_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $serie; ?>">
                    <span class="invalid-feedback"><?php echo $serie_err;?></span>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" class="btn btn-primary" value="Guardar cambios">
                <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>