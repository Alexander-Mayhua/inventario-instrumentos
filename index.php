<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "practica");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar el número de instrumentos
$sql = "SELECT COUNT(*) AS total_instrumentos FROM instrumentos";
$resultado_instrumentos = $conexion->query($sql);
$fila_instrumentos = $resultado_instrumentos->fetch_assoc();
$total_instrumentos = $fila_instrumentos['total_instrumentos'];

// Cerrar la conexión
$conexion->close();
?>


<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "practica");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar el número de instrumentos
$sql = "SELECT COUNT(*) AS total_prestamos FROM prestamoinstrumentos";
$resultado_prestamos = $conexion->query($sql);
$fila_prestamos = $resultado_prestamos->fetch_assoc();
$total_prestamos = $fila_prestamos['total_prestamos'];

// Cerrar la conexión
$conexion->close();
?>

<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "practica");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar el número de instrumentos
$sql = "SELECT COUNT(*) AS total_historial FROM historial_prestamos";
$resultado_historial = $conexion->query($sql);
$fila_historial = $resultado_historial->fetch_assoc();
$total_historial = $fila_historial['total_historial'];

// Cerrar la conexión
$conexion->close();
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="./css/stylee.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f7f7f7;
        }

        .sidebar {
            height: auto;
            background: #343a40;
            color: rgb(63, 252, 56);
            background-image: url(img/fondo.jpg);
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



        /*estilo de dashboard ------------------------*/
        .dashboard-card {
            border: none;
            /* Eliminamos el borde para un diseño más limpio */
            width: 200px;
            /* Ampliamos el ancho para más contenido */
            height: 200px;
            /* Aumentamos la altura para una mejor proporción */
            margin: 50px;
            /* Menor margen para mejor distribución */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            /* Sombra más suave y sutil */
            border-radius: 15px;
            /* Redondeo suave en los bordes */
            background-color: #f9f5eb;
            /* Color suave y limpio, similar a un blanco hueso */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Efectos animados al interactuar */
            overflow: hidden;
            
            

        }

        .dashboard-card:hover {
            transform: translateY(-10px);
            /* Desplazamiento hacia arriba en hover */
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
            /* Sombra más intensa al hacer hover */

        }

        .dashboard-card:hover::before {
            opacity: 1;
            /* Aparece una superposición de brillo en hover */
            background-color: red;
        }

        .dashboard-card:hover {
            background-color: blue;
        }

        .card-info {

            flex-direction: column;
            text-align: center;
            padding: 15px;
            justify-content: center;
            /* Alineación centrada verticalmente */
            align-content: center;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            /* Fondo semitransparente */
        }

        .card-info h3 {
            margin: 0;
            font-size: 22px;
            color: #333;
            /* Color oscuro para mejor contraste */
            letter-spacing: 1px;
            /* Espaciado para un toque más moderno */
        }

        .card-info p {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            /* Texto más suave en gris */
            line-height: 1.6;
            /* Mejor espaciado en el texto */
        }

        .card-info .icon {
            font-size: 40px;
            color: #ff7f50;
            /* Un color llamativo para los íconos */
            margin-bottom: 10px;
            /* Espaciado entre el ícono y el texto */
        }

        .dash {
            display: flex;
        }


        .menu {
            width: auto;
            height: 100px;
            background-color: green;
            display: flex;
            justify-content: center;
            background-image: url(./img/fondo.jpg);
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
            margin-left: 220px;
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
                <img src="./img/insignia1.png" class="img mb-4" alt="" width="200">
                <h5>I.E ESMERALDA</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./instrumentos/instrumento.php">Instrumentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./prestamo/prestamo.php">Prestamos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./historial/historial.php">Historial</a>
                </li>
                <li class="nav-item">
                    <strong>
                        <p>Usuario: <?php echo $_SESSION['username']; ?></p>
                    </strong>
                    <a href="logout.php" class="nav-link">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
        <div class="container-fluit col-lg p-0">
            <div class="menu ">
                <p class="texto">SISTEMA DE INVENTARIO</p>
            </div>
           <div class="contenido2">
            <div class="dash">

                <div class="dashboard-card">
                    <div class="card-info">
                        <img src="./img/icono-instrumento.png" alt="" width="50">
                        <h3 id="instrumentos-count"><?php echo $total_instrumentos; ?></h3>
                        <p><strong>Instrumentos</strong></p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-info">
                        <img src="./img/icono-prestamo.png" alt="" width="50">
                        <h3 id="instrumentos-count"><?php echo $total_prestamos; ?></h3>
                        <p><strong>Prestamos</strong></p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-info">
                        <img src="./img/icono-historial.png" alt="" width="50">
                        <h3 id="instrumentos-count"><?php echo $total_historial; ?></h3>
                        <p><strong>historial</strong></p>
                    </div>
                </div>
            </div>
            <div class="paleta">
                <div class="panel active" style="background-image: url('https://images.unsplash.com/photo-1558979158-65a1eaa08691?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80')">
                    <h3>Explore The World</h3>
                </div>
                <div class="panel" style="background-image: url('https://images.unsplash.com/photo-1572276596237-5db2c3e16c5d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80')">
                    <h3>Wild Forest</h3>
                </div>
                <div class="panel" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1353&q=80')">
                    <h3>Sunny Beach</h3>
                </div>
                <div class="panel" style="background-image: url('https://images.unsplash.com/photo-1551009175-8a68da93d5f9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80')">
                    <h3>City on Winter</h3>
                </div>
                <div class="panel" style="background-image: url('https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80')">
                    <h3>Mountains - Clouds</h3>
                </div>

            </div>
            </div>

            <script src="./js/script.js"></script>
        </div>
    </div>