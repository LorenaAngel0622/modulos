<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $nueva = password_hash($_POST["nueva_contrasena"], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usuarios WHERE token_recuperacion = ? AND expira_token > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de restablecimiento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">

<?php
if (isset($resultado) && $resultado->num_rows === 1) {
    $sql_update = "UPDATE usuarios SET contrasena = ?, token_recuperacion = NULL, expira_token = NULL WHERE token_recuperacion = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ss", $nueva, $token);
    $stmt_update->execute();

    echo "<div class='alert alert-success'>¡Contraseña actualizada correctamente! <a href='login.php' class='btn btn-sm btn-success ml-3'>Iniciar sesión</a></div>";
} else {
    echo "<div class='alert alert-danger'>Token inválido o expirado. <a href='recuperar.php' class='btn btn-sm btn-danger ml-3'>Intentar de nuevo</a></div>";
}
?>

</div>
</body>
</html>
<?php
$stmt->close();
