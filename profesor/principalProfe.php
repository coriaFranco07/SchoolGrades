<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
session_start();

$querypa = "SELECT * FROM profesores WHERE usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_profesor = $a["id_profesor"];
    $nombre = $a["nombre"];
    $apellido= $a["apellido"];
}

$sql = "SELECT cp.id_cp, cp.id_curso, x.tipo
        FROM curso_profe cp
        INNER JOIN profesores p ON cp.id_profesor = p.id_profesor
        INNER JOIN curso x ON cp.id_curso = x.id_curso
        INNER JOIN estado e ON cp.id_estado = e.id_estado
        WHERE p.id_profesor = $id_profesor AND e.tipo = 'activo' ";
$result = mysqli_query($conn, $sql);

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    
<br>

    <div class="container">

    <figure class="text-center">
        <blockquote class="blockquote">
            <p>Bienvenido/a: <?php echo $nombre. ' ' .$apellido?></p>
        </blockquote>
        <figcaption class="blockquote-footer">
           Aqui estan tus <cite title="Título fuente">cursos activos</cite>
        </figcaption>
    </figure><br>

    <button type="button" class="btn btn-danger btn-lg" onclick="window.location.href='../views/index.php'">Cerrar Sesion</button><br><br>

    <div class="row">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $idCurso = $row['id_curso'];
        $cursoNombre= $row['tipo'];
        ?>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center;">ID: <?php echo $idCurso; ?></h5><br>
                    <h5 class="card-title" style="text-align: center;"><?php echo $cursoNombre; ?></h5>
                    <a href="#" class="btn btn-primary" style="display: flex; justify-content: center;" onclick="seleccionarCurso('<?php echo $idCurso; ?>', '<?php echo $cursoNombre; ?>')">
                        Seleccionar
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
  </div>
</div>
</div>

    <script>
        function seleccionarCurso(idCurso, cursoNombre) {
            // Construir la URL con los parámetros
            var url = '../profesor/materiasProfe.php?idCurso=' + encodeURIComponent(idCurso) + '&cursoNombre=' + encodeURIComponent(cursoNombre);

            // Realizar la verificación de las materias del profesor en el curso
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../profesor/verificarMaterias.php?idProfesor=<?php echo $id_profesor; ?>&idCurso=" + encodeURIComponent(idCurso), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Redirigir a la página con los parámetros si las materias coinciden
                        window.location.href = url;
                    } else {

                        
                        
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Te corresponde este curso, pero por el momento en este curso no hay ninguna de tus materias!',
                        //text: 'PODRAS INGRESAR CUANDO ASIGNEN ALGUNAS DE TUS MATERIAS!'
                        })
                       
                        

                    }
                }
            };
            xhr.send();
        }
    </script>

    <!-- ... -->
</body>

</html>
