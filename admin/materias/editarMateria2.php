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

if (!empty($_POST["tipo"])) {
    $con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
    $id = $_POST["id"];
    $tipo = $_POST["tipo"];
    
    $sql = "UPDATE materia SET tipo = '$tipo' WHERE id_materia = $id";

    $res = mysqli_query($con, $sql);
    ?>
    <script>
        Swal.fire({
        title: 'MATERIA MODIFICADA!',
        //text: 'You clicked the button!',
        icon: 'success'
        }).then(function() {
            window.location.replace("materias.php");
        });
    </script>
    <?php
}
else{
    ?>
        <script>
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'HAY CAMPOS VACIOS!',
                    }).then(function() {
                    window.location.replace("materias.php");
            });
            
        </script>
    <?php
}
?>

</body>
</html>