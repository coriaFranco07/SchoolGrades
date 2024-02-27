<?php
$con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

$id = $_GET["id"];
$idCurso = $_GET['idCurso'];
$cursoNombre = $_GET['cursoNombre'];


$sql = "SELECT ca.id_calificacion, a.nombre AS nombre_alumno, a.apellido AS apellido_alumno,
p.nombre AS nombre_profesor, p.apellido AS apellido_profesor,
m.tipo AS nombre_materia, c.tipo AS nombre_curso, ca.punt_1, ca.punt_2,ca.promedio, ca.comentario
FROM calificacion_alumnos ca
JOIN alumnos a ON ca.id_alumno = a.id_alumno
JOIN profesores p ON ca.id_profesor = p.id_profesor
JOIN materia m ON ca.id_materia = m.id_materia
JOIN curso c ON ca.id_curso = c.id_curso
WHERE ca.id_calificacion = $id";

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
    <br>
    <div class="container">
        
    <form action="editarNotas2.php" method="post">
    <h2>Modificar Notas</h2>

    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="idCurso" value="<?php echo $idCurso; ?>">
    <input type="hidden" name="cursoNombre" value="<?php echo $cursoNombre; ?>">
    
    <?php while ($a = mysqli_fetch_array($res)) { ?>

        <h6>Alumno</h6>
        <input type="text" name="alumnos" value="<?php echo $a["nombre_alumno"] . ' ' . $a["apellido_alumno"]; ?>" readonly><br>
        <h6>Profesor</h6>
        <input type="text" name="profesores" value="<?php echo $a["nombre_profesor"] . ' ' . $a["apellido_profesor"]; ?>" readonly><br>
        <h6>Materia</h6>
        <input type="text" name="materias" value="<?php echo $a["nombre_materia"]; ?>" readonly><br>
        <h6>Nota 1</h6>
        <input type="number"  max="10" min="1" name="punt_1" value="<?php echo $a["punt_1"] ?>" placeholder="Nota 1..." required><br>
        <h6>Nota 2</h6>
        <input type="number" max="10" min="1" name="punt_2" value="<?php echo $a["punt_2"] ?>" placeholder="Nota 2..." required><br>
        <h6>Comentario</h6>
        <input type="text" name="comentario" value="<?php echo $a["comentario"] ?>" placeholder="Comentario..." required><br>
        
        <input type="submit" value="Modificar" class="btn btn-primary"><br><br>
        <a href="notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>" class="btn btn-outline-dark btn-lg mb-4">Volver</a>


    <?php } ?>
</form>
    </div>
</body>
</html>