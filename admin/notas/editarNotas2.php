<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php

$con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
$id = $_POST["id"];
$punt_1 = $_POST["punt_1"];
$punt_2 = $_POST["punt_2"];
$comentario = $_POST["comentario"];
$promedio = ($punt_1 + $punt_2) / 2;
$idCurso = $_POST['idCurso'];
$cursoNombre = $_POST['cursoNombre'];

$sqlSelectOriginal = "SELECT  ca.id_alumno, ca.id_profesor, ca.id_materia, ca.id_curso
FROM calificacion_alumnos ca
WHERE ca.id_calificacion = $id";
$resultOriginal = $con->query($sqlSelectOriginal);
$rowOriginal = $resultOriginal->fetch_assoc();


if (!empty($_POST["punt_1"]) && !empty($_POST["punt_2"]) && !empty($_POST["comentario"])) {
    
    
    if($promedio >= 7){
        $estado = 4;
    }else{
        $estado = 5;
    }
   
    $sql = "UPDATE calificacion_alumnos SET punt_1 = '$punt_1', punt_2 = '$punt_2', promedio = '$promedio', comentario = '$comentario', id_estado = '$estado' WHERE id_calificacion = $id";
    
    if (mysqli_query($con, $sql)) {

        $sqlInsertHistorial = "INSERT INTO calificacion_alumnos_historial (id_alumno, id_profesor, id_materia, id_curso, punt_1, punt_2, promedio, comentario, id_estado, fecha_registro)
        VALUES (" . $rowOriginal['id_alumno'] . ", " . $rowOriginal['id_profesor'] . ", " . $rowOriginal['id_materia'] . ", " . $rowOriginal['id_curso'] . ", " . $punt_1 . ", " . $punt_2 . ", " . $promedio . ", '" . $comentario . "', " . $estado . ", NOW())";
        $con->query($sqlInsertHistorial);


        if (mysqli_query($con, $sqlSelectOriginal)) {
            echo "<script>
                    Swal.fire({
                        title: 'NOTA MODIFICADA!',
                        icon: 'success'
                    }).then(function() {
                        window.location.replace('notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>');
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al actualizar el historial de calificaciones.',
                    }).then(function() {
                        window.location.replace('notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>');
                    });
                </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al actualizar la calificación.',
                }).then(function() {
                    window.location.replace('notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>');
                });
            </script>";
    }
    
    mysqli_close($con);
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'HAY CAMPOS VACIOS!',
            }).then(function() {
                window.location.replace('notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>');
            });
        </script>";
}
?>

</body>
</html>

