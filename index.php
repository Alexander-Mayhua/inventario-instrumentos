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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
        body {
            background-color: #f7f7f7;
            overflow-x: hidden;
        }

        .sidebar {
            background: #343a40;
            color: rgb(63, 252, 56);
            background-image: url(./img/fondo.jpg);
            background-blend-mode: soft-light;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-color: rgb(50, 50, 50);
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            transition: all 0.3s;
        }
        .sidebar a {
            color: #ffffff;
            font-weight: 700;
            padding: 10px;
            display: block;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #ffffff;
            color: rgb(1, 2, 2);
            border-radius: 5px;
        }
        
        .texto {
            color: greenyellow;
            font-size: 40px;
            margin: 0;
            text-align: center;
        }
        .img {
            border-radius: 50%;
            background-color: black;
            max-width: 100%;
            height: auto;
        }

        .img-profile {
            border-radius: 50%;
            width: 150px;
            height: auto;
            margin: 20px auto;
        }

        .header {
            background-image: url(./img/fondo.jpg);
            background-blend-mode: soft-light;
            background-position: center;
            background-size: cover;
            background-color: rgb(50, 50, 50);
            padding: 20px;
            color: greenyellow;
        }

        .dashboard-card {
            background-color: #f9f5eb;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
            background-color: #e3f2fd;
        }

        .card-info {
            padding: 20px;
            text-align: center;
        }

        .card-info img {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
        }

        .panel-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .panel {
            flex: 1;
            min-width: 200px;
            height: 200px;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .panel h3 {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }

            .content-wrapper {
                margin-left: 0;
            }

            .dashboard-cards {
                flex-direction: column;
            }

            .panel {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-lg-2 col-md-3 sidebar p-3">
        <div class="text-center mb-4">
            <img src="./img/insignia1.png" class="img mb-3" alt="" style="max-width: 150px">
            <h5>I.E ESMERALDA</h5>
        </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link mb-3" href="">Inicio</a></li>
                <li class="nav-item"><a class="nav-link mb-3" href="./instrumentos/instrumento.php">Instrumentos</a></li>
                <li class="nav-item"><a class="nav-link mb-3" href="./prestamo/prestamo.php">Prestamos</a></li>
                <li class="nav-item"><a class="nav-link mb-3" href="./historial/historial.php">Historial</a></li>
                <li class="nav-item">
                    <strong><p class="px-3 text-white">Usuario: <?php echo $_SESSION['username']; ?></p></strong>
                    <a href="logout.php" class="nav-link">Cerrar Sesión</a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class=" main-content col-lg-10 col-md-9">
            <!-- Header -->
            <div class="header text-center mb-4">
                <h1>SISTEMA DE INVENTARIO</h1>
            </div>

            <!-- Dashboard Cards -->
            <div class="container">
                <div class="row justify-content-center g-4">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="dashboard-card">
                            <div class="card-info">
                                <img src="./img/icono-instrumento.png" alt="Instrumentos">
                                <h3><?php echo $total_instrumentos; ?></h3>
                                <p><strong>Instrumentos</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="dashboard-card">
                            <div class="card-info">
                                <img src="./img/icono-prestamo.png" alt="Prestamos">
                                <h3><?php echo $total_prestamos; ?></h3>
                                <p><strong>Prestamos</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="dashboard-card">
                            <div class="card-info">
                                <img src="./img/icono-historial.png" alt="Historial">
                                <h3><?php echo $total_historial; ?></h3>
                                <p><strong>Historial</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panels -->
                <div class="panel-container mt-4">
                    <div class="panel" style="background-image: url('https://images.unsplash.com/photo-1558979158-65a1eaa08691?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80')">
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>