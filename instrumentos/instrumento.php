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
            padding: 10px;
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
    <!-- Botón para mostrar/ocultar sidebar en móviles -->
    <button id="sidebarToggle" class="btn btn-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>

    <!-- Sidebar -->
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

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="menu">
            <p class="texto">I.E. ESMERALDA DE LOS ANDES</p>
        </div>
        
        <div class="contenido2">
            <div class="mb-4">
                <a href="../index.php" class="btn btn-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                </a>
            </div>

            <h1 class="text-center mb-4">Instrumentos</h1>
            <div class="mb-3">
                <a href="./agregar.php" class="btn btn-success">Agregar Instrumento</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-success text-white">ID</th>
                            <th scope="col" class="bg-success text-white">CODIGO</th>
                            <th scope="col" class="bg-success text-white">NOMBRE</th>
                            <th scope="col" class="bg-success text-white">MARCA</th>
                            <th scope="col" class="bg-success text-white">MODELO</th>
                            <th scope="col" class="bg-success text-white">COLOR</th>
                            <th scope="col" class="bg-success text-white">FECHA DONACIÓN</th>
                            <th scope="col" class="bg-success text-white">ESTADO</th>
                            <th scope="col" class="bg-success text-white">PRECIO</th>
                            <th scope="col" class="bg-success text-white">ACCIONES</th>
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
                                    <div class='action-buttons'>
                                        <a href='editar_instrumento.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                        <a href='eliminar.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este instrumento?');\">Eliminar</a>
                                    </div>
                                </td>
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
        // Toggle sidebar en dispositivos móviles
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>