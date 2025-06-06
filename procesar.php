<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos
    if (
        isset($_POST["id_usuario"], $_POST["nombre"], $_POST["email"],
              $_POST["direccion"], $_POST["telefono"], $_POST["contrasena"], $_POST["rol"])
    ) {
        // Asignar valores a las variables
        $id_usuario = trim($_POST["id_usuario"]);
        $nombre = trim($_POST["nombre"]);
        $email = trim($_POST["email"]);
        $direccion = trim($_POST["direccion"]);
        $telefono = trim($_POST["telefono"]);
        $contrasena = $_POST["contrasena"];
        $rol = $_POST["rol"];
        $fecha_registro = date("Y-m-d H:i:s");

        // Validar formato del correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Por favor ingresa un correo electrónico válido.";
            exit();
        }

        // Validar longitud mínima de la contraseña
        if (strlen($contrasena) < 6) {
            echo "La contraseña debe tener al menos 6 caracteres.";
            exit();
        }

        // Validar el teléfono (opcional, si es un número válido)
        if (!preg_match("/^[0-9]{10}$/", $telefono)) {
            echo "El teléfono debe tener 10 dígitos.";
            exit();
        }

        // Validar que el ID de usuario sea numérico
        if (!is_numeric($id_usuario)) {
            echo "El ID de usuario debe ser un número válido.";
            exit();
        }

        // Cifrar la contraseña
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO usuarios (id_usuario, nombre, email, direccion, telefono, contrasena, rol, fecha_registro)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "Error en la preparación de la consulta: " . $conn->error;
            exit();
        }

        // Vincular los parámetros de la consulta
        $stmt->bind_param("ssssssss", $id_usuario, $nombre, $email, $direccion, $telefono, $contrasena_hash, $rol, $fecha_registro);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir a la página de listado de usuarios después de un registro exitoso
            header("Location: mostrar.php");
            exit();
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
