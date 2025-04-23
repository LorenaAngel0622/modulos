<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }

    $stmt->close();
}

// Procesar formulario de edición
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $rol = $_POST["rol"];

    $sql = "UPDATE usuarios SET nombre=?, email=?, direccion=?, telefono=?, rol=? WHERE id_usuario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $email, $direccion, $telefono, $rol, $id);

    if ($stmt->execute()) {
        header("Location: mostrar.php");
        exit();
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Formulario HTML para editar -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #ff7eb3, #ff758c, #ff7eb3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 45px 35px;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            width: 360px;
            animation: fadeIn 0.8s ease-in-out;
            text-align: center;
            margin-top: 50px; /* Espaciado desde la parte superior */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container h2 {
            color: #ff758c;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #6D6875;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #ffb6c1;
            border-radius: 10px;
            font-size: 15px;
            background-color: #fff;
            color: #333;
        }

        input[type="submit"] {
            background: linear-gradient(90deg, #ff758c, #ff7eb3);
            color: white;
            font-size: 16px;
            border: none;
            padding: 14px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 30px;
            width: 100%;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0px 5px 15px rgba(255, 117, 140, 0.4);
        }

        input[type="submit"]:hover {
            background: linear-gradient(90deg, #ff5f6d, #ff758c);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Editar Usuario</h2>
        <form method="POST">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">

            <div class="input-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>

            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <div class="input-group">
                <label>Dirección:</label>
                <input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>" required>
            </div>

            <div class="input-group">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" required>
            </div>

            <div class="input-group">
                <label>Rol:</label>
                <select name="rol" required>
                    <option value="Cliente" <?= $usuario['rol'] === 'Cliente' ? 'selected' : '' ?>>Cliente</option>
                    <option value="Vendedor" <?= $usuario['rol'] === 'Vendedor' ? 'selected' : '' ?>>Vendedor</option>
                </select>
            </div>

            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>

