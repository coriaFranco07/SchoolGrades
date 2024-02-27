<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
session_start();

$querypa = "select * from alumnos where usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_alumno = $a["id_alumno"];
    $nombre = $a["nombre"];
    $apellido= $a["apellido"];
}

$idCurso = $_GET['idCurso'];
$cursoNombre = $_GET['cursoNombre'];


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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #BAD8EC ;
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
    </style>
</head>
<br>
<body>
    <div class="container">
        <h1>GRAFICA</h1>
        <h3><?php echo $cursoNombre ?></h3>
        <h6><?php echo $nombre . ' ' . $apellido ?></h6>
        
        <br>
        <button type="button" class="btn btn-dark" onclick="window.location.href='principalAlumnos2.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>'">Cancelar</button>

        <br><br>

        <?php
        
        $sql = "SELECT ca.id_calificacion, 
        a.nombre AS nombre_alumno, 
        a.apellido AS apellido_alumno, 
        p.nombre AS nombre_profesor, 
        p.apellido AS apellido_profesor, 
        m.tipo AS nombre_materia, 
        c.tipo AS nombre_curso,
        ca.punt_1,
        ca.punt_2,
        ca.promedio,
        ca.comentario,
        e.tipo AS nombre_estado
        FROM calificacion_alumnos ca
        JOIN alumnos a ON ca.id_alumno = a.id_alumno
        JOIN profesores p ON ca.id_profesor = p.id_profesor
        JOIN materia m ON ca.id_materia = m.id_materia
        JOIN curso c ON ca.id_curso = c.id_curso
        JOIN estado e ON ca.id_estado = e.id_estado
        WHERE c.id_curso = $idCurso AND a.id_alumno = $id_alumno";
        
        $result = mysqli_query($conn, $sql);

        ?>
        <canvas id="graficaCalificaciones"></canvas>

        <script>
            var ctx = document.getElementById('graficaCalificaciones').getContext('2d');

            var labels = []; // Aquí deberías poner los nombres de las materias
            var promedios = []; // Aquí deberías poner los promedios de las calificaciones

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "labels.push('" . $row['nombre_materia'] . "');";
                echo "promedios.push(" . $row['promedio'] . ");";
            }
            ?>

            var backgroundColors = promedios.map(function(promedio) {
                return promedio < 7 ? 'rgba(255, 99, 132, 0.2)' : 'rgba(75, 192, 192, 0.2)';
            });

            var borderColors = promedios.map(function(promedio) {
                return promedio < 7 ? 'rgba(255, 99, 132, 1)' : 'rgba(75, 192, 192, 1)';
            });

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Promedio de calificaciones',
                        data: promedios,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    </div>

   
    
</body>

</html>