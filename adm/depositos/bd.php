<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verificar se o parâmetro status está presente
$status = isset($_GET['status']) ? $_GET['status'] : null;

// Consulta SQL para obter dados da tabela
$sql = "SELECT email, externalreference, valor, status, data FROM confirmar_deposito";

// Adicionar cláusula WHERE se o parâmetro status estiver presente
if (!empty($status)) {
    // Use prepared statement para evitar injeção de SQL
    $sql .= " WHERE status = ?";
}

// Adicionar ORDER BY para ordenar pela coluna "data" em ordem descendente
$sql .= " ORDER BY 
            CASE 
                WHEN data IS NULL THEN 1  -- Coloca registros com data vazia por último
                ELSE 0
            END,
            STR_TO_DATE(data, '%H:%i:%s') DESC";

// Use prepared statement se o parâmetro status estiver presente
if (!empty($status)) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $status);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

// Inicializar um array para armazenar os dados
$data = array();

// Extrair dados da consulta
while ($row = $result->fetch_assoc()) {
    // Mapear o valor da coluna "status" para exibir "Pendente" ou "Aprovado"
    $row['status'] = ($row['status'] == 'WAITING_FOR_APPROVAL') ? 'Pendente' : 'Aprovado';

    $data[] = $row;
}

// Fechar a conexão com o banco de dados
$conn->close();

// Enviar os dados como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
