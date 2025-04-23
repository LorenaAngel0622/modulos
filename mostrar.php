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
  <style>
    /* Aquí va tu CSS como lo tienes */
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Lista de Usuarios Registrados</h2>

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
                        <a href='editar.php?id=" . urlencode($fila["id_usuario"]) . "' class='editar-btn'>Editar</a>
                        <form action='eliminar.php' method='POST' onsubmit=\"return confirm('¿Estás segura de eliminar este usuario?');\">
                          <input type='hidden' name='id_usuario' value='" . htmlspecialchars($fila["id_usuario"]) . "'>
                          <button type='submit' class='eliminar-btn'>Eliminar</button>
                        </form>
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
