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
        <h1>MIS NOTAS</h1>
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

        <table id="calificaciones" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">PROFESOR</th>
                    <th scope="col">MATERIA</th>
                    <th scope="col">NOTA 1</th>
                    <th scope="col">NOTA 2</th>
                    <th scope="col">PROMEDIO</th>
                    <th scope="col">COMENTARIO</th>
                    <th scope="col">ESTADO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['nombre_profesor'] ?> <?php echo $mostrar['apellido_profesor'] ?></td>
                        <td><?php echo $mostrar['nombre_materia'] ?></td>
                        <td><?php echo $mostrar['punt_1'] ?></td>
                        <td><?php echo $mostrar['punt_2'] ?></td>
                        <td><?php echo $mostrar['promedio'] ?></td>
                        <td><?php echo $mostrar['comentario'] ?></td>
                        <td><?php echo $mostrar['nombre_estado'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
 
    </div>

   
    
</body>

</html>