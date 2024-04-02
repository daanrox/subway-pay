<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o parâmetro status está presente
$status = isset($_GET['status']) ? $_GET['status'] : null;

// Query de leitura para o número total de depósitos com base no status
$sqlCountDeposits = "SELECT COUNT(*) as depositCount FROM confirmar_deposito WHERE status='PAID_OUT'";

// Adicionar cláusula WHERE se o parâmetro status estiver presente
if (!empty($status)) {
    $sqlCountDeposits .= " AND status = ?";
}

$stmt = $conn->prepare($sqlCountDeposits);

// Se o status estiver presente, vincule os parâmetros
if (!empty($status)) {
    $stmt->bind_param("s", $status);
}

$stmt->execute();
$resultCountDeposits = $stmt->get_result();
$stmt->close();

if ($resultCountDeposits->num_rows > 0) {
    $rowCountDeposits = $resultCountDeposits->fetch_assoc();
    echo $rowCountDeposits["depositCount"];
} else {
    echo "0";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
