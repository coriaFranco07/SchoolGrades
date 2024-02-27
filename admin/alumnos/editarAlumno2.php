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

if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["correo"]) && !empty($_POST["usuario"]) && !empty($_POST["contraseña"]) && !empty($_POST["genero"]) && !empty($_POST["estado"])) {
    $con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
    $genero = $_POST["genero"];
    $estado = $_POST["estado"];

    $sql = "UPDATE alumnos SET nombre = '$nombre', apellido = '$apellido', correo = '$correo', usuario = '$usuario', contraseña = '$contraseña', id_sexo = $genero, id_estado = $estado WHERE id_alumno = $id";

    $res = mysqli_query($con, $sql);
    ?>
    <script>
        Swal.fire({
        title: 'ALUMNO MODIFICADO!',
        //text: 'You clicked the button!',
        icon: 'success'
        }).then(function() {
            window.location.replace("alumnos.php");
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
                        window.location.replace("alumnos.php");
            });
            
        </script>
    <?php
}
?>

</body>
</html>

