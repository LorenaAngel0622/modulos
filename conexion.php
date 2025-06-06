<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "JAK";
$port = 3306;

// Mostrar errores detallados en desarrollo
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Establecer codificación UTF-8
$conn->set_charset("utf8");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error . "| Error Code: " . $conn->connect_errno);
}
?>
