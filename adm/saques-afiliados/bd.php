<?php
include './../../conectarbanco.php';

// Verificar a conexão
$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter dados da tabela saque_afiliado
$sql = "SELECT email, nome, pix, valor, status FROM saque_afiliado";

// Utilizando prepared statements para prevenir injeção de SQL
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

if (!$stmt->execute()) {
    die("Erro na execução da consulta: " . $stmt->error);
}

$result = $stmt->get_result();

if (!$result) {
    die("Erro na obtenção do resultado: " . $conn->error);
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
$stmt->close();
$conn->close();

// Enviar os dados como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
