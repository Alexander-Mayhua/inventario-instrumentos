<?php
include '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primero, obtenemos los detalles del préstamo
    $result = $conn->query("SELECT * FROM prestamoinstrumentos WHERE id = $id");
    $prestamo = $result->fetch_assoc();

    // Insertar el préstamo en el historial
    $sql_historial = "INSERT INTO historial_prestamos (instrumento_id, nombre, apellido, dni, fecha_prestamo, fecha_devolucion, tipo_transaccion, estado_entrega) VALUES (
        '{$prestamo['instrumento_id']}',
        '{$prestamo['nombre']}',
        '{$prestamo['apellido']}',
        '{$prestamo['DNI']}',
        '{$prestamo['fecha_prestamo']}',
        '{$prestamo['fecha_devolucion']}',
        '{$prestamo['tipo_transaccion']}',
        '{$prestamo['estado_entrega']}'
    )";

    if ($conn->query($sql_historial) === TRUE) {
        // Ahora que el préstamo ha sido transferido al historial, lo eliminamos de la tabla original
        $sql_delete = "DELETE FROM prestamoinstrumentos WHERE id = $id";

        if ($conn->query($sql_delete) === TRUE) {
            echo "Préstamo eliminado y registrado en el historial con éxito";
            header('Location: prestamo.php');
        } else {
            echo "Error al eliminar el préstamo: " . $conn->error;
        }
    } else {
        echo "Error al registrar en el historial: " . $conn->error;
    }
}
?>
