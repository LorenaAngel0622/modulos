<?php
include("conexion.php");

if (isset($_GET["token"])) {
    $token = $_GET["token"];
    $sql = "SELECT * FROM usuarios WHERE token_recuperacion = ? AND expira_token > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        die("Token inválido o expirado");
    }
} else {
    die("Token no proporcionado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Restablecer tu contraseña</h2>
    <form method="post" action="procesar_reset.php">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <div class="form-group">
            <label>Nueva contraseña:</label>
            <input type="password" name="nueva_contrasena" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
    </form>
</div>
</body>
</html>
