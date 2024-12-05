<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "funk_rap";

// Cria uma conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
