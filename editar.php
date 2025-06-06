<?php
// editar.php
include("conexion.php");

// Inicializar variable por defecto para evitar errores
$usuario = [
    'id_usuario' => '',
    'nombre' => '',
    'email' => '',
    'direccion' => '',
    'telefono' => '',
    'rol' => ''
];

// Verificar si se recibe un ID por GET
if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: mostrar.php");
        exit();
    }

    // Obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
    } else {
                // Redirigir si no se encuentra el usuario
        echo "Usuario no encontrado.";
        $stmt->close();
        header("Location: mostrar.php");
        exit();
    }

    $stmt->close();
}

// Procesar formulario de edición
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $rol = $_POST["rol"];

    if (!$id) {
        echo "ID de usuario inválido.";
        exit();
    }

    if (!empty($_POST['nueva_contrasena'])) {
        $nueva_contrasena = password_hash($_POST['nueva_contrasena'], PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nombre=?, email=?, direccion=?, telefono=?, rol=?, contrasena=? WHERE id_usuario=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nombre, $email, $direccion, $telefono, $rol, $nueva_contrasena, $id);
    } else {
        // Si no se proporciona una nueva contraseña, no la actualizamos
        // Aseguramos que los campos requeridos estén presentes
        $sql = "UPDATE usuarios SET nombre=?, email=?, direccion=?, telefono=?, rol=? WHERE id_usuario=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $email, $direccion, $telefono, $rol, $id);
    }

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . htmlspecialchars($conn->error));
    }

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="login-container">
        <h2>Editar Usuario</h2>
        <form action="" method="POST">
            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($usuario['direccion']); ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>

            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="administrador" <?php if ($usuario['rol'] === 'administrador') echo 'selected'; ?>>Administrador</option>
                <option value="usuario" <?php if ($usuario['rol'] === 'usuario') echo 'selected'; ?>>Usuario</option>
            </select>

            <label for="nueva_contrasena">Nueva Contraseña (opcional):</label>
            <input type="password" name="nueva_contrasena" id="nueva_contrasena">

            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
<a class="navbar-brand" href="#">JAK</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="navbar-toggler-icon"></span>
//         </button>
//         <div class="collapse navbar-collapse" id="navbarNav">
//        <ul class="navbar-nav">               
//             <li class="nav-item active">
//                 <a class="nav-link" href="cliente.php">Inicio</a>
//             </li>
//             <li class="nav-item">
//                 <a class="nav-link" href="logout.php">Cerrar sesión</a>
//             </li>

//         </ul>

//         </div>


//     </div>

// </nav>
//
