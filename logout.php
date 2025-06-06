<?php
session_start();

// Eliminar solo las variables de sesión relacionadas con el usuario
unset($_SESSION['usuario']);


session_destroy();

// Redirigir al login
header("Location: login.php");
exit();
?>
