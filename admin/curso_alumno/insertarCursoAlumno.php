<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

$sql2 = "SELECT a.id_alumno, a.nombre, a.apellido
FROM alumnos a
WHERE (EXISTS (
        SELECT 1
        FROM curso_alumno ca_finalizado
        WHERE ca_finalizado.id_alumno = a.id_alumno AND ca_finalizado.id_estado = 3
    ) AND NOT EXISTS (
        SELECT 1
        FROM curso_alumno ca_activo
        WHERE ca_activo.id_alumno = a.id_alumno AND ca_activo.id_estado = 1
        AND ca_activo.id_curso <> (
            SELECT id_curso
            FROM curso_alumno
            WHERE id_alumno = a.id_alumno AND id_estado = 3
            ORDER BY fech_hasta DESC
            LIMIT 1
        )
    ))
OR (a.id_alumno NOT IN (
        SELECT id_alumno
        FROM curso_alumno
        WHERE id_estado = 1
    ))";
    
$result2 = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Alumno sin Curso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #BAD8EC ;
            font-family: "Roboto", sans-serif;
            text-align: center;
            margin-top: 40px;
        }
        .container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 0 auto;
        }
        h1 {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 10px;
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
        }
        input[type="submit"] {
            background-color: #1f2735;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
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
<br>
<body>
<div class="container">
        <h1>Seleccionar Alumno sin Curso</h1>
        <?php
        // Verificar si hay resultados en la consulta
        if (mysqli_num_rows($result2) > 0) {
            // Si hay resultados, mostramos el formulario y el botón "Siguiente"
        ?>
            <form method="post" action="insertarCursoAlumno2.php">
                <div>
                    <label for="seleccion_alumno">Selecciona un alumno:</label>
                    <select name="seleccion_alumno" id="seleccion_alumno">
                        <?php
                        // Mostrar opciones del select
                        while ($fila_alumno = mysqli_fetch_assoc($result2)) {
                            echo '<option value="' . $fila_alumno["id_alumno"] . '">' . $fila_alumno["nombre"] . ' ' . $fila_alumno["apellido"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" value="Siguiente">
                <button type="button" class="btn-cancel" onclick="window.location.href='cursoAlumno.php'">Cancelar</button>
            </form>
        <?php
        } else {
            // Si no hay resultados, mostramos un mensaje o realizamos alguna acción alternativa
            echo '<p>No hay alumnos disponibles sin curso en este momento.</p>';
            ?>
            <button type="button" class="btn-cancel" onclick="window.location.href='cursoAlumno.php'">Cancelar</button>
            <?php
        }
        ?>
    </div>
</body>
</html>
