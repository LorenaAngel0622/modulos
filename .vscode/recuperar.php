<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["email"];
    $token = bin2hex(random_bytes(50));
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Guardar token en la BD
        $sql_update = "UPDATE usuarios SET token_recuperacion = ?, expira_token = ? WHERE correo = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sss", $token, $expira, $correo);
        $stmt_update->execute();

        // Enviar correo (simulado en este ejemplo con echo)
        $enlace = "http://localhost/resetearcontrasena.php?token=" . $token;
        echo "<div class='alert alert-success'>Te hemos enviado un enlace para recuperar tu contraseña: <a href='$enlace'>$enlace</a></div>";

        // En producción, usar mail() o una librería como PHPMailer
    } else {
        echo "<div class='alert alert-danger'>Correo no registrado.</div>";
    }
}
?>
