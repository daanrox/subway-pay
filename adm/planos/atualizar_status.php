<?php

include './../../conectarbanco.php';
error_reporting(0);

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verifica a conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Recebe os parâmetros do POST e escapa os valores para prevenir injeção SQL
$email = $conn->real_escape_string(trim($_POST['email']));
$newStatus = $conn->real_escape_string($_POST['status']);
$valor = $conn->real_escape_string($_POST['valor']);

// Abre ou cria um arquivo de log para mensagens de depuração
$logFile = fopen("debug_log.txt", "a") or die("Unable to open file!");

// Escreve as mensagens de depuração no arquivo de log
$logMessage = "Email recebido: $email\n";
fwrite($logFile, $logMessage);
$logMessage = "Novo status: $newStatus\n";
fwrite($logFile, $logMessage);
$logMessage = "Valor recebido: $valor\n";
fwrite($logFile, $logMessage);

// Atualiza o status na tabela 'saque_afiliado' no banco de dados
$sql = "UPDATE saque_afiliado SET status = '$newStatus' WHERE valor = '$valor' AND email = '$email'";

if ($conn->query($sql) === TRUE) {
  fwrite($logFile, "Success\n");
  echo 'success';
} else {
  $errorMessage = 'error updating status: ' . $conn->error . "\n";
  fwrite($logFile, $errorMessage);
  echo $errorMessage;
}

// Fecha o arquivo de log
fclose($logFile);

$conn->close();
?>
