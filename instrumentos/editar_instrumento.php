<?php
include '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM instrumentos WHERE id = $id");
    $instrumentos = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $fecha_donacion = $_POST['fecha_donacion'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];



    $sql = "UPDATE instrumentos SET codigo='$codigo', nombre='$nombre', marca='$marca', modelo='$modelo',color='$color', fecha_donacion='$fecha_donacion', estado='$estado', precio='$precio'where id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "instrumento actualizado con éxito";
        header('Location: instrumento.php');
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
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
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

        label,
        select,
        option {
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

        select {
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Cliente</h1>
        <form method="post" action="editar_instrumento.php">
            <input type="hidden" id="id" name="id" value="<?php echo $instrumentos['id']; ?>">

            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $instrumentos['codigo']; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $instrumentos['nombre']; ?>">

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" value="<?php echo $instrumentos['marca']; ?>">

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?php echo $instrumentos['modelo']; ?>">

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="<?php echo $instrumentos['Color']; ?>">

            <label for="fecha_donacion">Fecha de Donación:</label>
            <input type="date" id="fecha_donacion" name="fecha_donacion" value="<?php echo $instrumentos['fecha_donacion']; ?>">

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="Bueno">Bueno</option>
                <option value="Dañado">Dañado</option>
                <?php echo $instrumentos['estado']; ?>"
            </select>


            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $instrumentos['precio']; ?>">

            <div class="button-container">
                <button type="submit">Actualizar Instrumento</button>
                <a href="instrumento.php"><button class="cancelar" type="button">Cancelar</button></a>
            </div>
        </form>
    </div>
</body>

</html>