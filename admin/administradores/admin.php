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
        .btn-historial {
            background-color: #1f2735;
            color: #fff;
            width: 200px;
        }
        .btn-cancelar {
            background-color: #1f2735;
            color: #fff;
            width: 150px;
            position: fixed;
            right: 140px;
        }
        #cuotas {
            margin-top: 50px;
        }

        .btn-volver {
            background-color: #1f2735;
            color: #fff;
            right: 140px;
            width: 150px;
            background-color: #1f2735;
        }


        #campoPago {
            margin-top: 50px;
        }
    </style>
</head>
<br>
<body>
    <div class="container">
        <h1>ADMINISTRADORES</h1>
        <h5><?php echo $nombre . ' ' . $apellido ?></h5>
        <br>
        <button type="button" class="btn btn-primary" onclick="window.location.href='insertarAdmin.php'">Agregar Administrador</button>
        <button type="button" class="btn btn-dark" onclick="window.location.href='../modoAdmin.php'">Cancelar</button>

        <br><br><br><br>

        <?php
        
        $sql = "SELECT p.id_admin, p.nombre, p.apellido, p.correo, p.usuario, s.tipo AS sexo, e.tipo AS estado
        FROM administradores p
        JOIN sexo s ON p.id_sexo = s.id_sexo
        JOIN estado e ON p.id_estado = e.id_estado;";
        $result = mysqli_query($conn, $sql);
        ?>

        <table id="administradores" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ID_ADMIN</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">CORREO</th>
                    <th scope="col">USUARIO</th>
                    <th scope="col">SEXO</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['id_admin'] ?></td>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['apellido'] ?></td>
                        <td><?php echo $mostrar['correo'] ?></td>
                        <td><?php echo $mostrar['usuario'] ?></td>
                        <td><?php echo $mostrar['sexo'] ?></td>
                        <td><?php echo $mostrar['estado'] ?></td>
                        <td>
                            <button type="button" class="btn btn-info" onclick="window.location.href='editarAdmin.php?id=<?php echo $mostrar["id_admin"]; ?>'">Editar</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='eliminarAdmin.php?id=<?php echo $mostrar["id_admin"]; ?>'">Eliminar</button>
                            <button type="button" class="btn btn-warning" onclick="window.location.href='estadoAdmin.php?id=<?php echo $mostrar["id_admin"]; ?>'">Estado</button>
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
            $('#administradores').DataTable();
        });
    </script>
    
</body>

</html>