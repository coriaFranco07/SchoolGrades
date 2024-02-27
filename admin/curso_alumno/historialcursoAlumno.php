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
        <h1>HISTORIAL CURSOS/ALUMNOS</h1>

        <button type="button" class="btn btn-dark" onclick="window.location.href='cursoAlumno.php'">Cancelar</button>

        <br><br><br><br>

        <?php
       
        $sql = "SELECT 
        curso_alumno_historial.id_cah,
        alumnos.nombre as nombre,
         alumnos.apellido as apellido,
        curso.tipo as curso,
        estado.tipo as estado,
        curso_alumno.fecha_desde,
        curso_alumno.fech_hasta 
    FROM curso_alumno
    LEFT JOIN curso_alumno_historial ON curso_alumno.id_ca = curso_alumno_historial.id_ca
    LEFT JOIN alumnos ON curso_alumno.id_alumno = alumnos.id_alumno
    LEFT JOIN curso ON curso_alumno.id_curso = curso.id_curso
    LEFT JOIN estado ON curso_alumno.id_estado = estado.id_estado;";
        $result = mysqli_query($conn, $sql);
        ?>

        <table id="historialCursosAlumnos" class="table table-bordered table-striped text-center">
            <thead>
                <tr class="bg-primary text-white">
                    <th scope="col">ID_CA_HISTORIAL</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">CURSO</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">FECH_DESDE</th>
                    <th scope="col">FECH_HASTA</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar = mysqli_fetch_array($result)) {

                    ?>
                    <tr>
                        <td><?php echo $mostrar['id_cah'] ?></td>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['apellido'] ?></td>
                        <td><?php echo $mostrar['curso'] ?></td>
                        <td><?php echo $mostrar['estado'] ?></td>
                        <td><?php echo $mostrar['fecha_desde'] ?></td>
                        <td><?php echo $mostrar['fech_hasta'] ?></td>
                        
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
            $('#historialCursosAlumnos').DataTable();
        });
    </script>

</body>

</html>
