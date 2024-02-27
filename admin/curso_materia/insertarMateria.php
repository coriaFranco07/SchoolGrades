<?php

$id = $_GET["id"];
$nombre = $_GET["nombre"];
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

// Consultar las materias que no tienen un curso asociado
$query = "SELECT id_materia, tipo
FROM materia
WHERE id_materia NOT IN (
  SELECT id_materia
  FROM curso_materia
  WHERE id_curso = $id
)";

$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Materias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
        body {
            background-color: #BAD8EC;
            font-family: "Roboto", sans-serif;
            text-align: center;
            margin-top: 40px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 0 auto;
        }
        
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #1f2735;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #2c3850;
        }
        .btn-cancel {
            background-color: #1f2735;
            color: #fff;
            border: none;
            padding: 14px 25px;
            border-radius: 7px;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background-color: #2c3850;
        }
    </style>
</head>

<body>
    

    <h1 style="text-align: center;">ID: <?php echo $id ?></h1>
    <h1 style="text-align: center;">CURSO: <?php echo $nombre ?></h1><br>

    <div class="container">

        <form action="insertarMateria2.php" method="POST" align="center">

            <input type="hidden" name="id_curso" value="<?php echo $id ?>">

            <div class="form-group">
                <label for="materiaSelect">Selecciona una materia:</label>
                <select class="form-control" id="materiaSelect" name="materiaSelect">
                    <?php
                    while ($mostrar = mysqli_fetch_array($result)) {
                        echo "<option value='" . $mostrar['id_materia'] . "'>" . $mostrar['tipo'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="Agregar">
            <a href="cursoMateria.php" class="btn-cancel" >Volver</a>

        </form>

    </div>

</body>

</html>

