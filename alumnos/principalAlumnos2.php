<?php 
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

session_start();

$querypa = "SELECT * FROM alumnos WHERE usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_alumno = $a["id_alumno"];
    $nombre = $a["nombre"];
    $apellido= $a["apellido"];
}

$idCurso = $_GET['idCurso'];
$cursoNombre=  $_GET['cursoNombre'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUOTAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #BAD8EC;
            font-family: "Roboto", sans-serif;
            text-align: center;
        }
        h1 {
            background-color: #BAD8EC;
            border-radius: 15px 10px 15px 10px;
            padding: 10px;
        }
       
    </style>
</head>

<body>

    <div class="container1">

        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="materiasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>">Materias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>">Notas</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Mas
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="graficasNotas.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>">Estadisticas</a></li>
                    <li><a class="dropdown-item" href="principalAlumnos.php">Volver</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../views/index.php">Cerrar Sesion</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav><br>

        <h1><?php echo $cursoNombre ?></h1>
        <h5>Alumno: <?php echo $nombre . ' ' . $apellido ?></h5>

        <button type="button" class="btn btn-dark" onclick="window.location.href='materiasProfe.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>'">volver</button>
        <br><br><br>
        <div class="image-container">
            <img src="../img/imgenNene.png" alt="Imagen 1" style="height: 300px; width: 240px">
            <img src="../img/imagenNena.png" alt="Imagen 2" style="height: 300px; width: 240px">
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>