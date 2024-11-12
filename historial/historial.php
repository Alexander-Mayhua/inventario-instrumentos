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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
          body {
            background-color: #f7f7f7;
            overflow-x: hidden;
        }

        .sidebar {
            background: #343a40;
            color: rgb(63, 252, 56);
            background-image: url(../img/fondo.jpg);
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

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .menu {
                width: 100% !important;
            }
            
            .texto {
                font-size: 24px !important;
            }
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

        .img {
            border-radius: 50%;
            background-color: black;
            max-width: 100%;
            height: auto;
        }

        .menu {
            background-color: green;
            background-image: url(../img/fondo.jpg);
            background-blend-mode: soft-light;
            background-size: cover;
            background-color: rgb(50, 50, 50);
            padding: 20px 0;
            position: fixed;
            width: calc(100% - 250px);
            z-index: 999;
        }

        .texto {
            color: greenyellow;
            font-size: 40px;
            margin: 0;
            text-align: center;
        }

        .contenido2 {
            margin-top: 0px;
            padding: 20px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        @media (max-width: 576px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons .btn {
                width: 100%;
                margin-bottom: 5px;
            }
        }

        #sidebarToggle {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1001;
        }

        @media (max-width: 768px) {
            #sidebarToggle {
                display: block;
            }
        }
    </style>
</head>

<body>
    <button id="sidebarToggle" class="btn btn-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>

    <div class="sidebar p-3">
        <div class="text-center mb-4">
            <img src="../img/insignia1.png" class="img mb-3" alt="" style="max-width: 150px">
            <h5>I.E ESMERALDA</h5>
        </div>
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link" href="../instrumentos/instrumento.php">Instrumentos</a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link" href="../prestamo/prestamo.php">Prestamos</a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link" href="../historial/historial.php">Historial</a>
                </li>
                <li class="nav-item">
                    <strong>
                        <p class="text-white">Usuario: <?php echo $_SESSION['username']; ?></p>
                    </strong>
                    <a href="../logout.php" class="nav-link">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <div class="menu">
            <p class="texto">I.E. ESMERALDA DE LOS ANDES</p>
        </div>
        
        <div class="contenido2">
            <h1 class="text-center mb-4">Historial de Préstamos</h1>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-success">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>