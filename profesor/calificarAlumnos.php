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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idAlumno = $_POST['id_alumno'];
    $punt1 = $_POST['punt1'];
    $punt2 = $_POST['punt2'];
    $comentario = $_POST['comentario'];
    $promedio = ($punt1 + $punt2) / 2;
    $estado=0;

    if($promedio >= 7){
        $estado=4;
    }else{
        $estado=5;
    }
    
    // Guardar las calificaciones en la base de datos
    $query = "INSERT INTO calificacion_alumnos (id_alumno, id_profesor, id_materia, id_curso, punt_1, punt_2, comentario, promedio, id_estado) 
            VALUES ($idAlumno, $id_profesor, $idMateria, $idCurso, $punt1, $punt2, '$comentario', $promedio, $estado)";
    mysqli_query($conn, $query);

    $query2 = "INSERT INTO calificacion_alumnos_historial (id_alumno, id_profesor, id_materia, id_curso, punt_1, punt_2, comentario, promedio, id_estado, fecha_registro) 
    VALUES ($idAlumno, $id_profesor, $idMateria, $idCurso, $punt1, $punt2, '$comentario', $promedio, $estado, NOW())";
    mysqli_query($conn, $query2);



    // Redirigir a la misma página para recargarla
    header("Location: calificarAlumnos.php?idCurso=$idCurso&cursoNombre=$cursoNombre&idMateria=$idMateria&materiaNombre=$materiaNombre");
    exit();
}

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
            WHERE z.id_curso = $idCurso AND x.tipo = 'activo' AND z.fech_hasta IS NULL
            AND z.id_alumno NOT IN (
                SELECT id_alumno FROM calificacion_alumnos WHERE id_curso = $idCurso AND id_materia = $idMateria
            )";
            $result = mysqli_query($conn, $sql);

            
        ?>

        <table id="alumnos" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ID_ALUMNO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">PUNT1</th>
                    <th scope="col">PUNT2</th>
                    <th scope="col">PROM</th>
                    <th scope="col">COMENT</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <form method="post" action="" onsubmit="return validarFormulario()" id="calificacionForm">
                            <td>
                                <?php echo $mostrar['id_alumno'] ?>
                                <input type="hidden" name="id_alumno" value="<?php echo $mostrar['id_alumno'] ?>">
                            </td>
                            <td><?php echo $mostrar['nombre'] ?></td>
                            <td><?php echo $mostrar['apellido'] ?></td>
                            <td><input type="number" min="0" max="10" class="punt1" name="punt1" required></td>
                            <td><input type="number" min="0" max="10" class="punt2" name="punt2" required></td>
                            <td class="promedio"></td>
                            <td><input type="text" id="comentario" class="comentario" name="comentario" style="width: 300px; height: 100px;"></td>
                            <td><button type="submit" class="btn btn-dark">Calificar</button></td>
                        </form>
                    </tr>
                <?php
                }
            ?>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>

                    $(document).ready(function() {
                        $('table#alumnos').on('input', 'input.punt1, input.punt2', function() {
                            var $row = $(this).closest('tr');
                            var punt1 = parseFloat($row.find('input.punt1').val());
                            var punt2 = parseFloat($row.find('input.punt2').val());
                            var promedio = (punt1 + punt2) / 2;
                            $row.find('.promedio').text(promedio.toFixed(2));
                        });
                    });

                    function validarFormulario() {
                        var comentario = document.getElementById('comentario').value;

                        if (comentario.trim() === '') {
                            alert('Por favor, ingrese un comentario.');
                            return false;
                        }

                        return true;
                    }

                </script>
            </tbody>
        </table>
        
    </div>

</body>

</html>
