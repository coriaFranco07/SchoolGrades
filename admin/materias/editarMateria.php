<?php 

$con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
$id = $_GET["id"];
$sql = "SELECT * FROM materia WHERE id_materia = " . $id;
$res = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Materia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
        body {
            background-color: #BAD8EC;
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
    <br><br><br>
    <div class="container">
        
    <form action="editarMateria2.php" method="post">
    <h2>Modificar Datos</h2>
    <input type="hidden" name="id" value="<?php echo $id ?>">
    
    <?php while ($a = mysqli_fetch_array($res)) { ?>

        <input type="text" name="tipo" value="<?php echo $a["tipo"] ?>" placeholder="Materia..." required><br>
        <input type="submit" value="Modificar" class="btn btn-primary"><br><br>
        <a href="materias.php" class="btn btn-outline-dark btn-lg mb-4">Volver</a>

    <?php } ?>
</form>
    </div>
</body>
</html>