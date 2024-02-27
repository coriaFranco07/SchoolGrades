<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

session_start();

$querypa = "select * from profesores where usuario = " . $_SESSION["username"];
$resultado = mysqli_query($conn, $querypa);

while ($a = mysqli_fetch_array($resultado)) {
    $id_profesor = $a["id_profesor"];
    $nombre = $a["nombre"];
    $apellido = $a["apellido"];
}

$idCurso = $_GET['idCurso'];
$cursoNombre = $_GET['cursoNombre'];
$idMateria = $_GET['idMateria'];
$materiaNombre = $_GET['materiaNombre'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>Gmail de la Escuela</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f5f5f5;
    }
    h1 {
      color: #333;
      font-size: 28px;
      margin-bottom: 20px;
    }
    p {
      line-height: 1.6;
      color: #555;
    }
    ul {
      padding-left: 20px;
    }
    li {
      margin-bottom: 8px;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .custom-btn {
        padding: 12px 24px;
        border-radius: 5px;
        background-color: #1f2735;
        color: #fff;
        border: none;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #29374a;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Gmail de la Institucion</h1>
    <button type="button" class="btn btn-dark custom-btn" onclick="window.location.href='principalAlumnoProfe.php?idCurso=<?php echo $idCurso ?>&cursoNombre=<?php echo $cursoNombre ?>&idMateria=<?php echo $idMateria ?>&materiaNombre=<?php echo $materiaNombre ?>'">Volver</button>
    <p>El Gmail de nuestra institucion (<a href="mailto:info@institucionArg.com">info@institucionArg.com</a>) proporciona una serie de servicios esenciales para estudiantes y personal educativo. Algunos de los servicios incluyen:</p>
    <ul>
      <li>Comunicación rápida y eficiente entre estudiantes, profesores y personal administrativo.</li>
      <li>Acceso a Google Drive para almacenar y compartir archivos relacionados con la educación.</li>
      <li>Calendario integrado para gestionar eventos, horarios y recordatorios importantes.</li>
      <li>Herramientas colaborativas como Google Docs, Sheets y Slides para trabajar en grupo.</li>
      <li>Acceso a Google Classroom para recibir y enviar tareas, así como interactuar con los compañeros de clase.</li>
      <li>Capacidad para enviar y recibir correos electrónicos con una dirección de correo electrónico personalizada de la escuela.</li>
    </ul>
    <p>Estos servicios, entre otros, hacen que el Gmail de nuestra institucion sea una herramienta fundamental para el aprendizaje y la comunicación efectiva en nuestra comunidad educativa.</p>
  </div>
</body>
</html>
