<?php
session_start();

include "./../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

echo "Valor da Sessão: " . $_SESSION["email"];

if ($conn->connect_error) {
    die("Conexão com o banco de dados falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dados = file_get_contents("php://input");
    $ip_pagstar = "3.128.119.90";

    if ($_SERVER["REMOTE_ADDR"] !== $ip_pagstar) {
        http_response_code(403);
        echo "<p>Acesso não autorizado</p>";
        exit();
    }

    $dados_array = json_decode($dados, true);

    $dados_log =
        date("Y-m-d H:i:s") . "\n" . print_r($dados_array, true) . "\n\n";

    $logFile = "webhook_log.txt";
    file_put_contents($logFile, $dados_log, FILE_APPEND);

    $value = $dados_array["value"];
    $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "N/A";
    $code = $dados_array["external_reference"];
    $status = $dados_array["status"];
    $data = date("Y-m-d H:i:s");

    $sql = "INSERT INTO pix_deposito (value, email, code, status, data) VALUES ('$value', '$email', '$code', '$status', '$data')";

    if ($conn->query($sql) === true) {
        echo "<h2>Dados inseridos na tabela com sucesso!</h2>";
    } else {
        echo "<h2>Erro ao inserir dados na tabela: " . $conn->error . "</h2>";
    }

    echo "<h2>Webhook Recebido com Sucesso!</h2>";
    echo "<h3>Dados Recebidos:</h3>";
    echo "<pre>" . print_r($dados_array, true) . "</pre>";
} else {
    http_response_code(405);
    echo "<h2>Método não permitido</h2>";
    echo "<p>Certifique-se de que o método da sua solicitação é POST.</p>";
}

$logFile = "webhook_log.txt";

if (file_exists($logFile)) {
    $logs = file_get_contents($logFile);
    echo "<h3>Logs:</h3>";
    echo "<pre>" . htmlspecialchars($logs) . "</pre>";
} else {
    echo "<p>Nenhum log disponível</p>";
}

echo "Valor da Sessão (no final do script): " . $_SESSION["email"];
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webhook Receiver & Monitor</title>
    <script>
        function atualizarPagina() {
            location.reload();
        }
        
        setInterval(atualizarPagina, 5000);
    </script>
</head>
<body>

<h1>Webhook Receiver & Monitor</h1>

</body>
</html>
