<?php
$id=$_GET["id"];
$con=mysqli_connect("localhost","root","","gestion_calificaciones");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' >
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <style>
            body {
            background-color: #BAD8EC;
            padding-top: 40px;
            text-align: center;
        }
        </style>
    </head>
<body>
<br><br><br>
    <a href="profesores.php" class="btn btn-outline-light btn-lg px-5" style="background-color: #1f2735; right: 140px; width: 150px; position: fixed; background-color: #1f2735; border-radius: 15px;">Volver</a>
    <form action="estadoProfesor2.php" align="center" method="post">
        <h2>¿A que estado va a modificar este Profesor?</h2>
        <input type="hidden" name="id" value="<?php echo $id  ?>">
        <input type="radio" name="opcion" value="1"> Activo
        <input type="radio" name="opcion" value="2"> Inactivo
        <br><br>
        <button type="submit" class="btn btn-dark">ACEPTAR</button>

    </form>
</body>
</html>