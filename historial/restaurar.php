<?php
include '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener el registro específico del historial
    $result = $conn->query("SELECT * FROM historial_prestamos WHERE id = $id");
    $historial = $result->fetch_assoc();

    // Insertar el registro de vuelta en la tabla de préstamos
    $sql_insert = "INSERT INTO prestamoinstrumentos (instrumento_id, nombre, apellido, dni, fecha_prestamo, fecha_devolucion, tipo_transaccion, estado_entrega) VALUES (
        '{$historial['instrumento_id']}',
        '{$historial['nombre']}',
        '{$historial['apellido']}',
        '{$historial['dni']}',
        '{$historial['fecha_prestamo']}',
        '{$historial['fecha_devolucion']}',
        '{$historial['tipo_transaccion']}',
        '{$historial['estado_entrega']}'
    )";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Préstamo restaurado con éxito";

        // (Opcional) Elimina el registro del historial tras restaurarlo
        $conn->query("DELETE FROM historial_prestamos WHERE id = $id");
        
        // Redirige de vuelta al historial
        header('Location: historial.php');
    } else {
        echo "Error al restaurar el préstamo: " . $conn->error;
    }
}
?>
