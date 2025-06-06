<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario - JAK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Referencia al archivo de estilos externo -->
    <link rel="stylesheet" href="styles.css">
    <script>
        // Validación adicional en el lado del cliente (JavaScript)
        function validarFormulario() {
            var telefono = document.getElementById("telefono").value;
            var id_usuario = document.getElementById("id_usuario").value;

            // Validación del teléfono (solo números)
            if (!/^[0-9]{10}$/.test(telefono)) {
                alert("El teléfono debe tener 10 dígitos.");
                return false;
            }

            // Validación del ID de usuario (solo números)
            if (!/^[0-9]+$/.test(id_usuario)) {
                alert("El ID de usuario debe ser numérico.");
                return false;
            }

            return true;
        }
    </script>
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

    <!-- Formulario de registro -->
    <div class="main-wrapper">
        <div class="login-container">
            <div class="brand">JAK</div>
            <h2>Registro de nuevo usuario</h2>
            <form action="procesar.php" method="POST" onsubmit="return validarFormulario()">
                <div class="input-group">
                    <label for="id_usuario">ID de Usuario</label>
                    <input type="number" name="id_usuario" id="id_usuario" required>
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
                    <input type="number" name="telefono" id="telefono" required>
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
