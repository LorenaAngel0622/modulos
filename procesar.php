<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos
    if (
        isset($_POST["id_usuario"], $_POST["nombre"], $_POST["email"],
              $_POST["direccion"], $_POST["telefono"], $_POST["contrasena"], $_POST["rol"])
    ) {
        $id_usuario = $_POST["id_usuario"];
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $contrasena = $_POST["contrasena"];
        $rol = $_POST["rol"];
        $fecha_registro = date("Y-m-d H:i:s");

        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (id_usuario, nombre, email, direccion, telefono, contrasena, rol, fecha_registro)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $id_usuario, $nombre, $email, $direccion, $telefono, $contrasena_hash, $rol, $fecha_registro);

        if ($stmt->execute()) {
            header("Location: mostrar.php");
            exit();
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }

    $conn->close();
} else {
    echo "Acceso no permitido.";
}
