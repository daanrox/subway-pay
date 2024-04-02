<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query de leitura
$sql = "SELECT ggr_taxa FROM ggr"; // Substitua sua_tabela pelo nome real da sua tabela

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo number_format($row["ggr_taxa"], 2, '.', '');
} else {
    echo "0";
}

$conn->close();
?>
