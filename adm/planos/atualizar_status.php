<?php

include './../../conectarbanco.php';
error_reporting(0);

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verifica a conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Recebe os parâmetros do POST
$email = $_POST['email'];
$newStatus = $_POST['status'];

// Atualiza o status na tabela 'saque_afiliado' no banco de dados
$sql = "UPDATE saque_afiliado SET status = '$newStatus' WHERE email = '$email' LIMIT 1";

if ($conn->query($sql) === TRUE) {
  echo 'success';
} else {
  echo 'error';
}

$conn->close();
?>
