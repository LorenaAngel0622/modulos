<?php
include("conexion.php");

$usuario = null;

// Obtener datos del usuario por ID (GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Asegurarse de usar la conexión correcta
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE ID_usuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }

    $stmt->close();
}

// Actualizar datos del usuario (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena']; // Verificar si la contraseña se está cifrando
    $rol = $_POST['rol'];
    $fecha_registro = $_POST['fecha_registro'];

    // Verificar si la contraseña está vacía
    if (!empty($contrasena)) {
        // Si la contraseña se está actualizando, cifrarla
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
    } else {
        // Si no se actualiza la contraseña, no modificarla
        $contrasena = null;
    }

    // Preparar la consulta de actualización
    $query = "UPDATE usuario SET 
        nombre = ?, 
        email = ?, 
        direccion = ?, 
        telefono = ?, 
        CONTRESENA = ?,
        rol = ?, 
        fecha_registro = ?";

    // Solo agregar la actualización de la contraseña si no es null
    if ($contrasena) {
        $query .= ", contrasena = ?";
    }

    $query .= " WHERE ID_usuario = ?";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Asociar parámetros
    if ($contrasena) {
        $stmt->bind_param("sssssssi", $nombre, $email, $direccion, $telefono, $rol, $fecha_registro, $contrasena, $id);
    } else {
        $stmt->bind_param("sssssssi", $nombre, $email, $direccion, $telefono, $rol, $fecha_registro, $id);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir después de una actualización exitosa
        header("Location: mostrar.php?id=" . $id);
        exit();
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

