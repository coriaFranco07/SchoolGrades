<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
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
    <style>
        body {
            background-color: #BAD8EC ;
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
        <h1>MATERIAS</h1>

        <button type="button" class="btn btn-primary" onclick="window.location.href='insertarMateria.php'">Agregar Materia</button>
        <button type="button" class="btn btn-dark" onclick="window.location.href='../curso_materia/cursoMateria.php'">Cancelar</button>

        <br><br><br><br>

        <?php
       
        $sql = "SELECT * FROM materia";
        $result = mysqli_query($conn, $sql);
        ?>

        <table id="materias" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ID_MATERIA</th>
                    <th scope="col">MATERIA</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['id_materia'] ?></td>
                        <td><?php echo $mostrar['tipo'] ?></td>
                        <td>
                            <button type="button" class="btn btn-info" onclick="window.location.href='editarMateria.php?id=<?php echo $mostrar["id_materia"]; ?>'">Editar</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='eliminarMateria.php?id=<?php echo $mostrar["id_materia"]; ?>'">Eliminar</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        
    </div>

    
</body>

</html>
