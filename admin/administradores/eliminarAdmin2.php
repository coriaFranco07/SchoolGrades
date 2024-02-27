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
            if ($opcion == "si") {
                $sql="delete from administradores where id_admin = ".$id;
                $res=mysqli_query($con,$sql);
                ?>
                <script>
                     Swal.fire({
                        title: 'ADMINISTRADOR ELIMINADO!',
                        //text: 'You clicked the button!',
                        icon: 'success'
                        }).then(function() {
                            window.location.replace("admin.php");
                        });
                    
                </script>
                <?php
            } elseif ($opcion == "no") {
                ?>
                <script>
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NO SE ELIMINO EL ADMINISTRADOR!',
                    }).then(function() {
                        window.location.replace("admin.php");
                    });
                
                </script>
                <?php
            } else {
                ?>
                <script>
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NO SE ELIMINO EL ADMINISTRADOR!',
                    }).then(function() {
                        window.location.replace("admin.php");
                    });
                
                </script>
                <?php
            }
        ?>

    </body>

</html>


    
    



