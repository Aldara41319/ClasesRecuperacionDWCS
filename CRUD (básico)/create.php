<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$marca = $modelo = $serie = "";
$marca_err = $modelo_err = $serie_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate marca
    $input_marca = trim($_POST["marca"]);
    if(empty($input_marca)){
        $marca_err = "Please enter a marca.";
    } elseif(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/u", $input_marca)){
        $marca_err = "Please enter a valid marca.";
    } else{
        $marca = $input_marca;
    }
    
    // Validate modelo
    $input_modelo = trim($_POST["modelo"]);
    if(empty($input_modelo)){
        $modelo_err = "Please enter a modelo.";     
    } else{
        $modelo = $input_modelo;
    }
    
    // Validate serie
    $input_serie = trim($_POST["serie"]);
    if(empty($input_serie)){
        $serie_err = "Por favor, introduce la serie.";     
    } else{
        $serie = $input_serie;
    }

    // Check input errors before inserting in database
    if(empty($marca_err) && empty($modelo_err) && empty($serie_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO información (marca, modelo, serie) VALUES (:marca, :modelo, :serie)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":marca", $param_marca);
            $stmt->bindParam(":modelo", $param_modelo);
            $stmt->bindParam(":serie", $param_serie);
            
            // Set parameters
            $param_marca = $marca;
            $param_modelo = $modelo;
            $param_serie = $serie;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear registro</title>
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
                    <h2 class="mt-5">Crear registro</h2>
                    <p>Rellena el formulario y envíalo para agregar el coche a la base de datos.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <input type="submit" class="btn btn-primary" value="Registrar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>