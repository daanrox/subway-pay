<?php
include './../../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$nomeUnico = "";
$nomeUm = "";
$nomeDois = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUnico = $_POST["nomeUnico"];
    $nomeUm = $_POST["nomeUm"];
    $nomeDois = $_POST["nomeDois"];

    // Verifica se os campos contêm '<script>'
    if (strpos($nomeUnico, '<script>') !== false) {
        $nomeUnico = 'Subway Pay';
    }
    if (strpos($nomeUm, '<script>') !== false) {
        $nomeUm = 'SUBWAY';
    }
    if (strpos($nomeDois, '<script>') !== false) {
        $nomeDois = 'PAY';
    }

    // Preparando e executando a query
    $updateSql = "UPDATE app SET nome_unico = ?, nome_um = ?, nome_dois = ? LIMIT 1";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sss", $nomeUnico, $nomeUm, $nomeDois);

    if ($stmt->execute()) {
        $response["sucesso"] = "Valores atualizados com sucesso!";
        $response["nomeUnico"] = $nomeUnico; // Adiciona as variáveis ao array de resposta
        $response["nomeUm"] = $nomeUm;
        $response["nomeDois"] = $nomeDois;
    } else {
        $response["erro"] = "Erro ao atualizar: " . $conn->error;
    }

    $stmt->close();

    // Retorna a resposta como JSON
    echo json_encode($response);
} else {
    // Se a requisição não for do tipo POST, você pode adicionar aqui lógica adicional conforme necessário
    return false;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
