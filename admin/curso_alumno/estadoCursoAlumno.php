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
            background-color: #BAD8EC ;
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
        h1 {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
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
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background-color: #2c3850;
        }
    </style>
</head>
<body>
    <?php
    $idCursoAlumno = $_GET['id'];
    $idEstado = $_GET['id_estado'];
    $idAlumno = $_GET['id_alumno'];
    $idCurso = $_GET['id_curso'];

    $conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

    $sql = "SELECT DISTINCT id_estado, tipo
            FROM estado
            WHERE id_estado <> $idEstado
              AND id_estado NOT IN (4, 5);";
    $result = mysqli_query($conn, $sql);

    // Cerrar conexión a la base de datos
    mysqli_close($conn);
    ?>

    <div class="container">
        <h1>Seleccionar Estado</h1>
        <form method="post" action="estadoCursoAlumno2.php">
            <div>
                <label for="seleccion_estado">Selecciona un estado:</label>
                <select name="seleccion_estado" id="seleccion_estado">
                    <?php while ($fila_estado = mysqli_fetch_assoc($result)): ?>
                        <option value="<?= $fila_estado["id_estado"] ?>"><?= $fila_estado["tipo"] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Agrega campos ocultos para enviar otros parámetros -->
            <input type="hidden" name="parametro1" value="<?= $idAlumno ?>">
            <input type="hidden" name="parametro2" value="<?= $idCurso ?>">
            <input type="hidden" name="parametro3" value="<?= $idCursoAlumno ?>">

            <input type="submit" value="Enviar">
            <button type="button" class="btn-cancel" onclick="window.location.href='cursoAlumno.php'">Cancelar</button>
        </form>
    </div>

</body>
</html>
