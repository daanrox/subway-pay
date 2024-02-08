<?php
// Configurações do banco de dados
include './../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta SQL para somar os valores aprovados por email
$sql = "SELECT email, SUM(valor) AS total_depositado FROM confirmar_deposito WHERE status = 'aprovado' GROUP BY email";

$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Atualiza a tabela appconfig com o total depositado para cada email
        $updateSql = "UPDATE appconfig SET depositou = " . $row["total_depositado"] . " WHERE email = '" . $row["email"] . "'";
        $conn->query($updateSql);
    }

    echo "Atualização concluída com sucesso.";
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
