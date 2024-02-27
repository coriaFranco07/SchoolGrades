<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

$profesorSeleccionado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seleccion_profe'])) {
    $profesorSeleccionado = $_POST['seleccion_profe'];
    echo $profesorSeleccionado;
}

$sql = "SELECT * FROM curso";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT id_profesor, nombre, apellido FROM profesores";
$result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #BAD8EC;
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
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background-color: #2c3850;
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
<body><br>

<div class="container">
    <h1>Seleccionar Curso y Profe</h1>
    <form method="post" action="insertarCursoProfe2.php">

   
        <div>
            <label for="seleccion_profe">Selecciona un Profesor:</label>
            <select name="seleccion_profe" id="seleccion_profe">
                <?php while ($fila_profe = mysqli_fetch_assoc($result2)): ?>
                    <option value="<?= $fila_profe["id_profesor"] ?>">
                        <?= $fila_profe["nombre"] ?> <?= $fila_profe["apellido"] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <br>
        <div>
            <label for="seleccion_curso">Selecciona un Curso:</label>
            <select name="seleccion_curso" id="seleccion_curso">
                <?php while ($fila_curso = mysqli_fetch_assoc($result)): ?>
                    <option value="<?= $fila_curso["id_curso"] ?>">
                        <?= $fila_curso["tipo"] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <br>

    <input type="submit" value="Enviar">
    <button type="button" class="btn-cancel" onclick="window.location.href='cursoProfe.php'">Cancelar</button>

</form>

</div>

</body>
</html>
