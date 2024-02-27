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

        <a href="eventos.php" class="btn btn-outline-light btn-lg px-5" style="background-color: #1f2735; right: 140px; width: 150px; position: fixed; background-color:black;">Cancelar</a>

        <?php
        $con = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
        if (!$con) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        if (!empty($_POST["tipo"])) {
            $tipo = $_POST["tipo"];

            // Verificar si el nombre de la materia ya existe en la base de datos
            $verificar_nombre_sql = "SELECT COUNT(*) FROM materia WHERE LOWER(tipo) = LOWER(?)";
            $verificar_nombre_stmt = mysqli_prepare($con, $verificar_nombre_sql);
            mysqli_stmt_bind_param($verificar_nombre_stmt, "s", $tipo);
            mysqli_stmt_execute($verificar_nombre_stmt);
            mysqli_stmt_bind_result($verificar_nombre_stmt, $count);
            mysqli_stmt_fetch($verificar_nombre_stmt);

            if ($count > 0) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'La materia ya existe',
                    }).then(function() {
                        window.location.replace("materias.php");
                    });
                </script>
                <?php
            } else {
                // Insertar el nuevo registro
                $sql = "INSERT INTO materia (tipo) VALUES (?)";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "s", $tipo);

                $res = mysqli_stmt_execute($stmt);

                if ($res) {
                    ?>
                    <script>
                        Swal.fire({
                            title: 'MATERIA CARGADA!',
                            icon: 'success'
                        }).then(function() {
                            window.location.replace("materias.php");
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
                            window.location.replace("materias.php");
                        });
                    </script>
                    <?php
                }
            }

            mysqli_stmt_close($verificar_nombre_stmt);
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'HAY CAMPOS VACIOS',
                }).then(function() {
                    window.location.replace("materias.php");
                });
            </script>
            <?php
        }

        mysqli_close($con);
        ?>

    </div>
        
    </body>

</html>