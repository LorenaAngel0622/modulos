<?php
session_start();

// Verificación de rol
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "cliente") {
    header("Location: login.php?error=Acceso no autorizado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido Cliente - JAK</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(to right, #fbc2eb, #a6c1ee);
            margin: 0;
            padding-top: 80px;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand,
        .nav-link {
            color: #6D6875 !important;
            font-weight: 600;
        }

        .nav-link:hover {
            color: #ff6f91 !important;
        }

        .container {
            text-align: center;
            margin-top: 60px;
        }

        h1 {
            color: #6a4c93;
            font-size: 32px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #6D6875;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">JAK | Cliente</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido -->
<div class="container">
    <h1>¡Hola, <?php echo htmlspecialchars($_SESSION["usuario"]); ?>!</h1>
    <p>Gracias por ser parte de nuestra tienda en línea. Aquí encontrarás las mejores ofertas.</p>
</div>

</body>
</html>
