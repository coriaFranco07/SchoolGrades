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
    <title>Gráfica de Alumnos Aprobados, Desaprobados y Total</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .custom-btn {
        padding: 12px 24px;
        border-radius: 5px;
        background-color: #1f2735;
        color: #fff;
        border: none;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #29374a;
    }
    </style>
</head>

<body>
    <h1>GRAFICA DE CALIFICACIONES</h1>
    <button type="button" class="btn btn-dark custom-btn" onclick="window.location.href='principalAlumnoProfe.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>&idMateria=<?php echo $idMateria ?>&materiaNombre=<?php echo $materiaNombre ?>'">volver</button>
    <canvas id="chart" width="400" height="200"></canvas>

    <?php

    // Realiza las consultas para obtener la cantidad de alumnos aprobados, desaprobados y el total
    $conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

    $queryAprobados = "SELECT COUNT(*) as total FROM calificacion_alumnos WHERE promedio >= 7 AND id_curso = " . $idCurso . " AND id_materia = " . $idMateria;
    $resultAprobados = mysqli_query($conn, $queryAprobados);
    $rowAprobados = mysqli_fetch_assoc($resultAprobados);
    $cantidadAprobados = $rowAprobados['total'];

    $queryDesaprobados = "SELECT COUNT(*) as total FROM calificacion_alumnos WHERE promedio < 7 AND id_curso = " . $idCurso . " AND id_materia = " . $idMateria;
    $resultDesaprobados = mysqli_query($conn, $queryDesaprobados);
    $rowDesaprobados = mysqli_fetch_assoc($resultDesaprobados);
    $cantidadDesaprobados = $rowDesaprobados['total'];

    $queryTotal = "SELECT COUNT(*) as total FROM calificacion_alumnos WHERE id_curso = " . $idCurso . " AND id_materia = " . $idMateria;

    $resultTotal = mysqli_query($conn, $queryTotal);
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $cantidadTotal = $rowTotal['total'];

    // Genera el código JavaScript para crear la gráfica
    echo "<script>
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Aprobados', 'Desaprobados', 'Total'],
                datasets: [{
                    label: 'Cantidad',
                    data: [$cantidadAprobados, $cantidadDesaprobados, $cantidadTotal],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(192, 75, 75, 0.2)', 'rgba(0, 0, 0, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(192, 75, 75, 1)', 'rgba(0, 0, 0, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>";
    ?>

</body>

</html>

