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
        $id_curso = $_POST['id_curso'];
        $id_materia = $_POST['materiaSelect'];
        $id_estado = 1;

        // Aquí puedes realizar las acciones necesarias con los valores capturados

        // Ejemplo: Insertar el ID del curso y el ID de la materia en una tabla de relaciones
        $conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
        $query = "INSERT INTO curso_materia (id_curso, id_materia, id_estado) VALUES ($id_curso, $id_materia, $id_estado)";
        $result = $conn->query($query);

        // Verificar si la inserción fue exitosa
        if ($result) {
            ?>
            <script>
                Swal.fire({
                title: 'MATERIA CARGADA!',
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
                    text: 'ERROR AL CARGAR MATERIA',
                    }).then(function() {
                        window.location.replace("cursoMateria.php");
                });
                
            </script>
            <?php
        }

        // Cerrar la conexión con la base de datos
        $conn->close();
        ?>
    </body>
</html>
