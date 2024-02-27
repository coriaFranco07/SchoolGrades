<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

$sql = "SELECT * FROM materia";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM profesores";
$result2 = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color:#BAD8EC;
            font-family: "Roboto", sans-serif;
            text-align: center;
        }
        .container {
            background-color: aliceblue;
            margin: auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            background-color: aliceblue;
            border-radius: 15px 10px 15px 10px;
            padding: 10px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
        }

        select {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        option {
            padding: 5px;
        }
       
    </style>
</head>
<br>
<body>
<br>

<div class="container">
    <h1>Seleccionar Materia y Profe</h1>
    <form method="post" action="insertarProfeMateria2.php">

    <div>
        <label for="seleccion_profe">Selecciona un Profe:</label>
        <select name="seleccion_profe" id="seleccion_profe">
            <?php while ($fila_profe = mysqli_fetch_assoc($result2)): ?>
                <option value="<?= $fila_profe["id_profesor"] ?>"><?= $fila_profe["nombre"] ?> <?= $fila_profe["apellido"] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <br>
    <div>
        <label for="seleccion_materia">Selecciona un curso:</label>
        <select name="seleccion_materia" id="seleccion_materia">
            <?php while ($fila_materia = mysqli_fetch_assoc($result)): ?>
                <option value="<?= $fila_materia["id_materia"] ?>"><?= $fila_materia["tipo"] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <br>
    <input type="submit" class="btn btn-dark" value="Enviar">
    <button type="button" class="btn btn-dark" onclick="window.location.href='profeMateria.php'">Cancelar</button>
</form>

</div>

</body>
</html>
