<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include '../conexion/conexion.php'; ?>

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
            width: 232px;
            ;

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

        .btn1 {
            background-color: yellow;
        }

        .btn2 {
            background-color: red;
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

        .container-fluit {
            margin-left: 220px;
            /* Añade margen izquierdo para que el contenido no quede debajo de la barra lateral */
            height: auto;

        }

        .menu,
        .texto {
            color: greenyellow;
            padding-top: 20px;
            font-size: 40px;
        }

        .contenido2 {
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
                <li class="row nav-item">
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

                <div class="Atras"><a href="../index.php"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg></a></div>
                <h1 class="title">Instrumentos</h1>
                <a href="./agregar.php" class="btn btn-success mb-3">Agregar Instrumento</a>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="background-color: green; color:white">ID</th>
                            <th scope="col" style="background-color: green; color:white">CODIGO</th>
                            <th scope="col" style="background-color: green; color:white">NOMBRE</th>
                            <th scope="col" style="background-color: green; color:white">MARCA</th>
                            <th scope="col" style="background-color: green; color:white">MODELO</th>
                            <th scope="col" style="background-color: green; color:white">COLOR</th>
                            <th scope="col" style="background-color: green; color:white">FECHA DONACIÓN</th>
                            <th scope="col" style="background-color: green; color:white">ESTADO</th>
                            <th scope="col" style="background-color: green; color:white">PRECIO</th>
                            <th scope="col" style="background-color: green; color:white">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM instrumentos");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['codigo']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['marca']}</td>
                        <td>{$row['modelo']}</td>
                        <td>{$row['Color']}</td>
                        <td>{$row['fecha_donacion']}</td>
                        <td>{$row['estado']}</td>
                        <td>{$row['precio']}</td>
                        <td>
                            <a href='editar_instrumento.php?id={$row['id']}' class='btn btn-warning'>Editar</a>
                            <a href='eliminar.php?id={$row['id']}' class='btn btn-danger' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este instrumento?');\">Eliminar</a>
                        </td>
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