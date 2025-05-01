<?php
// Incluir archivo de configuración
require_once "config.php";
 
// Definir variables e inicializarlas vacías
$marca = $modelo = $serie = "";
$marca_err = $modelo_err = $serie_err = "";
 
// Procesar datos del formulario al enviarlo
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Obtener el valor oculto del ID
    $id = $_POST["id"];
    
    // Validar marca
    $input_marca = trim($_POST["marca"]);
    if(empty($input_marca)){
        $marca_err = "Por favor ingresa una marca.";
    } elseif(!preg_match("/^[a-zA-Z\s]+$/", $input_marca)){
        $marca_err = "Por favor ingresa una marca válida.";
    } else{
        $marca = $input_marca;
    }
    
    // Validar modelo
    $input_modelo = trim($_POST["modelo"]);
    if(empty($input_modelo)){
        $modelo_err = "Por favor ingresa un modelo.";     
    } else{
        $modelo = $input_modelo;
    }
    
    // Validar serie
    $input_serie = trim($_POST["serie"]);
    if(empty($input_serie)){
        $serie_err = "Por favor ingresa el número de serie.";     
    } else{
        $serie = $input_serie;
    }
    
    // Verificar errores antes de hacer el UPDATE
    if(empty($marca_err) && empty($modelo_err) && empty($serie_err)){
        // Preparar la sentencia UPDATE
        $sql = "UPDATE información SET marca=?, modelo=?, serie=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Enlazar variables
            mysqli_stmt_bind_param($stmt, "sssi", $param_marca, $param_modelo, $param_serie, $param_id);
            
            // Asignar valores
            $param_marca = $marca;
            $param_modelo = $modelo;
            $param_serie = $serie;
            $param_id = $id;
            
            // Ejecutar la sentencia
            if(mysqli_stmt_execute($stmt)){
                // Redirigir tras la actualización
                header("location: index.php");
                exit();
            } else{
                echo "¡Ups! Algo salió mal. Intenta de nuevo más tarde.";
            }
        }
         
        // Cerrar statement
        mysqli_stmt_close($stmt);
    }
    
    // Cerrar conexión
    mysqli_close($link);
} else{
    // Comprobar si el parámetro ID existe
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Obtener ID desde la URL
        $id =  trim($_GET["id"]);
        
        // Preparar sentencia SELECT
        $sql = "SELECT * FROM coches WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $marca = $row["marca"];
                    $modelo = $row["modelo"];
                    $serie = $row["serie"];
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "¡Ups! Algo salió mal. Intenta de nuevo más tarde.";
            }
        }
        
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Coche</title>
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
                    <h2 class="mt-5">Actualizar Coche</h2>
                    <p>Edita los valores y envía para actualizar el coche en la base de datos.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" name="marca" class="form-control <?php echo (!empty($marca_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $marca; ?>">
                            <span class="invalid-feedback"><?php echo $marca_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Modelo</label>
                            <textarea name="modelo" class="form-control <?php echo (!empty($modelo_err)) ? 'is-invalid' : ''; ?>"><?php echo $modelo; ?></textarea>
                            <span class="invalid-feedback"><?php echo $modelo_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Serie</label>
                            <input type="text" name="serie" class="form-control <?php echo (!empty($serie_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $serie; ?>">
                            <span class="invalid-feedback"><?php echo $serie_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
