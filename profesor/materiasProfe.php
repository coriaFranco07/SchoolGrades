<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
session_start();

$querypa = "select * from profesores where usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_profesor = $a["id_profesor"];
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
        <h1>MIS MATERIAS ACTIVAS</h1>
        <h5><?php echo $cursoNombre?></h5>
        <h5>Profesor: <?php echo $nombre. ' ' .$apellido?></h5>

        <button type="button" class="btn btn-dark" onclick="window.location.href='principalProfe.php'">volver</button>

        <br><br><br><br>

        <div class="row">
        <?php

        $sql = "SELECT cm.id_materia, m.tipo
        FROM curso_materia cm
        INNER JOIN profe_materia pm ON cm.id_materia = pm.id_materia
        INNER JOIN materia m ON cm.id_materia = m.id_materia
        INNER JOIN estado e ON cm.id_estado = e.id_estado
        WHERE cm.id_curso = 1 AND pm.id_profesor = 1 AND e.tipo = 'activo' AND pm.id_estado= 1";
       $result = mysqli_query($conn, $sql);

         
        while ($row = mysqli_fetch_assoc($result)) {
            $idMateria = $row['id_materia'];
            $materiaNombre= $row['tipo'];
            ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">ID: <?php echo $idMateria; ?></h5><br>
                        <h5 class="card-title" style="text-align: center;"><?php echo $materiaNombre; ?></h5>
                        <a href="#" class="btn btn-primary" style="display: flex; justify-content: center;" onclick="seleccionarMateria('<?php echo $idCurso; ?>', '<?php echo $cursoNombre; ?>', '<?php echo $idMateria; ?>', '<?php echo $materiaNombre; ?>')">
                            Seleccionar
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
        
    <script>
        function seleccionarMateria(idCurso, cursoNombre, idMateria, materiaNombre) {

            // Construir la URL con los parámetros
            var url = '../profesor/principalAlumnoProfe.php?idCurso=' + encodeURIComponent(idCurso) + '&cursoNombre=' + encodeURIComponent(cursoNombre) + '&idMateria=' + encodeURIComponent(idMateria) + '&materiaNombre=' + encodeURIComponent(materiaNombre);

            window.location.href = url;

        }

    </script>

    
</body>

</html>
