<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <hr>
    <body style="background-color: aliceblue;
    font-family: roboto;
    margin: auto;">

    <div class="container" tyle="background-color: aliceblue;
    font-family: roboto;
    margin: auto; border-radius: 15px 10px 15px 10px;">

        <h1 style="background-color: aliceblue;
        font-family: roboto;
        margin: auto;
        text-align: center; border-radius: 15px 10px 15px 10px;"></h1>


        <?php
        $con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
        if (!$con) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        if (!empty($_POST["tipo"]) && !empty($_POST["nivel"])) {
            $tipo = $_POST["tipo"];
            $nivel = $_POST["nivel"];

            // Verificar si el nombre del curso ya existe en la base de datos
            $verificar_curso_sql = "SELECT COUNT(*) FROM curso WHERE LOWER(tipo) = LOWER(?) AND nivel = ?";
            $verificar_curso_stmt = mysqli_prepare($con, $verificar_curso_sql);
            mysqli_stmt_bind_param($verificar_curso_stmt, "si", $tipo, $nivel);
            mysqli_stmt_execute($verificar_curso_stmt);
            mysqli_stmt_bind_result($verificar_curso_stmt, $count);
            mysqli_stmt_fetch($verificar_curso_stmt);

            mysqli_stmt_close($verificar_curso_stmt); // Cerrar el statement después de obtener el resultado

            if ($count > 0) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El nombre del curso ya existe en la base de datos',
                    }).then(function() {
                        window.location.replace("cursos.php");
                    });
                </script>
                <?php
            } else {
                // Insertar el nuevo registro
                $sql = "INSERT INTO curso (tipo, nivel) VALUES (?, ?)";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "si", $tipo, $nivel);

                $res = mysqli_stmt_execute($stmt);

                if ($res) {
                    ?>
                    <script>
                        Swal.fire({
                            title: 'CURSO CARGADO!',
                            icon: 'success'
                        }).then(function() {
                            window.location.replace("cursos.php");
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
                            window.location.replace("cursos.php");
                        });
                    </script>
                    <?php
                }
                
                mysqli_stmt_close($stmt); // Cerrar el statement después de la inserción
            }
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'HAY CAMPOS VACIOS',
                }).then(function() {
                    window.location.replace("cursos.php");
                });
            </script>
            <?php
        }

        mysqli_close($con);
        ?>

    </div>
        
    </body>

</html>