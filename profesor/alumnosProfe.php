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

    </style>
</head>
<br>
<body>

    <div class="container">
        <h1>ALUMNOS</h1>
        <h5><?php echo $cursoNombre?></h5>
        <h5><?php echo $materiaNombre?></h5>
        <h6>Profesor: <?php echo $nombre. ' ' .$apellido?></h6>

        <button type="button" class="btn btn-dark" onclick="window.location.href='principalAlumnoProfe.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>&idMateria=<?php echo $idMateria ?>&materiaNombre=<?php echo $materiaNombre ?>'">volver</button>
        
        <br><br>

        <?php 
            $sql = "SELECT z.id_alumno, a.nombre, a.apellido
            FROM curso_alumno z
            INNER JOIN alumnos a ON z.id_alumno = a.id_alumno
            INNER JOIN estado x ON z.id_estado = x.id_estado
            WHERE z.id_curso = $idCurso AND x.tipo = 'activo' AND z.fech_hasta IS NULL";

            $result = mysqli_query($conn, $sql);
        ?>

        <table id="alumnos" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ID_ALUMNO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['id_alumno'] ?></td>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['apellido'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        

    </div>
        
    
</body>

</html>
