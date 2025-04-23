<?php
include("conexion.php");

$usuario = null;

// Obtener datos del usuario por ID (GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE ID_usuario = ?");
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
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];
    $fecha_registro = $_POST['fecha_registro'];

    // Aseguramos que el ID se pase correctamente al ejecutar la consulta
    $stmt = $conexion->prepare("UPDATE usuario SET 
        nombre = ?, 
        email = ?, 
        direccion = ?, 
        telefono = ?, 
        contrasena = ?, 
        rol = ?, 
        fecha_registro = ?
        WHERE ID_usuario = ?");

    // Aquí corregimos los parámetros de bind_param: añadimos el tipo adecuado para cada uno
    $stmt->bind_param("sssssssi", $nombre, $email, $direccion, $telefono, $contrasena, $rol, $fecha_registro, $id);

    if ($stmt->execute()) {
        header("Location: mostrar.php");
        exit();
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
