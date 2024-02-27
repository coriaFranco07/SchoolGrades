<?php
$id= $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
?>

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

            $sql="delete from curso_materia where id_cm = ".$id;
            $res=mysqli_query($conn,$sql);
            ?>
            <script>
                Swal.fire({
                title: 'MATERIA ELIMINADA!',
                    //text: 'You clicked the button!',
                    icon: 'success'
                    }).then(function() {
                        window.location.replace("cursoMateria.php");      
                    });
                    
            </script>
            <?php
            
        ?>

    </body>

</html>


    
    




