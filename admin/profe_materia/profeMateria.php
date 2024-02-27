<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

session_start();

$querypa = "select * from administradores where usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_profesor = $a["id_admin"];
    $nombre = $a["nombre"];
    $apellido= $a["apellido"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUOTAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        body {
            background-color: #BAD8EC;
            font-family: "Roboto", sans-serif;
            text-align: center;
        }
        .container {
            background-color: aliceblue;
            margin: auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            background-color: aliceblue;
            border-radius: 15px 10px 15px 10px;
            padding: 10px;
        }
        
    </style>
</head>
<br>
<body>
    <div class="container">
        <h1>PROFES/MATERIAS</h1>
        <h5><?php echo $nombre . ' ' . $apellido ?></h5>
        <br>
        <button type="button" class="btn btn-primary" onclick="window.location.href='insertarProfeMateria.php'">Agregar Profe a Materia</button>
        <button type="button" class="btn btn-dark" onclick="window.location.href='../modoAdmin.php'">Cancelar</button>

        <br><br><br><br>

        <?php
       
        $sql = "SELECT p.id_pm, s.id_profesor, e.id_materia, x.id_estado, s.nombre, s.apellido AS profesores , e.tipo AS materia, x.tipo AS estado
        FROM profe_materia p
        JOIN materia e ON p.id_materia = e.id_materia
        JOIN profesores s ON p.id_profesor = s.id_profesor
        JOIN estado x ON p.id_estado = x.id_estado";
        $result = mysqli_query($conn, $sql);
        ?>

        <table id="profeMaterias" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ID_PROFE/MATERIA</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">MATERIA</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['id_pm'] ?></td>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['profesores'] ?></td>
                        <td><?php echo $mostrar['materia'] ?></td>
                        <td><?php echo $mostrar['estado'] ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" onclick="window.location.href='estadoProfeMateria.php?id=<?php echo $mostrar["id_pm"]; ?>'">Estado</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready( function() {
            $('#profeMaterias').DataTable();
        });
    </script>

</body>

</html>
