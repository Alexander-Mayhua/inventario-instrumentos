<?php
include '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM instrumentos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Instrumento eliminado con éxito";
        header('Location: instrumento.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
