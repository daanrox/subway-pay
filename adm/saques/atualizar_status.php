<?php
include './../../conectarbanco.php';
session_start();

if (!isset($_SESSION['email'])) {
    die("Erro: A sessão de e-mail não está definida.");
}
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$logFilePath = __DIR__ . '/daanrox.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $novoStatus = $_POST['novoStatus'];

    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $logMessage = "ID recebido: $id, Novo Status recebido: $novoStatus";
    error_log($logMessage, 3, $logFilePath);

    $atualizarStatusQuery = "UPDATE saques SET status = ? WHERE externalreference = ?";

    $stmt = $conn->prepare($atualizarStatusQuery);

    $stmt->bind_param("si", $novoStatus, $id);

    if ($stmt->execute()) {
        $successMessage = "Status atualizado com sucesso!";
        error_log($successMessage, 3, $logFilePath);
        echo $successMessage;
    } else {
        $errorMessage = "Erro ao atualizar o status: " . $stmt->error;
        error_log($errorMessage, 3, $logFilePath);
        echo $errorMessage;
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo "Método não permitido";
}
?>