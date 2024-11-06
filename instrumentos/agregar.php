<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $fecha_donacion = $_POST['fecha_donacion'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];


    $sql = "INSERT INTO instrumentos (codigo,nombre,marca,modelo,Color,fecha_donacion,estado,precio) VALUES ('$codigo','$nombre','$marca','$modelo','$color','$fecha_donacion','$estado','$precio')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo instrumento agregado con éxito";
        header("Location: instrumento.php");
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
    <title>Sistema</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Estilos generales del formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);

        }

        h1 {
            text-align: center;
            color: #333333;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .cancelar {
            background-color: #d9534f;
            margin-left: 10px;
        }

        .cancelar:hover {
            background-color: #c9302c;
        }

        .button-container {
            text-align: right;
        }

        .container h1 {
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="container ">
        <h1 class=" row my-4 ">Registrar Instrumentos</h1>
        <form method="post" action="../instrumentos/agregar.php" class="bg-light p-4 border rounded">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" id="codigo" name="codigo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" id="color" name="color" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_donacion">Fecha de Donación:</label>
                <input type="date" id="fecha_donacion" name="fecha_donacion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="Bueno">Bueno</option>
                    <option value="Dañado">Dañado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Agregar Instrumentos</button>
            <a href="instrumento.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
    </div>
</body>

</html>