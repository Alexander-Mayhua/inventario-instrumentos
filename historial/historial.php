<?php
include '../conexion/conexion.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <style>
        body {
            background-color: #f7f7f7;
        }

        .sidebar {
            height: auto;
            background: #343a40;
            color: rgb(63, 252, 56);
            background-image: url(../img/fondo.jpg);
            background-blend-mode: soft-light;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-color: rgb(50, 50, 50);

            position: fixed;
            height: 100%;
        }

        .sidebar a {
            color: #ffffff;
            font-weight: 700;
        }

        .sidebar a:hover {
            background: #ffffff;
            color: rgb(1, 2, 2);
        }

        .nav-item {
            margin-top: 30px;
        }

        .img {
            border-radius: 50%;
            background-color: black;
        }

        td,
        th {
            border: 1px solid black;
        }

        .title {
            text-align: center;

        }

        .menu {
            width: auto;
            height: 100px;
            background-color: green;
            display: flex;
            justify-content: center;
            background-image: url(../img/fondo.jpg);
            background-blend-mode: soft-light;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-color: rgb(50, 50, 50);
            align-content: end;

            position: fixed;
            width: 100%;
        }

        .menu,
        .texto {
            color: greenyellow;
            padding-top: 20px;
            font-size: 40px;
        }

        .container-fluit {
            margin-left: 230px;
            /* Añade margen izquierdo para que el contenido no quede debajo de la barra lateral */

        }
        .contenido2{
            margin-top: 100px;
        padding: 20px;
        height: auto;
    }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <div class="admin text-center">
                <img src="../img/insignia1.png" class="img mb-4" alt="" width="200">
                <h5>I.E ESMERALDA</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../instrumentos/instrumento.php">Instrumentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../prestamo/prestamo.php">Prestamos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../historial/historial.php">Historial</a>
                </li>
                <li class="nav-item">
                    <strong>
                        <p>Usuario: <?php echo $_SESSION['username']; ?></p>
                    </strong>
                    <a href="../logout.php" class="nav-link">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
        <div class="container-fluit col-lg p-0">
            <div class="menu ">
                <p class="texto">I.E. ESMERALDA DE LOS ANDES</p>
            </div>
            <div class="contenido2">
                <h1 class="title">Historial de Préstamos</h1>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Instrumento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Fecha de Préstamo</th>
                            <th>Fecha de Devolución</th>
                            <th>Tipo de Transacción</th>
                            <th>Estado de Entrega</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("
                SELECT historial_prestamos.*, instrumentos.nombre AS nombreinstrumento
                FROM historial_prestamos
                JOIN instrumentos ON historial_prestamos.instrumento_id = instrumentos.id
            ");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombreinstrumento']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['apellido']}</td>
                        <td>{$row['dni']}</td>
                        <td>{$row['fecha_prestamo']}</td>
                        <td>{$row['fecha_devolucion']}</td>
                        <td>{$row['tipo_transaccion']}</td>
                        <td>{$row['estado_entrega']}</td>
                        <td>{$row['fecha_registro']}</td>
                    </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>