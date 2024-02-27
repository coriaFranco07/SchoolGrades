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
$seleccion_curso = $_POST['seleccion_curso'];
$seleccion_alumno = $_POST['seleccion_alumno'];
$estado = 1;

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_hora_actual = date('Y-m-d H:i:s');

// Ejemplo: Insertar el ID del curso y el ID de ALUMNO en una tabla de relaciones
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Use prepared statement to handle the parameterized query
$query = "INSERT INTO curso_alumno (id_alumno, id_curso, id_estado, fecha_desde) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "iiis", $seleccion_alumno, $seleccion_curso, $estado, $fecha_hora_actual);
$result = mysqli_stmt_execute($stmt);

// Obtener el id_curso_alumno recién insertado
$id_curso_alumno = mysqli_insert_id($conn);

$query2 = "INSERT INTO curso_alumno_historial (id_ca) VALUES (?)";
$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, "i", $id_curso_alumno);
$result2 = mysqli_stmt_execute($stmt2);

// Verificar si la inserción fue exitosa
if ($result && $result2) {
    ?>
    <script>
        Swal.fire({
        title: 'ALUMNO CARGADO!',
        icon: 'success'
        }).then(function() {
            window.location.replace("cursoAlumno.php");
        });
    </script>
<?php
} else {
    ?>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'ERROR AL CARGAR ALUMNO',
    }).then(function() {
        window.location.replace("cursoAlumno.php");
    });
    </script>
    <?php
}

// Cerrar la conexión con la base de datos
mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt2);
mysqli_close($conn);
?>
</body>
</html>




 