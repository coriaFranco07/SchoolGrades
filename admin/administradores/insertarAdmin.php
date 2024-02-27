<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
        body {
            background-color:#BAD8EC ;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h6 {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #1f2735;
            color: #fff;
            border: none;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
   <br>
    <div class="container">
        
        <form action="insertarAdmin2.php" method="POST" align="center">
            <h2>Registro de Administrador</h2> 
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="text" name="apellido" placeholder="Apellido" required><br>
            <input type="text" name="correo" placeholder="Correo" required><br>
            <input type="text" name="usuario" placeholder="Usuario" required><br>
            <input type="password" name="contraseña" placeholder="Contraseña" required><br>

            <h6>Sexo</h6>
            <input type="radio" id="masculino" name="genero" value="1" required>
            <label for="masculino">Masculino</label>
            <input type="radio" id="femenino" name="genero" value="2" required>
            <label for="femenino">Femenino</label><br>

            <h6>Estado</h6>
            <input type="radio" id="activo" name="estado" value="1" required>
            <label for="activo">Activo</label>
            <input type="radio" id="no_activo" name="estado" value="2" required>
            <label for="no_activo">Inactivo</label><br>

            <input type="submit" value="Registrar" class="btn btn-primary btn-block"><hr>
            <a href="admin.php" class="btn btn-outline-light btn-lg btn-block mb-4" style="background-color: #1f2735; border-radius: 15px;">Volver</a>
        </form>
    </div>
</body>
</html>