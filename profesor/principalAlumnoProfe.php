<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

session_start();

$querypa = "select * from profesores where usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_profesor = $a["id_profesor"];
    $nombre = $a["nombre"];
    $apellido = $a["apellido"];
}

$idCurso = $_GET['idCurso'];
$cursoNombre = $_GET['cursoNombre'];
$idMateria = $_GET['idMateria'];
$materiaNombre = $_GET['materiaNombre'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUOTAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: aliceblue;
            font-family: roboto;
            margin: auto;
            text-align: center;
        }

        h1 {
            background-color: aliceblue;
            border-radius: 15px 10px 15px 10px;
            padding: 10px;
        }

        .btn-cancelar {
            background-color: #1f2735;
            color: #fff;
            width: 150px;
            position: fixed;
            right: 140px;
        }

        .btn-volver {
            background-color: #1f2735;
            color: #fff;
            right: 140px;
            width: 150px;
            background-color: #1f2735;
        }

        .custom-form {
            position: absolute;
            right: 20px;
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container1">
         <nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="padding: 20px; border-radius: 15px;">
            <div class="container">
                <a class="navbar-brand" href="calificarAlumnos.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>&idMateria=<?php echo $idMateria ?>&materiaNombre=<?php echo $materiaNombre ?>">Calificar Alumnos</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="verNotas.php?idCurso=<?php echo $idCurso ?>&idMateria=<?php echo $idMateria ?>&cursoNombre=<?php echo $cursoNombre ?>&materiaNombre=<?php echo $materiaNombre ?>">Ver notas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graficaNotas.php?idCurso=<?php echo $idCurso ?>&idMateria=<?php echo $idMateria ?>&cursoNombre=<?php echo $cursoNombre ?>&materiaNombre=<?php echo $materiaNombre ?>">Grafica de notas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="alumnosProfe.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>&idMateria=<?php echo $idMateria ?>&materiaNombre=<?php echo $materiaNombre ?>">Alumnos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>&idMateria=<?php echo $idMateria ?>&materiaNombre=<?php echo $materiaNombre ?>">Contacto</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>

        <h1><?php echo $cursoNombre ?></h1>
        <h2><?php echo $materiaNombre?></h2>
        <h5>Profesor: <?php echo $nombre . ' ' . $apellido ?></h5>

        <button type="button" class="btn btn-dark" onclick="window.location.href='materiasProfe.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>'">volver</button>

        <div class="image-container">
            <img src="../img/imagenLibros.png" alt="Imagen 1" style="height: 300px; width: 240px">
            <img src="../img/imagenProfesor.png" alt="Imagen 2" style="height: 300px; width: 240px">
            <img src="../img/imagenProfesora.png" alt="Imagen 3" style="height: 300px; width: 320px">
            <img src="../img/imagenMatEscolares.png" alt="Imagen 4" style="height: 300px; width: 200px">
        </div>
        

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
