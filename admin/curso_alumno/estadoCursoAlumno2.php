<?php

$idEstado = $_POST['seleccion_estado'];
$idCursoAlumno = $_POST['parametro3'];
$idAlumno = $_POST['parametro1'];
$idCurso = $_POST['parametro2'];

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: aliceblue;
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
<body><br>

<?php

// Consulta para obtener el número total de materias en el curso
$sqlTotalMaterias = "SELECT COUNT(*) AS total_materias FROM curso_materia WHERE id_curso = ? AND id_estado = 1";
$stmtTotalMaterias = mysqli_prepare($conn, $sqlTotalMaterias);
mysqli_stmt_bind_param($stmtTotalMaterias, "i", $idCurso);
mysqli_stmt_execute($stmtTotalMaterias);
$resultTotalMaterias = mysqli_stmt_get_result($stmtTotalMaterias);
$rowTotalMaterias = mysqli_fetch_assoc($resultTotalMaterias);
$totalMaterias = $rowTotalMaterias['total_materias'];

// Consulta para verificar si el alumno ha aprobado todas las materias en el curso
$sqlAprobado = "SELECT COUNT(*) AS aprobado FROM calificacion_alumnos WHERE id_alumno = ? AND id_curso = ? AND id_estado = 4";
$stmtAprobado = mysqli_prepare($conn, $sqlAprobado);
mysqli_stmt_bind_param($stmtAprobado, "ii", $idAlumno, $idCurso);
mysqli_stmt_execute($stmtAprobado);
$resultAprobado = mysqli_stmt_get_result($stmtAprobado);
$rowAprobado = mysqli_fetch_assoc($resultAprobado);
$materiasAprobadas = $rowAprobado['aprobado'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_hora_actual = date('Y-m-d H:i:s');

// Verificar el estado y realizar las acciones correspondientes
if ($idEstado == 3) {
    if ($materiasAprobadas == $totalMaterias) {
        // Obtener el ID del curso_alumno anterior con fecha de fin nula utilizando otra consulta preparada
        $sqlPrevCursoAlumno = "SELECT id_ca FROM curso_alumno WHERE id_alumno = ? AND id_curso = ? AND fech_hasta IS NULL";
        $stmtPrevCursoAlumno = mysqli_prepare($conn, $sqlPrevCursoAlumno);
        mysqli_stmt_bind_param($stmtPrevCursoAlumno, "ii", $idAlumno, $idCurso);
        mysqli_stmt_execute($stmtPrevCursoAlumno);
        $resultPrevCursoAlumno = mysqli_stmt_get_result($stmtPrevCursoAlumno);

        if ($rowPrevCursoAlumno = mysqli_fetch_assoc($resultPrevCursoAlumno)) {
            $idPrevCursoAlumno = $rowPrevCursoAlumno['id_ca'];

            // Actualizar la fecha de fin del registro anterior utilizando otra consulta preparada
            $sqlUpdateFechaHasta = "UPDATE curso_alumno SET fech_hasta = ? WHERE id_ca = ?";
            $stmtUpdateFechaHasta = mysqli_prepare($conn, $sqlUpdateFechaHasta);
            mysqli_stmt_bind_param($stmtUpdateFechaHasta, "si", $fecha_hora_actual, $idPrevCursoAlumno);
            mysqli_stmt_execute($stmtUpdateFechaHasta);
        }

        // Insertar el nuevo registro en curso_alumno utilizando otra consulta preparada
        $sqlInsertCursoAlumno = "INSERT INTO curso_alumno (id_alumno, id_curso, id_estado, fecha_desde) VALUES (?, ?, ?, ?)";
        $stmtInsertCursoAlumno = mysqli_prepare($conn, $sqlInsertCursoAlumno);
        mysqli_stmt_bind_param($stmtInsertCursoAlumno, "iiis", $idAlumno, $idCurso, $idEstado, $fecha_hora_actual);
        mysqli_stmt_execute($stmtInsertCursoAlumno);

        // Obtener el ID del curso_alumno recién insertado
        $idCursoAlumno = mysqli_insert_id($conn);

        // Insertar el nuevo registro en curso_alumno_historial utilizando otra consulta preparada
        $sqlInsertCursoAlumnoHistorial = "INSERT INTO curso_alumno_historial (id_ca) VALUES (?)";
        $stmtInsertCursoAlumnoHistorial = mysqli_prepare($conn, $sqlInsertCursoAlumnoHistorial);
        mysqli_stmt_bind_param($stmtInsertCursoAlumnoHistorial, "i", $idCursoAlumno);
        mysqli_stmt_execute($stmtInsertCursoAlumnoHistorial);

        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17"></script>
        <script>
            Swal.fire({
                title: 'ESTADO MODIFICADO!',
                icon: 'success'
            }).then(function() {
                window.location.href = 'cursoAlumno.php';
            });
        </script>
        <?php
    } else {
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Este alumno todavia aprobo todas las materias!'
            }).then(function() {
                window.location.href = 'cursoAlumno.php';
            });
        </script>
        <?php
    }
} else if ($idEstado != 3) {
    // Obtener el ID del curso_alumno anterior con fecha de fin nula utilizando otra consulta preparada
    $sqlPrevCursoAlumno = "SELECT id_ca FROM curso_alumno WHERE id_alumno = ? AND id_curso = ? AND fech_hasta IS NULL";
    $stmtPrevCursoAlumno = mysqli_prepare($conn, $sqlPrevCursoAlumno);
    mysqli_stmt_bind_param($stmtPrevCursoAlumno, "ii", $idAlumno, $idCurso);
    mysqli_stmt_execute($stmtPrevCursoAlumno);
    $resultPrevCursoAlumno = mysqli_stmt_get_result($stmtPrevCursoAlumno);

    if ($rowPrevCursoAlumno = mysqli_fetch_assoc($resultPrevCursoAlumno)) {
        $idPrevCursoAlumno = $rowPrevCursoAlumno['id_ca'];

        // Actualizar la fecha de fin del registro anterior utilizando otra consulta preparada
        $sqlUpdateFechaHasta = "UPDATE curso_alumno SET fech_hasta = ? WHERE id_ca = ?";
        $stmtUpdateFechaHasta = mysqli_prepare($conn, $sqlUpdateFechaHasta);
        mysqli_stmt_bind_param($stmtUpdateFechaHasta, "si", $fecha_hora_actual, $idPrevCursoAlumno);
        mysqli_stmt_execute($stmtUpdateFechaHasta);
    }

    // Insertar el nuevo registro en curso_alumno utilizando otra consulta preparada
    $sqlInsertCursoAlumno = "INSERT INTO curso_alumno (id_alumno, id_curso, id_estado, fecha_desde) VALUES (?, ?, ?, ?)";
    $stmtInsertCursoAlumno = mysqli_prepare($conn, $sqlInsertCursoAlumno);
    mysqli_stmt_bind_param($stmtInsertCursoAlumno, "iiis", $idAlumno, $idCurso, $idEstado, $fecha_hora_actual);
    mysqli_stmt_execute($stmtInsertCursoAlumno);

    // Obtener el ID del curso_alumno recién insertado
    $idCursoAlumno = mysqli_insert_id($conn);

    // Insertar el nuevo registro en curso_alumno_historial utilizando otra consulta preparada
    $sqlInsertCursoAlumnoHistorial = "INSERT INTO curso_alumno_historial (id_ca) VALUES (?)";
    $stmtInsertCursoAlumnoHistorial = mysqli_prepare($conn, $sqlInsertCursoAlumnoHistorial);
    mysqli_stmt_bind_param($stmtInsertCursoAlumnoHistorial, "i", $idCursoAlumno);
    mysqli_stmt_execute($stmtInsertCursoAlumnoHistorial);

    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17"></script>
    <script>
        Swal.fire({
            title: 'ESTADO MODIFICADO!',
            icon: 'success'
        }).then(function() {
            window.location.href = 'cursoAlumno.php';
        });
    </script>
    <?php
}
?>

</body>
</html>
