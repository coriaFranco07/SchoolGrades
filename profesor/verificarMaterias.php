<?php

$conn = mysqli_connect("localhost", "root", "", "gestion_calificaciones");

if ($conn) {
    $idProfesor = $_GET['idProfesor'];
    $idCurso = $_GET['idCurso'];

    $sql = "SELECT COUNT(*) AS count
            FROM curso_materia cm
            INNER JOIN profe_materia pm ON cm.id_materia = pm.id_materia
            WHERE pm.id_profesor = '$idProfesor' AND cm.id_curso = '$idCurso'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            // Las materias coinciden, devolver una respuesta exitosa
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            // Las materias no coinciden, devolver un mensaje de error
            $response = array('success' => false, 'message' => 'Las materias no coinciden');
            echo json_encode($response);
        }
    } else {
        // Error en la consulta
        $response = array('success' => false, 'message' => 'Error en la consulta: ' . mysqli_error($conn));
        echo json_encode($response);
    }
} else {
    // Error de conexión
    $response = array('success' => false, 'message' => 'Error de conexión: ' . mysqli_connect_error());
    echo json_encode($response);
}
