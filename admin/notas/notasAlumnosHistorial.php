<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
session_start();

$querypa = "select * from administradores where usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_admin = $a["id_admin"];
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
    <title>HISTORIAL NOTAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
        <h1>HISTORIAL NOTAS</h1>
        <h3><?php echo $cursoNombre ?></h3>
        <h6><?php echo $nombre . ' ' . $apellido ?></h6>
        <br>

        <button type="button" class="btn btn-dark" onclick="window.location.href='notasAlumnos.php?idCurso=<?php echo $_GET['idCurso']; ?>&cursoNombre=<?php echo urlencode($_GET['cursoNombre']); ?>'">Cancelar</button>

        <br><br>

        <?php
        
        $sql = "SELECT ch.id_cal_historial, a.nombre AS nombre_alumno, a.apellido AS apellido_alumno ,p.nombre AS nombre_profesor, p.apellido AS apellido_profesor , m.tipo AS nombre_materia, c.tipo AS nombre_curso,
        ch.punt_1, ch.punt_2, ch.promedio, ch.comentario, ch.fecha_registro ,e.tipo AS nombre_estado
        FROM calificacion_alumnos_historial ch
        JOIN alumnos a ON ch.id_alumno = a.id_alumno
        JOIN profesores p ON ch.id_profesor = p.id_profesor
        JOIN materia m ON ch.id_materia = m.id_materia
        JOIN estado e ON ch.id_estado = e.id_estado
        JOIN curso c ON ch.id_curso = c.id_curso
        WHERE ch.id_curso = $idCurso";
        
        $result = mysqli_query($conn, $sql);
        ?>

        <table id="calificaciones" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ALUMNO</th>
                    <th scope="col">PROFESOR</th>
                    <th scope="col">MATERIA</th>
                    <th scope="col">NOTA 1</th>
                    <th scope="col">NOTA 2</th>
                    <th scope="col">PROMEDIO</th>
                    <th scope="col">COMENTARIO</th>
                    <th scope="col">FECHA REGISTRO</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['nombre_alumno'] ?> <?php echo $mostrar['apellido_alumno'] ?></td>
                        <td><?php echo $mostrar['nombre_profesor'] ?> <?php echo $mostrar['apellido_profesor'] ?></td>
                        <td><?php echo $mostrar['nombre_materia'] ?></td>
                        <td><?php echo $mostrar['punt_1'] ?></td>
                        <td><?php echo $mostrar['punt_2'] ?></td>
                        <td><?php echo $mostrar['promedio'] ?></td>
                        <td><?php echo $mostrar['comentario'] ?></td>
                        <td><?php echo $mostrar['fecha_registro'] ?></td>
                        <td><?php echo $mostrar['nombre_estado'] ?></td>
                        <td> 
                        <button type="button" class="btn btn-danger" onclick="window.location.href='eliminarNotasHist.php?id=<?php echo $mostrar["id_cal_historial"]; ?>&idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>'">Eliminar</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
 
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function() {
            $('#calificaciones').DataTable();
        });
    </script>
    
</body>

</html>