<?php
session_start();
include 'conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: greenyellow;
        }

        #contenedor {
            background-color: white;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 40px;
            max-width: 900px;
            width: 100%;
        }

        .imagen-login img {
            width: 100%;
            height: 400px;
            border-radius: 10px;
        }

        .login h1 {
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .usuario {
            display: block;
            margin: 0 auto 20px;
        }

        .form-control {
            padding: 10px;
            font-size: 1rem;
        }

        .btn {
            font-size: 1rem;
            padding: 10px;
            margin-top: 20px;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="contenedor" class="container-fluid">
        <div class="row">
            <!-- Sección de imagen -->
            <div class="imagen-login col-md-6 d-none d-md-block">
                <img src="./img/portada.jpg" alt="Imagen de portada">
            </div>

            <!-- Sección del formulario de login -->
            <div class="login col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <form method="POST" action="login.php" class="w-100 px-4">
                    <h1>Iniciar Sesión</h1>

                    <div class="text-center mb-4">
                        <img class="usuario" src="img/usuario.png" alt="Icono de usuario" width="100px">
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="text" id="username" name="username" placeholder="NOMBRE USUARIO" required>
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="password" id="password" name="password" placeholder="CONTRASEÑA" required>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">INGRESAR</button>
                    <?php if (isset($error)) {
                        echo "<p class='error'>$error</p>";
                    } ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>