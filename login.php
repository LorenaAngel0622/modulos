<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: mostrar.php'); // Redirigir si el usuario ya está autenticado
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
    <!-- Estilo separado -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Barra de navegación -->
<div class="navbar">
    <div>
        <img src="jak.png" alt="Logo JAK">
    </div>
    <nav>
        <a href="login.php">Inicio</a>
        <a href="registro.php">Registro</a>
        <a href="mostrar.php">Listar</a>
        <a href="buscar.php">Buscar</a>
    </nav>
</div>

    <!-- Formulario de inicio de sesión -->
    <div class="main-wrapper">
        <div class="login-container">
            <div class="logo">
                <img src="jak.png" alt="Logo de JAK">
            </div>
                        <div class="brand"></div>
            <h2>Iniciar Sesión</h2>
            <form action="validar.php" method="POST">
                <label for="id_usuario">Usuario:</label>
                <input type="text" name="id_usuario" id="id_usuario" required>

                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave" required>

                <input type="submit" value="Ingresar">
            </form>

            <div class="extra-links">
                ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a><br>
                <a href="recuperar_contrasena.php">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
</body>
</html>
//                 <option value="administrador">Administrador</option>
//                     </select>    



