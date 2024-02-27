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
            $opcion = $_POST['opcion']; 
            $id=$_POST["id"];
            $con=mysqli_connect("localhost","root","","gestion_calificaciones");
            if ($opcion == "1") {
                $sql="update curso_materia set id_estado = 1 where id_cm = ".$id;
                $res=mysqli_query($con,$sql);
                ?>
                <script>
                     Swal.fire({
                        title: 'ESTADO MODIFICADO!',
                        //text: 'You clicked the button!',
                        icon: 'success'
                        }).then(function() {
                            window.location.replace("cursoMateria.php");
                        });
                    
                </script>
                <?php
            } elseif ($opcion == "2") {
                $sql="update curso_materia set id_estado = 2 where id_cm = ".$id;
                $res=mysqli_query($con,$sql);
                ?>
                <script>
                Swal.fire({
                        title: 'ESTADO MODIFICADO!',
                        //text: 'You clicked the button!',
                        icon: 'success'
                        }).then(function() {
                            window.location.replace("cursoMateria.php");
                        });
                </script>
                <?php
            } else {
                ?>
                <script>
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NO SE MODIFICO EL ESTADO!',
                    }).then(function() {
                        window.location.replace("cursoMateria.php");
                    });
                
                </script>
                <?php
            }
        ?>

    </body>

</html>


