<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: mostrar.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - JAK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #ffffffee;
            padding: 35px 30px;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #a86bd1;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 600;
        }

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: 500;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 14px;
        }

        input[type="submit"] {
            background: linear-gradient(to right, #a86bd1, #fcb6c1);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 6px 15px rgba(248, 140, 190, 0.3);
        }

        input[type="submit"]:hover {
            background: linear-gradient(to left, #a86bd1, #fcb6c1);
            transform: translateY(-2px);
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            color: #f67280;
            margin-bottom: 15px;
        }
        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px; 
            height: auto;
        }

        /* Para asegurarse de que la imagen del logo esté centrada en la página */
        .main-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="login-container">
            <div class="logo">
                <img src="logo.jak.png" alt="Logo de JAK">
            </div>
            <div class="brand"></div>
            <h2>Iniciar Sesión</h2>
            <form action="validar.php" method="POST">
                <label for="id_usuario">Usuario:</label>
                <input type="text" name="id_usuario" required>

                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" required>

                <input type="submit" value="Ingresar">
            </form>
        </div>
    </div>
</body>
</html>


