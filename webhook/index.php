<?php
// Inicie a sessão (certifique-se de que isso está no início do seu script)
session_start();

// Seção de configuração do banco de dados
  include './../conectarbanco.php';

    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);





// Verifique o valor da sessão antes de usar na SQL
echo 'Valor da Sessão: ' . $_SESSION['email'];



// Verificar a conexão com o banco de dados
if ($conn->connect_error) {
    die("Conexão com o banco de dados falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = file_get_contents('php://input');
    $ip_pagstar = '3.128.119.90';

    // Verifique se a solicitação veio do IP correto (3.128.119.90)
    if ($_SERVER['REMOTE_ADDR'] !== $ip_pagstar) {
        http_response_code(403); // Proibido
        echo '<p>Acesso não autorizado</p>';
        exit;
    }

    // Converta os dados JSON para um array associativo
    $dados_array = json_decode($dados, true);

    // Adicione uma marca de data e hora aos dados
    $dados_log = date('Y-m-d H:i:s') . "\n" . print_r($dados_array, true) . "\n\n";

    // Salve os dados no arquivo de log
    $logFile = 'webhook_log.txt';
    file_put_contents($logFile, $dados_log, FILE_APPEND);

    // Insira os dados na tabela do banco de dados
    $value = $dados_array['value']; // Substitua 'value' pelo nome correto do campo
  $email = isset($_SESSION['email']) ? $_SESSION['email'] : 'N/A';
    $code = $dados_array['external_reference']; // Substitua 'external_reference' pelo nome correto do campo
    $status = $dados_array['status']; // Substitua 'status' pelo nome correto do campo
    $data = date('Y-m-d H:i:s');

  $sql = "INSERT INTO pix_deposito (value, email, code, status, data) VALUES ('$value', '$email', '$code', '$status', '$data')";


    if ($conn->query($sql) === TRUE) {
        echo '<h2>Dados inseridos na tabela com sucesso!</h2>';
    } else {
        echo '<h2>Erro ao inserir dados na tabela: ' . $conn->error . '</h2>';
    }

    // Exiba os dados na página
    echo '<h2>Webhook Recebido com Sucesso!</h2>';
    echo '<h3>Dados Recebidos:</h3>';
    echo '<pre>' . print_r($dados_array, true) . '</pre>';
} else {
    // Responda com erro se a requisição não for do tipo POST
    http_response_code(405); // Método não permitido
    echo '<h2>Método não permitido</h2>';
    echo '<p>Certifique-se de que o método da sua solicitação é POST.</p>';
}

// Nome do arquivo de log
$logFile = 'webhook_log.txt';

// Verifique se o arquivo de log existe
if (file_exists($logFile)) {
    // Exiba os logs do arquivo
    $logs = file_get_contents($logFile);
    echo '<h3>Logs:</h3>';
    echo '<pre>' . htmlspecialchars($logs) . '</pre>';
} else {
    echo '<p>Nenhum log disponível</p>';
}



echo 'Valor da Sessão (no final do script): ' . $_SESSION['email'];
// Feche a conexão com o banco de dados
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webhook Receiver & Monitor</title>
    <script>
        // Função para atualizar a página a cada 5 segundos
        function atualizarPagina() {
            location.reload();
        }
        
        // Atualize a página a cada 5 segundos
        setInterval(atualizarPagina, 5000);
    </script>
</head>
<body>

<h1>Webhook Receiver & Monitor</h1>

</body>
</html>
