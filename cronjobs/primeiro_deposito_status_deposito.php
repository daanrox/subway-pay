<?php
include './../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consultar a coluna value e status na tabela confirmar_deposito
$pixDepositoQuery = "SELECT email, valor, status FROM confirmar_deposito";
$pixDepositoResult = $conn->query($pixDepositoQuery);

$stylePrincipal = "color: blue; font-weight: bold;";

// Iterar sobre os resultados
while ($row = $pixDepositoResult->fetch_assoc()) {
    $emailDeposito = $row['email'];
    $valueDeposito = $row['valor'];
    $statusDeposito = $row['status'];

    echo "<div style='$stylePrincipal'>email: $emailDeposito</div>";
    echo "<div style='$stylePrincipal'>valor: $valueDeposito</div>";
    echo "<div style='$stylePrincipal'>status: $statusDeposito</div>";
    echo "<br/>";

    // Verificar se o status é "aprovado"
    if ($statusDeposito == "PAID_OUT") {
        // Atualizar a tabela app_config com as informações necessárias
        $updateAppConfigQuery = "UPDATE appconfig SET status_primeiro_deposito = 1, primeiro_deposito = $valueDeposito WHERE email = '$emailDeposito'";
        
        // Executar a consulta e verificar erros
        if ($conn->query($updateAppConfigQuery) === TRUE) {
            echo "<div style='$stylePrincipal'>Atualização bem-sucedida na tabela appconfig para o email: $emailDeposito</div>";

            // Recuperar os valores após a atualização para verificação
            $checkQuery = "SELECT status_primeiro_deposito, primeiro_deposito FROM appconfig WHERE email = '$emailDeposito'";
            $checkResult = $conn->query($checkQuery);
            $checkRow = $checkResult->fetch_assoc();

            echo "<pre>";
            print_r($checkRow);
            echo "</pre>";
        } else {
            echo "<div style='$stylePrincipal'>Erro na atualização da tabela appconfig para o email: $emailDeposito. Erro: " . $conn->error . "</div>";
        }
    }
}

// Fechar conexão
$conn->close();
?>
