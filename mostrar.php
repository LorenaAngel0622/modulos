<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios Registrados - JAK</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css"> <!-- Enlace a tu archivo de estilos CSS -->
</head>
<body>
  <div class="login-container">
    <h2>Lista de Usuarios Registrados</h2>

    <?php
    // Mostrar mensaje de éxito/error al eliminar
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo "<p class='message success'>Usuario eliminado con éxito.</p>";
        } elseif ($_GET['status'] == 'error') {
            echo "<p class='message error'>Error al eliminar el usuario.</p>";
        }
    }
    ?>

    <table class="Tabla-registros">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Rol</th>
          <th>Fecha de Registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include("conexion.php");

        // Consulta para obtener los usuarios
        $consulta = "SELECT id_usuario, nombre, email, direccion, telefono, rol, fecha_registro FROM usuarios";
        $resultados = $conn->query($consulta);

        if ($resultados && $resultados->num_rows > 0) {
            while ($fila = $resultados->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["direccion"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["rol"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["fecha_registro"]) . "</td>";
                echo "<td>
                      <div class='acciones-container'>
                      <a href='editar.php?id=" . urlencode($fila["id_usuario"]) . "' class='editar-btn'>Editar</a>
                      <form action='eliminar.php' method='POST' onsubmit=\"return confirm('¿Estás segura de eliminar este usuario?');\" class='form-eliminar'>
                      <input type='hidden' name='id_usuario' value='" . htmlspecialchars($fila["id_usuario"]) . "'>
                      <button type='submit' class='eliminar-btn'>Eliminar</button>
            </form>
        </div>
      </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='no-registros'>No hay registros</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
    <div class="volver-registro">
      <a href="index.html" class="boton-registro">
        <i class="fas fa-arrow-left"></i> Volver al registro
      </a>
      <a href="logout.php" class="boton-logout">
        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
      </a>
    </div>
  </div>
</body>
</html>
