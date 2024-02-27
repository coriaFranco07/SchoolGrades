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
$seleccion_profe = $_POST['seleccion_profe'];
$estado = 1;

$con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

if ($con) {
    // Verificar si los datos ya existen en la base de datos
    $verificar_sql = "SELECT * FROM curso_profe WHERE id_profesor = '$seleccion_profe' AND id_curso = '$seleccion_curso'";
    $verificar_res = mysqli_query($con, $verificar_sql);

    if ($verificar_res && mysqli_num_rows($verificar_res) > 0) {
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El profesor elegido ya tiene asignado ese curso',
            }).then(function() {
                window.location.replace("cursoProfe.php");
            });
        </script>
        <?php
    } else {
        // Los datos no existen, realizar la inserción
        $insert_sql = "INSERT INTO curso_profe (id_profesor, id_curso, id_estado) VALUES ('$seleccion_profe', '$seleccion_curso', '$estado')";
        $insert_res = mysqli_query($con, $insert_sql);

        if ($insert_res) {
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: 'PROFESOR Y CURSO CARGADO!',
                    icon: 'success'
                }).then(function() {
                    window.location.replace("cursoProfe.php");
                });
            </script>
            <?php
        } else {
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ha ocurrido un error al cargar',
                }).then(function() {
                    window.location.replace("cursoProfe.php");
                });
            </script>
            <?php
        }
    }
} else {
    die("Error de conexión: " . mysqli_connect_error());
}
?>


</body>

