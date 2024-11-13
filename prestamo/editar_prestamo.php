<?php
include '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM prestamoinstrumentos WHERE id = $id");
    $prestamo = $result->fetch_assoc();
    $instrumento_anterior = $prestamo['instrumento_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $instrumento_id = $_POST['instrumento_id'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];
    $tipo_transaccion = $_POST['tipo_transaccion'];
    $estado_entrega = $_POST['estado_entrega'];

    // Actualizar el préstamo en la tabla prestamoinstrumentos
    $sql = "UPDATE prestamoinstrumentos 
            SET nombre='$nombre', apellido='$apellido', DNI='$dni', instrumento_id='$instrumento_id', fecha_prestamo='$fecha_prestamo', fecha_devolucion='$fecha_devolucion', tipo_transaccion='$tipo_transaccion', estado_entrega='$estado_entrega' 
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Verificar si se cambió el instrumento
        if ($instrumento_id != $instrumento_anterior) {
            // Marcar el nuevo instrumento como "no disponible"
            $conn->query("UPDATE instrumentos SET disponibilidad = 'no disponible' WHERE id = '$instrumento_id'");

            // Volver a hacer disponible el instrumento anterior si existía
            if ($instrumento_anterior) {
                $conn->query("UPDATE instrumentos SET disponibilidad = 'disponible' WHERE id = '$instrumento_anterior'");
            }
        }

        // Si el tipo de transacción es "Devuelto", actualizar la disponibilidad del instrumento actual a "disponible"
        if ($tipo_transaccion == 'Devuelto') {
            $conn->query("UPDATE instrumentos SET disponibilidad = 'disponible' WHERE id = '$instrumento_id'");
        }

        echo "Préstamo actualizado con éxito";
        header('Location: prestamo.php');
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
    <title>Editar Préstamo</title>
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
        <h1 class="text-center mb-4">Editar Préstamo</h1>
        <form method="post" action="editar_prestamo.php">
            <input type="hidden" id="id" name="id" value="<?php echo $prestamo['id']; ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $prestamo['nombre']; ?>" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $prestamo['apellido']; ?>" required>
            </div>

            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $prestamo['DNI']; ?>" required>
            </div>

            <div class="form-group">
                <label for="instrumento_id">Instrumento:</label>
                <select class="form-control" id="instrumento_id" name="instrumento_id" required>
                    <?php
                    // Mostrar instrumentos disponibles
                    $result = $conn->query("SELECT id, nombre FROM instrumentos");
                    while ($row = $result->fetch_assoc()) {
                        $selected = ($row['id'] == $prestamo['instrumento_id']) ? "selected" : "";
                        echo "<option value='{$row['id']}' $selected>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_prestamo">Fecha de Préstamo:</label>
                <input type="date" class="form-control" id="fecha_prestamo" name="fecha_prestamo" value="<?php echo $prestamo['fecha_prestamo']; ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_devolucion">Fecha de Devolución:</label>
                <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" value="<?php echo $prestamo['fecha_devolucion']; ?>" required>
            </div>

            <div class="form-group">
                <label for="tipo_transaccion">Tipo de transacción</label>
                <select class="form-control" id="tipo_transaccion" name="tipo_transaccion" required>
                    <option value="Prestado" <?php echo ($prestamo['tipo_transaccion'] == 'Prestado') ? 'selected' : ''; ?>>Prestado</option>
                    <option value="Devuelto" <?php echo ($prestamo['tipo_transaccion'] == 'Devuelto') ? 'selected' : ''; ?>>Devuelto</option>
                </select>
            </div>

            <div class="form-group">
                <label for="estado_entrega">Estado de Entrega:</label>
                <select class="form-control" id="estado_entrega" name="estado_entrega" required>
                    <option value="" disabled>--Seleccione--</option>
                    <option value="Bueno" <?php echo ($prestamo['estado_entrega'] == 'Bueno') ? 'selected' : ''; ?>>Bueno</option>
                    <option value="Dañado" <?php echo ($prestamo['estado_entrega'] == 'Dañado') ? 'selected' : ''; ?>>Dañado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Actualizar Préstamo</button>
            <a href="prestamo.php" class="btn btn-secondary btn-block">Cancelar</a>
        </form>
    </div>
</body>

</html>