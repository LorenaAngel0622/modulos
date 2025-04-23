<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_usuario'])) {
    $id = $_POST['id_usuario'];

    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        header("Location: mostrar.php");
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

    .login-container {
        background-color: white;
        padding: 45px 35px;
        border-radius: 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        width: 360px;
        animation: fadeIn 0.8s ease-in-out;
        text-align: center;
        margin-top: 50px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-container h2 {
        color: #ff758c;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .login-container .volver-registro {
        margin-top: 20px;
        font-size: 16px;
    }

    .login-container .volver-registro a {
        color: #ff758c;
        text-decoration: none;
        font-weight: 600;
    }

    .login-container .volver-registro a:hover {
        color: #ff5f6d;
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

    .error {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="brand">JAK</div>
    <h2>¿Estás segura de eliminar este usuario?</h2>
    <form method="POST">
      <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($_GET['id_usuario'] ?? '') ?>">
      <input type="submit" value="Sí, eliminar usuario">
    </form>
    <div class="volver-registro">
      <a href="mostrar.php">← Cancelar</a>
    </div>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
  </div>
</body>
</html>
