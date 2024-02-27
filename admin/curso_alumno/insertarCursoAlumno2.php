<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Curso</title>
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
        .alert {
            background-color: #cce5ff;
            color: #007bff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
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
<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$seleccion_alumno = $_POST['seleccion_alumno'];

// Consulta SQL para obtener el curso captado con la fecha más cercana a la actualidad
$sql_curso_captado = "SELECT id_curso FROM curso_alumno WHERE id_alumno = ? AND id_estado = 3 ORDER BY fecha_desde DESC LIMIT 1";

// Preparar la consulta
$stmt = mysqli_prepare($conn, $sql_curso_captado);
mysqli_stmt_bind_param($stmt, "i", $seleccion_alumno);
mysqli_stmt_execute($stmt);
$resultado_curso_captado = mysqli_stmt_get_result($stmt);

// Verificar si se obtuvieron resultados del curso captado
if (mysqli_num_rows($resultado_curso_captado) > 0) {
    // Obtener el ID del curso captado con la fecha más cercana a la actualidad
    $fila_curso_captado = mysqli_fetch_assoc($resultado_curso_captado);
    $id_curso_captado = $fila_curso_captado['id_curso'];

    // Consulta SQL para obtener el nivel del curso captado
    $sql_nivel_curso_captado = "SELECT nivel FROM curso WHERE id_curso = ?";

    // Preparar la consulta
    $stmt = mysqli_prepare($conn, $sql_nivel_curso_captado);
    mysqli_stmt_bind_param($stmt, "i", $id_curso_captado);
    mysqli_stmt_execute($stmt);
    $resultado_nivel_curso_captado = mysqli_stmt_get_result($stmt);

    // Verificar si se obtuvieron resultados del nivel del curso captado
    if (mysqli_num_rows($resultado_nivel_curso_captado) > 0) {
        $fila_nivel_curso_captado = mysqli_fetch_assoc($resultado_nivel_curso_captado);
        $nivel_curso_captado = $fila_nivel_curso_captado['nivel'];

        // Calcular el nivel del curso con mayor nivel
        $nivel_curso_mayor = $nivel_curso_captado + 1;

        // Consulta SQL para obtener los cursos con mayor nivel que el curso captado
        $sql_cursos_mayor_nivel = "SELECT id_curso, tipo FROM curso WHERE nivel = ?";

        // Preparar la consulta
        $stmt = mysqli_prepare($conn, $sql_cursos_mayor_nivel);
        mysqli_stmt_bind_param($stmt, "i", $nivel_curso_mayor);
        mysqli_stmt_execute($stmt);
        $resultado_cursos_mayor_nivel = mysqli_stmt_get_result($stmt);

        // Crear un array para almacenar los cursos con mayor nivel
        $cursos_mayor_nivel = array();

        // Recorrer los resultados y almacenar los cursos con mayor nivel en el array
        while ($fila_curso_mayor_nivel = mysqli_fetch_assoc($resultado_cursos_mayor_nivel)) {
            $id_curso_mayor_nivel = $fila_curso_mayor_nivel['id_curso'];
            $nombre_curso_mayor_nivel = $fila_curso_mayor_nivel['tipo'];

            // Agregar el curso al array con un par clave-valor (ID y Nombre)
            $cursos_mayor_nivel[] = array(
                'id_curso' => $id_curso_mayor_nivel,
                'nombre_curso' => $nombre_curso_mayor_nivel
            );
        }
    } else {
        echo "No se encontró el nivel del curso captado.";
    }
} else {

     // Si no se encontró el curso captado, obtener todos los cursos disponibles
     $sql_todos_cursos = "SELECT id_curso, tipo FROM curso";

     // Preparar la consulta
     $stmt = mysqli_prepare($conn, $sql_todos_cursos);
     mysqli_stmt_execute($stmt);
     $resultado_todos_cursos = mysqli_stmt_get_result($stmt);
 
     // Crear un array para almacenar todos los cursos disponibles
     $todos_cursos = array();
 
     // Recorrer los resultados y almacenar los cursos en el array
     while ($fila_todos_cursos = mysqli_fetch_assoc($resultado_todos_cursos)) {
         $id_curso = $fila_todos_cursos['id_curso'];
         $nombre_curso = $fila_todos_cursos['tipo'];
 
         // Agregar el curso al array con un par clave-valor (ID y Nombre)
         $todos_cursos[] = array(
             'id_curso' => $id_curso,
             'nombre_curso' => $nombre_curso
         );
    }
}

// Cerrar conexión a la base de datos
mysqli_close($conn);
?>

<div class="container">
    <h1>Seleccionar Curso</h1>
    <form method="post" action="insertarCursoAlumno3.php">
        <div>
            <label for="seleccion_curso">Selecciona un curso:</label>
            <select name="seleccion_curso" id="seleccion_curso">
                <!-- Opciones para los cursos con mayor nivel -->
                <?php if (isset($cursos_mayor_nivel) && count($cursos_mayor_nivel) > 0): ?>
                    <?php foreach ($cursos_mayor_nivel as $curso_mayor_nivel): ?>
                        <!-- Use the ID as the value and display the name -->
                        <option value="<?= $curso_mayor_nivel['id_curso'] ?>"><?= $curso_mayor_nivel['nombre_curso'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Opciones para todos los cursos cuando no hay curso captado -->
                <?php if (isset($todos_cursos) && count($todos_cursos) > 0): ?>
                    <?php foreach ($todos_cursos as $curso): ?>
                        <!-- Use the ID as the value and display the name -->
                        <option value="<?= $curso['id_curso'] ?>"><?= $curso['nombre_curso'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <input type="hidden" name="seleccion_alumno" value="<?= $seleccion_alumno ?>">
        <input type="submit" value="Listo!!!">
        <button type="button" class="btn-cancel" onclick="window.location.href='insertarCursoAlumno.php'">Cancelar</button>
    </form>
</div>


</body>
</html>
