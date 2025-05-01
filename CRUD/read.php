<?php
// Verificar si el parámetro ID existe antes de continuar
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Incluir archivo de configuración
    require_once "config.php";
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM información WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Establecer el parámetro
        $param_id = trim($_GET["id"]);
        
        // Ejecutar la consulta
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                // Obtener el resultado como array asociativo
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Extraer los valores
                $id = $row["id"];
                $marca = $row["marca"];
                $modelo = $row["modelo"];
                $serie = $row["serie"];
            } else{
                // ID inválido
                header("location: error.php");
                exit();
            }
        } else{
            echo "¡Ups! Algo salió mal. Intenta de nuevo más tarde.";
        }
    }
    
    // Cerrar statement y conexión
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else{
    // Si no se pasa ID, redirigir a error
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Coche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Detalles del Coche</h1>
                    <div class="form-group">
                        <label>ID</label>
                        <p><b><?php echo $id; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <p><b><?php echo $marca; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Modelo</label>
                        <p><b><?php echo $modelo; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Serie</label>
                        <p><b><?php echo $serie; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
