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

$sql = "SELECT  a.nombre, a.apellido, z.punt_1, z.punt_2, promedio, x.tipo
FROM calificacion_alumnos z
INNER JOIN alumnos a ON z.id_alumno = a.id_alumno
INNER JOIN estado x ON z.id_estado = x.id_estado
INNER JOIN materia m ON z.id_materia = m.id_materia
WHERE z.id_curso = $idCurso AND  z.id_materia = $idMateria";

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Alumnos Aprobados, Desaprobados y Total</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .btn-historial {
            background-color: #1f2735;
            color: #fff;
            width: 200px;
        }
        .btn-cancelar {
            background-color: #1f2735;
            color: #fff;
            width: 150px;
            position: fixed;
            right: 140px;
        }
        #cuotas {
            margin-top: 50px;
        }

        .btn-volver {
            background-color: #1f2735;
            color: #fff;
            right: 140px;
            width: 150px;
            background-color: #1f2735;
        }


        #campoPago {
            margin-top: 50px;
        }
    </style>
</head>
<br>
<body>
    
<div class="container">
        <h1>NOTAS</h1>
        <h5><?php echo $cursoNombre?></h5>
        <h5><?php echo $materiaNombre?></h5>
        <h6>Profesor: <?php echo $nombre. ' ' .$apellido?></h6>

        <button type="button" class="btn btn-dark" onclick="window.location.href='principalAlumnoProfe.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>&idMateria=<?php echo $idMateria ?>&materiaNombre=<?php echo $materiaNombre ?>'">Volver</button>
        
        <br><br>

        <div class="table-responsive">
            <table id="alumnos" class="table table-bordered table-striped text-center">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">EVALUACION 1</th>
                        <th scope="col">EVALUACION 2</th>
                        <th scope="col">NOTA FINAL</th>
                        <th scope="col">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $mostrar['nombre'] ?></td>
                            <td><?php echo $mostrar['apellido'] ?></td>
                            <td><?php echo $mostrar['punt_1'] ?></td>
                            <td><?php echo $mostrar['punt_2'] ?></td>
                            <td><?php echo $mostrar['promedio'] ?></td>
                            <td><?php echo $mostrar['tipo'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
