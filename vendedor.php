<?php
session_start();

// Verificación de rol
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: login.php?error=No tienes permisos para acceder a esta página");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - JAK</title>
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
            color: #ff4d6d;
            font-size: 32px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #6D6875;
        }

        .btn-volver {
            background: linear-gradient(to right, #a86bd1, #fcb6c1);
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            border-radius: 30px;
            margin-top: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(248, 140, 190, 0.3);
        }

        .btn-volver:hover {
            background: linear-gradient(to left, #a86bd1, #fcb6c1);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">JAK | Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="mostrar.php" aria-label="Ver lista de usuarios">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" aria-label="Cerrar sesión">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container">
        <h1>¡Bienvenid@!</h1>
        <p>Estás en el panel de control. Desde aquí puedes gestionar los usuarios registrados y realizar otras acciones administrativas.</p>
        <a href="mostrar.php" class="btn-volver">Ver lista de usuarios</a>
    </div>

</body>
</html>
