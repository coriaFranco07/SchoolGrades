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
        if (!$con) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        if (
            isset($_POST["nombre"]) &&
            isset($_POST["apellido"]) &&
            isset($_POST["correo"]) &&
            isset($_POST["usuario"]) &&
            isset($_POST["contraseña"]) &&
            isset($_POST["genero"]) &&
            isset($_POST["estado"]) 
            
        ) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $correo = $_POST["correo"];
            $usuario = $_POST["usuario"];
            $contraseña = $_POST["contraseña"];
            $genero = $_POST["genero"];
            $estado = $_POST["estado"];

            // Verificar si el correo ya existe en la base de datos
            $verificar_correo_sql = "SELECT correo FROM alumnos WHERE correo = ?";
            $verificar_correo_stmt = mysqli_prepare($con, $verificar_correo_sql);
            mysqli_stmt_bind_param($verificar_correo_stmt, "s", $correo);
            mysqli_stmt_execute($verificar_correo_stmt);
            mysqli_stmt_store_result($verificar_correo_stmt);

            if (mysqli_stmt_num_rows($verificar_correo_stmt) > 0) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El correo ya fue utilizado',
                    }).then(function() {
                        window.location.replace("alumnos.php");
                    });
                </script>
                <?php
            } else {
                // Insertar el nuevo registro
                $sql = "INSERT INTO alumnos (nombre, apellido, correo, usuario, contraseña, id_sexo, id_estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "ssssssi", $nombre, $apellido, $correo, $usuario, $contraseña, $genero, $estado);

                $res = mysqli_stmt_execute($stmt);

                if ($res) {
                    ?>
                    <script>
                        Swal.fire({
                            title: 'ALUMNO CARGADO!',
                            icon: 'success'
                        }).then(function() {
                            window.location.replace("alumnos.php");
                        });
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'ERROR AL CARGAR DATOS',
                        }).then(function() {
                            window.location.replace("alumnos.php");
                        });
                    </script>
                    <?php
                }
            }

            mysqli_stmt_close($verificar_correo_stmt);
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'HAY CAMPOS VACIOS',
                }).then(function() {
                    window.location.replace("alumnos.php");
                });
            </script>
            <?php
        }

        mysqli_close($con);
    ?>
</body>
</html>


