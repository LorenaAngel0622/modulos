<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "JAK";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error. "| Error Code: " . $conn->connect_errno);
}
?>