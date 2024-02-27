<?php
$con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
$id = $_GET["id"];
$sql = "SELECT * FROM administradores WHERE id_admin = " . $id;
$res = mysqli_query($con, $sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Profesor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
        body {
            background-color: #BAD8EC ;
            padding-top: 40px;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1f2735;
            color: #fff;
            border: none;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <br>
    <div class="container">
    <form action="editarAdmin2.php" method="post">
    <h2>Modificar Datos</h2>
    <input type="hidden" name="id" value="<?php echo $id ?>">
    
    <?php while ($a = mysqli_fetch_array($res)) { ?>
        <input type="text" name="nombre" value="<?php echo $a["nombre"] ?>" placeholder="Nombre" required><br>
        <input type="text" name="apellido" value="<?php echo $a["apellido"] ?>" placeholder="Apellido" required><br>
        <input type="text" name="correo" value="<?php echo $a["correo"] ?>" placeholder="Correo" required><br>
        <input type="text" name="usuario" value="<?php echo $a["usuario"] ?>" placeholder="Usuario" required><br>
        <input type="password" name="contraseña" value="<?php echo $a["contraseña"] ?>" placeholder="Contraseña" required><br>
        
        <h6>Sexo</h6>
        <input type="radio" id="masculino" name="genero" value="1" required>
        <label for="masculino">Masculino</label>
        <input type="radio" id="femenino" name="genero" value="2" required>
        <label for="femenino">Femenino</label><br><br>
        
        <h6>Estado</h6>
        <input type="radio" id="activo" name="estado" value="1" required>
        <label for="activo">Activo</label>
        <input type="radio" id="no_activo" name="estado" value="2" required>
        <label for="no_activo">Inactivo</label><br>
        
        <input type="submit" value="Modificar" class="btn btn-primary"><br><br>
        <a href="admin.php" class="btn btn-outline-dark btn-lg mb-4">Volver</a>
    <?php } ?>
</form>
    </div>
</body>
</html>