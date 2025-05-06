<?php
    include "protect.php";
?>

<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$marca = $modelo = $serie = "";
$marca_err = $modelo_err = $serie_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate marca
    $input_marca = trim($_POST["marca"]);
    if(empty($input_marca)){
        $marca_err = "Please enter an marca.";     
    } else{
        $marca = $input_marca;
    }
    
    // Validate modelo modelo
    $input_modelo = trim($_POST["modelo"]);
    if(empty($input_modelo)){
        $modelo_err = "Please enter an modelo.";     
    } else{
        $modelo = $input_modelo;
    }
    
    // Validate serie
    $input_serie = trim($_POST["serie"]);
    if(empty($input_serie)){
        $serie_err = "Please enter an serie.";     
    } else{
        $serie = $input_serie;
    }
    
    // Check input errors before inserting in database
    if(empty($marca_err) && empty($modelo_err) && empty($serie_err)){
        // Prepare an update statement
        $sql = "UPDATE información SET marca=:marca, modelo=:modelo, serie=:serie WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":marca", $param_marca);
            $stmt->bindParam(":modelo", $param_modelo);
            $stmt->bindParam(":serie", $param_serie);
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_marca = $marca;
            $param_modelo = $modelo;
            $param_serie = $serie;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM información WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $marca = $row["marca"];
                    $modelo = $row["modelo"];
                    $serie = $row["serie"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>