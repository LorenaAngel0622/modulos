<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario - JAK</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="main-wrapper">
        <div class="login-container">
            <div class="brand">JAK</div>
            <h2>Registro de nuevo usuario</h2>
            <form action="procesar.php" method="POST">
                <div class="input-group">
                    <label for="id_usuario">ID de Usuario</label>
                    <input type="text" name="id_usuario" id="id_usuario" required>
                </div>
                <div class="input-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" required>
                </div>
                <div class="input-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" required>
                </div>
                <div class="input-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" required>
                </div>
                <div class="input-group">
                    <label for="rol">Rol</label>
                    <select name="rol" id="rol" required>
                        <option value="">Selecciona un rol</option>
                        <option value="cliente">Cliente</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <input type="submit" value="Registrar">
            </form>
        </div>
    </div>
</body>
</html>
