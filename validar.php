<?php
session_start();
include("conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = trim($_POST["id_usuario"]);
    $contrasena = trim($_POST["clave"]);

    $sql = "SELECT id_usuario, nombre, contrasena, rol FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    
        if (password_verify($contrasena, $usuario["contrasena"])) {
            $_SESSION["usuario"] = $usuario["id_usuario"];
            $_SESSION["rol"] = $usuario["rol"];
    
            // Redirección según rol
            if ($usuario["rol"] === "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: mostrar.php");
            }
            exit();
        } else {
            $error = "Credenciales incorrectas.";
        }
    } else {
        $error = "Credenciales incorrectas.";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error de inicio de sesión - JAK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-container {
            background: #ffffffee;
            padding: 35px 30px;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 420px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #ff7b89;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .error-container {
    background: #ffffff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 420px;
    width: 100%;
    animation: fadeIn 1s ease-in-out;
}

.mensaje-error {
    background-color: #ffe0e6;
    color: #d12f4f;
    padding: 20px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 25px;
    box-shadow: 0 6px 15px rgba(255, 161, 177, 0.3);
    display: flex;
    align-items: center;
    gap: 12px;
}


        .mensaje-error i {
            font-size: 24px;
            color: #d12f4f;
        }

        a.volver {
            text-decoration: none;
            color: white;
            background: linear-gradient(to right, #a86bd1, #fcb6c1);
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s ease;
            box-shadow: 0 6px 15px rgba(248, 140, 190, 0.3);
        }

        a.volver:hover {
            background: linear-gradient(to left, #a86bd1, #fcb6c1);
            transform: translateY(-2px);
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="error-container">
        <h2><i class="fas fa-user-shield"></i> ¡Ups! Algo salió mal</h2>

        <?php if (!empty($error)): ?>
            <div class="mensaje-error">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <a class="volver" href="login.php">← Volver al inicio de sesión</a>
    </div>
</body>
</html>
