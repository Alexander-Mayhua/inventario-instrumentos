<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $instrumento_id = $_POST['instrumento_id'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];
    $tipo_transaccion = $_POST['tipo_transaccion'];
    $estado_entrega = $_POST['estado_entrega'];

    $sql = "INSERT INTO prestamoinstrumentos (nombre, apellido, DNI, instrumento_id, fecha_prestamo, fecha_devolucion, tipo_transaccion, estado_entrega) 
            VALUES ('$nombre', '$apellido', '$dni', '$instrumento_id', '$fecha_prestamo', '$fecha_devolucion', '$tipo_transaccion', '$estado_entrega')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo préstamo agregado con éxito";
        header("Location: prestamo.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Préstamos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: green;
            border-color: green;
        }
        .btn-primary:hover {
            background-color: darkgreen;
            border-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Registrar Préstamo de Instrumento</h1>
        <form method="post" action="agregar_prestamo.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>

            <div class="form-group">
                <label for="instrumento_id">Instrumento:</label>
                <select class="form-control" id="instrumento_id" name="instrumento_id" required>
                    <?php
                    // Mostrar instrumentos disponibles
                    $result = $conn->query("SELECT id, nombre FROM instrumentos");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_prestamo">Fecha de Préstamo:</label>
                <input type="date" class="form-control" id="fecha_prestamo" name="fecha_prestamo" required>
            </div>

            <div class="form-group">
                <label for="fecha_devolucion">Fecha de Devolución:</label>
                <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" >
            </div>

            <div class="form-group">
                <label for="tipo_transaccion">Tipo de Transacción:</label>
                <select class="form-control" id="tipo_transaccion" name="tipo_transaccion" >
                <option selected>--Selecione--</option>
                    <option value="Prestado">Prestado</option>
                    <option value="Devuelto">Devuelto</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estado_entrega">Estado de Entrega:</label>
                <select class="form-control" id="estado_entrega" name="estado_entrega" required>
                <option selected>--Selecione--</option>
                <option value="Bueno">Bueno</option>
                <option value="Dañado">Dañado</option>
            </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Agregar Préstamo</button>
            <a href="prestamo.php" class="btn btn-secondary btn-block">Cancelar</a>
        </form>
    </div>
</body>
</html>
