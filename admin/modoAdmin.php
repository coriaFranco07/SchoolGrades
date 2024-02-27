<?php 

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
session_start();

$querypa = "select * from administradores where usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_profesor = $a["id_admin"];
    $nombre = $a["nombre"];
    $apellido= $a["apellido"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #BAD8EC;
            font-family: "Roboto", sans-serif;
            text-align: center;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 800px;
        }

        .title-box {
            background-color: #1f2735;
            color: #fff;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 0;
        }

        h3 {
            font-size: 24px;
            margin-bottom: 30px;
            color: #1f2735;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #1f2735;
            border-color: #1f2735;
        }

        .btn-primary:hover {
            background-color: #29374a;
            border-color: #29374a;
        }

        .btn-secondary {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-secondary:hover {
            background-color: #444d58;
            border-color: #444d58;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #1995aa;
            border-color: #1995aa;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #2dab4e;
            border-color: #2dab4e;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #ffbe20;
            border-color: #ffbe20;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #e03a44;
            border-color: #e03a44;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="title-box">
            <h1>Administrador</h1>
        </div>

        <h3><?php echo $nombre . ' ' . $apellido ?></h3>

        <!-- Botones mejorados con estilos -->
        <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='./profesores/profesores.php'">Profesores</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="window.location.href='./alumnos/alumnos.php'">Alumnos</button>
        <button type="button" class="btn btn-info btn-lg" onclick="window.location.href='./administradores/admin.php'">Administradores</button>
        <button type="button" class="btn btn-light btn-lg" onclick="window.location.href='./notas/notasCursos.php'">Notas</button><br><br>
        <button type="button" class="btn btn-success btn-lg" onclick="window.location.href='./curso_materia/cursoMateria.php'">Materias/Cursos</button>
        <button type="button" class="btn btn-success btn-lg" onclick="window.location.href='./profe_materia/profeMateria.php'">Materias/Profes</button><br><br>
        <button type="button" class="btn btn-warning btn-lg" onclick="window.location.href='./curso_alumno/cursoAlumno.php'">Cursos/Alumnos</button>
        <button type="button" class="btn btn-warning btn-lg" onclick="window.location.href='./curso_profe/cursoProfe.php'">Cursos/Profes</button><br><br>
        <button type="button" class="btn btn-danger btn-lg" onclick="window.location.href='../views/index.php'">Cerrar Sesión</button>
    </div>

</body>

</html>
