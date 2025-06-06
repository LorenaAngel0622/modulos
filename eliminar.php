<?php
include("conexion.php");

// Iniciar sesión para verificar el token CSRF
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificación inicial
$id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;

if (!$id_usuario) {
    echo "No se ha proporcionado un ID de usuario.";
    exit();
}

// Generar token CSRF si no existe uno
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Procesar la solicitud de eliminación
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_usuario'])) {
    // Verificación del token CSRF
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Error de validación CSRF.');
    }

    $id = $_POST['id_usuario'];

    // Preparar la consulta SQL para eliminar al usuario
    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    // Ejecutar la consulta y verificar si fue exitosa
    if ($stmt->execute()) {
        header("Location: mostrar.php?mensaje=Usuario eliminado exitosamente");
        exit();
    } else {
        $error = "Error al eliminar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Usuario</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="login-container">
    <div class="brand">JAK</div>

    <?php if ($id_usuario): ?>
        <h2>¿Estás segura de eliminar este usuario?</h2>
        <form method="POST">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id_usuario) ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="submit" value="Sí, eliminar usuario">
        </form>
        <div class="volver-registro">
            <a href="mostrar.php">← Cancelar</a>
        </div>
    <?php else: ?>
        <h2>ID de usuario no proporcionado.</h2>
        <div class="volver-registro">
            <a href="mostrar.php">← Volver</a>
        </div>
    <?php endif; ?>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>
