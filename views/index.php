<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Roboto", sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-image: url('../img/imgenFondoAzul.png');
            background-size: 110%; /* Ajusta el tamaño de la imagen al 70% */
            background-position: center;
        }

        .card {
            border-radius: 1rem;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        #campoPago {
            margin-top: 50px;
        }
    </style>
</head>

<body>
<br><br><br>
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body p-5 text-center">

                        <h2 class="fw-bold mb-4 text-uppercase" style="color: #1C75B0">BIENVENIDO A LA INSTITUCION</h2>

                        <form action="comprobarUsuario.php" method="POST" align="center">
                            <div class="form-group mb-4">
                                <input class="form-control form-control-lg" type="text" name="usuario" placeholder="Ingresa tu usuario...">
                            </div>

                            <div class="form-group mb-4">
                                <input class="form-control form-control-lg" type="password" name="password" placeholder="Ingresa tu contraseña...">
                            </div>

                            <div class="form-group mb-4">
                                <input class="form-control form-control-lg" type="email" name="mail" placeholder="Ingresa tu correo electrónico...">
                            </div>

                            <button class="btn btn-outline-light btn-lg px-5" type="submit">Aceptar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
