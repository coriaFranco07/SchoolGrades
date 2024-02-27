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

$usuario = "'" . $_POST["usuario"] . "'";
$mail = "'" . $_POST["mail"] . "'";
$contraseña = "'" . $_POST["password"] . "'";

$sql_profesor = "SELECT * FROM profesores WHERE correo = $mail AND contraseña = $contraseña AND usuario = $usuario";
$res_profesor = mysqli_query($con, $sql_profesor);
$cont_profesor = mysqli_num_rows($res_profesor);

$sql_admin = "SELECT * FROM administradores WHERE correo = $mail AND contraseña = $contraseña AND usuario = $usuario";
$res_admin = mysqli_query($con, $sql_admin);
$cont_admin = mysqli_num_rows($res_admin);

$sql_alumno = "SELECT * FROM alumnos WHERE correo = $mail AND contraseña = $contraseña AND usuario = $usuario";
$res_alumno = mysqli_query($con, $sql_alumno);
$cont_alumno = mysqli_num_rows($res_alumno);

if ($cont_profesor == 1) {
    $row_profesor = mysqli_fetch_assoc($res_profesor);
        $id_profesor = $row_profesor['id_profesor'];

        session_start();
        $_SESSION['username'] = $usuario;
        $_SESSION['id_profesor'] = $id_profesor;

        // Obtener el estado del profesor
        $estado_profesor = $row_profesor['id_estado'];

        if ($estado_profesor == 1) {
            ?>
            <script>
                Swal.fire({
                    title: 'BIENVENIDO PROFESOR!',
                    icon: 'success'
                }).then(function() {
                    window.location.replace("../profesor/principalProfe.php");
                });
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Profesor no habilitado!',
                }).then(function() {
                    window.location.replace("index.php");
                });
            </script>
            <?php
        }
    
} elseif ($cont_admin == 1) {
    $row_admin = mysqli_fetch_assoc($res_admin);
    $id_admin = $row_admin['id_admin'];

        session_start();
        $_SESSION['username'] = $usuario;
        $_SESSION['id_admin'] = $id_admin;

        // Obtener el estado del administrador
        $estado_admin = $row_admin['id_estado'];

        if ($estado_admin == 1) {
            ?>
            <script>
                Swal.fire({
                    title: 'BIENVENIDO ADMINISTRADOR!',
                    icon: 'success'
                }).then(function() {
                    window.location.replace("../admin/modoAdmin.php");
                });
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Administrador no habilitado!',
                }).then(function() {
                    window.location.replace("index.php");
                });
            </script>
            <?php
        }
     
} elseif ($cont_alumno == 1) {
    $row_alumno = mysqli_fetch_assoc($res_alumno);
    $id_alumno = $row_alumno['id_alumno'];

    session_start();
    $_SESSION['username'] = $usuario;
    $_SESSION['id_alumno'] = $id_alumno;

    // Obtener el estado del alumno
    $estado_alumno = $row_alumno['id_estado'];

    if ($estado_alumno == 1) {
        ?>
        <script>
            Swal.fire({
                title: 'BIENVENIDO ALUMNO!',
                icon: 'success'
            }).then(function() {
                window.location.replace("../alumnos/principalAlumnos.php");
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Alumno no habilitado!',
            }).then(function() {
                window.location.replace("index.php");
            });
        </script>
        <?php
    }
} else {
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'USUARIO NO EXISTENTE!',
        }).then(function() {
            window.location.replace("index.php");
        });
    </script>
    <?php
}
?>

    </body>

</html>


