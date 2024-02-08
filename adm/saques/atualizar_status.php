<?php
include './../../conectarbanco.php';
session_start();

// Verifica se o valor da sessão está definido
if (!isset($_SESSION['email'])) {
    die("Erro: A sessão de e-mail não está definida.");
}
// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Caminho completo para o arquivo de log
$logFilePath = __DIR__ . '/log_atualizar_status.txt';

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o ID e o novo status da requisição POST
    $id = $_POST['id'];
    $novoStatus = $_POST['novoStatus'];

    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Adicione logs para depurar
    $logMessage = "ID recebido: $id, Novo Status recebido: $novoStatus";
    error_log($logMessage, 3, $logFilePath);

    $atualizarStatusQuery = "UPDATE saques SET status = ? WHERE externalreference = ?";

    // Prepare a consulta
    $stmt = $conn->prepare($atualizarStatusQuery);

    // Vincule os parâmetros
    $stmt->bind_param("si", $novoStatus, $id);

    // Execute a consulta
    if ($stmt->execute()) {
        $successMessage = "Status atualizado com sucesso!";
        error_log($successMessage, 3, $logFilePath);
        echo $successMessage;
    } else {
        $errorMessage = "Erro ao atualizar o status: " . $stmt->error;
        error_log($errorMessage, 3, $logFilePath);
        echo $errorMessage;
    }

    // Feche a declaração
    $stmt->close();
} else {
    // Se a requisição não for do tipo POST, retorna um erro
    http_response_code(405); // Método não permitido
    echo "Método não permitido";
}
?>