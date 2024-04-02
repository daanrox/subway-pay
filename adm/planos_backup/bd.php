<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter dados da tabela
$sql = "SELECT nome, cpa, rev, indicacao FROM planos";
$result = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

// Inicializar um array para armazenar os dados
$data = array();

// Extrair dados da consulta
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Reverter a ordem dos dados (últimos registros primeiro)
$data = array_reverse($data);

// Fechar a conexão com o banco de dados
$conn->close();

// Enviar os dados como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
