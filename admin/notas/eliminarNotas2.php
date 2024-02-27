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
            $idCurso = $_POST['idCurso'];
            $cursoNombre = $_POST['cursoNombre'];
            $con=mysqli_connect("localhost","root","","gestion_calificaciones");
            if ($opcion == "si") {
                $sql="delete from calificacion_alumnos where id_calificacion = ".$id;
                $res=mysqli_query($con,$sql);
                ?>
                <script>
                     Swal.fire({
                        title: 'NOTA ELIMINADA!',
                        //text: 'You clicked the button!',
                        icon: 'success'
                        }).then(function() {
                            window.location.replace('notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>');
                        });
                    
                </script>
                <?php
            } elseif ($opcion == "no") {
                ?>
                <script>
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NO SE ELIMINO LA NOTA!',
                    }).then(function() {
                        window.location.replace('notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>');
                    });
                
                </script>
                <?php
            } else {
                ?>
                <script>
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NO SE ELIMINO LA NOTA!',
                    }).then(function() {
                        window.location.replace('notasAlumnos.php?idCurso=<?php echo $idCurso; ?>&cursoNombre=<?php echo $cursoNombre; ?>');
                    });
                
                </script>
                <?php
            }
        ?>

    </body>

</html>


    
    



