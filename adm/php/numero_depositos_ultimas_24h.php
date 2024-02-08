<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Calcular a data e hora há 24 horas atrás
$currentDateTime = date('d-m-Y H:i:s');
$twentyFourHoursAgo = date('d-m-Y H:i:s', strtotime('-24 hours', strtotime($currentDateTime)));

// Verificar se o parâmetro status está presente
$status = isset($_GET['status']) ? $_GET['status'] : null;

// Query de leitura para o número de depósitos nas últimas 24 horas com base no status
$sqlCountLast24h = "SELECT COUNT(*) as depositCount FROM confirmar_deposito WHERE  data >= ?";

// Adicionar cláusula WHERE se o parâmetro status estiver presente
if (!empty($status)) {
    $sqlCountLast24h .= " AND status = ?";
}

$stmt = $conn->prepare($sqlCountLast24h);

// Se o status estiver presente, vincule os parâmetros
if (!empty($status)) {
    $stmt->bind_param("ss", $twentyFourHoursAgo, $status);
} else {
    $stmt->bind_param("s", $twentyFourHoursAgo);
}

$stmt->execute();
$resultCountLast24h = $stmt->get_result();
$stmt->close();

if ($resultCountLast24h->num_rows > 0) {
    $rowCountLast24h = $resultCountLast24h->fetch_assoc();
    echo $rowCountLast24h["depositCount"];
} else {
    echo "0";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
