<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
$sql = "SELECT * FROM curso";
$result = mysqli_query($conn, $sql);

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
    <title>Cursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
<body><br>
<div class="container">
  
  <br><h1 style="text-align: center;">CURSOS</h1>
  <h5><?php echo $nombre . ' ' . $apellido ?></h5>
        <br>
  
  <button type="button" class="btn btn-dark" onclick="window.location.href='../materias/materias.php'">VER MATERIAS</button>
  <button type="button" class="btn btn-dark" onclick="window.location.href='../cursos/cursos.php'">VER CURSOS</button>
  <button type="button" class="btn btn-dark" onclick="window.location.href='../modoAdmin.php'">Volver</button><br><br>

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

<!-- Ventana modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Datos del curso seleccionado</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <button type="button" class="btn btn-info" onclick="seleccionarMateria()">Agregar Materia</button>
      <br>
      <button type="button" class="btn btn-danger" onclick="borrarMateria()">Borrar Materia</button>
      <br>
      <button type="button" class="btn btn-warning" onclick="estadoMateria()">Estado Materia</button>


      

      <div class="modal-body">
        <p id="cursoID"></p>
        <h5>Materias del curso:</h5>
        <table class="table table-bordered table-striped text-center" id="cursosMateria">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Materia</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <!-- Las filas se llenarán dinámicamente con datos -->
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>

  var selectedCourseId;

  function seleccionarCurso(id, cursoNombre) {
    // Consultar los cursos relacionados con el curso seleccionado
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Actualizar los elementos en la ventana modal con los datos capturados
        document.getElementById("cursoID").textContent = cursoNombre;
        document.getElementById("cursoID").style.fontWeight = "bold";
        document.getElementById("cursoID").style.fontSize = "20px";
        document.getElementById("cursoID").style.textAlign = "center";

        // Parsear la respuesta JSON y mostrar los cursos en la ventana modal
        var cursosMateria = JSON.parse(this.responseText);
        var cursosTable = document.getElementById("cursosMateria");
        cursosTable.innerHTML = ""; // Limpiar la tabla antes de agregar nuevos datos

        // Crear encabezados de tabla
        var tableHeader = document.createElement("tr");
        var idHeader = document.createElement("th");
        idHeader.textContent = "ID";
        var materiaHeader = document.createElement("th");
        materiaHeader.textContent = "Materia";
        var estadoHeader = document.createElement("th");
        estadoHeader.textContent = "Estado";

        tableHeader.appendChild(idHeader);
        tableHeader.appendChild(materiaHeader);
        tableHeader.appendChild(estadoHeader);
        cursosTable.appendChild(tableHeader);

        // Agregar filas de datos a la tabla
        cursosMateria.forEach(function(curso) {
          var tableRow = document.createElement("tr");
          var idCell = document.createElement("td");
          idCell.textContent = curso.id_cm;
          var materiaCell = document.createElement("td");
          materiaCell.textContent = curso.materia;
          var estadoCell = document.createElement("td");
          estadoCell.textContent = curso.estado;
          
          tableRow.appendChild(idCell);
          tableRow.appendChild(materiaCell);
          tableRow.appendChild(estadoCell);
          cursosTable.appendChild(tableRow);
        });

        // Mostrar la ventana modal
        var myModal = new bootstrap.Modal(document.getElementById("myModal"));
        myModal.show();

        // Establecer el valor del atributo data-id del botón "Insertar Materia"
        var insertarMateriaBtn = document.querySelector("#myModal [data-id]");
        insertarMateriaBtn.dataset.id = id;
      }
    };

    xhttp.open("GET", "obtener_cursos_materia.php?curso_id=" + id, true);
    xhttp.send();

    selectedCourseId= id;
    selectedCourseNombre= cursoNombre;
  }

  function seleccionarMateria(){
    window.location.href = 'insertarMateria.php?id=' + selectedCourseId + '&nombre=' + selectedCourseNombre;
  }

  function borrarMateria() {
  // Realizar la acción deseada, como redireccionar a una ruta específica
  window.location.href = 'eliminarMateriaCurso.php?id=' + selectedCourseId + '&nombre=' + selectedCourseNombre;
  }


  function estadoMateria() {
  // Realizar la acción deseada, como redireccionar a una ruta específica
  window.location.href = 'estadoMateriaCurso.php?id=' + selectedCourseId + '&nombre=' + selectedCourseNombre;

}

</script>

</body>

</html>
