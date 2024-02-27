<?php
// Obtener el ID del curso enviado desde la solicitud AJAX
$curso_id = $_GET['curso_id'];

// Realizar la consulta a la base de datos para obtener los cursos relacionados con el curso seleccionado
$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");
$sql = "SELECT p.id_cm, e.tipo AS curso, s.tipo AS materia, x.tipo AS estado
        FROM curso_materia p
        JOIN curso e ON p.id_curso = e.id_curso
        JOIN materia s ON p.id_materia = s.id_materia
        JOIN estado x ON p.id_estado = x.id_estado
        WHERE p.id_curso = '$curso_id'";
$result = mysqli_query($conn, $sql);

// Crear un array para almacenar los resultados de la consulta
$cursosMateria = array();

// Recorrer los resultados y agregarlos al array
while ($row = mysqli_fetch_assoc($result)) {
    $cursoMateria = array(
        'id_cm' => $row['id_cm'],
        'curso' => $row['curso'],
        'materia' => $row['materia'],
        'estado' => $row['estado']
    );
    $cursosMateria[] = $cursoMateria;
}

// Convertir el array a formato JSON
$jsonResponse = json_encode($cursosMateria);

// Enviar la respuesta JSON al cliente
header('Content-Type: application/json');
echo $jsonResponse;
?>
