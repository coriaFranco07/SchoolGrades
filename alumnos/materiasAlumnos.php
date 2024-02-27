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
$cursoNombre= $_GET['cursoNombre'];
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
        <h1>MATERIAS DEl CURSO</h1>
        <h3><?php echo $cursoNombre ?></h3>
        <h6><?php echo $nombre .' '. $apellido?></h6>
        <a class="btn btn-dark"  href="#" onclick="redirigirAPrincipalAlumnos2()">Volver</a>

        <br><br><br><br>

        <?php
       
        $sql = "SELECT materia.*
        FROM materia
        INNER JOIN curso_materia ON materia.id_materia = curso_materia.id_materia
        WHERE curso_materia.id_curso = $idCurso AND curso_materia.id_estado=1;";
        $result = mysqli_query($conn, $sql);
        ?>

        <table id="materias" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ID_MATERIA</th>
                    <th scope="col">MATERIA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['id_materia'] ?></td>
                        <td><?php echo $mostrar['tipo'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function redirigirAPrincipalAlumnos2() {
        // Obtener los valores de las variables PHP en JavaScript
        var idCurso = '<?php echo $idCurso; ?>';
        var cursoNombre = '<?php echo $cursoNombre; ?>';

        // Construir la URL con los parámetros
        var url = 'principalAlumnos2.php?idCurso=' + idCurso + '&cursoNombre=' + cursoNombre;

        // Redirigir al usuario a la página principalAlumnos2.php con los parámetros
        window.location.href = url;
        }
    </script>
    
</body>

</html>
