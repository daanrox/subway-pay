<?php
$valor_transacao_multiplicado = isset($_GET['valor_transacao_multiplicado']) ? $_GET['valor_transacao_multiplicado'] : 0;


// Supondo que você já tenha iniciado a sessão
session_start();

// Informações de conexão com o banco de dados
    include './../conectarbanco.php';

    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtém o email da sessão
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Obtém o saldo do formulário
    $saldo = isset($_POST['valor_transacao_multiplicado']) ? $_POST['valor_transacao_multiplicado'] : 0;

    // Query para atualizar o saldo na tabela "appconfig" para o email da sessão
    $sql = "UPDATE appconfig SET saldo = saldo + '$saldo' WHERE email = '$email'";

    // Executa a query
    if ($conn->query($sql) === TRUE) {
        echo "Saldo atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o saldo: " . $conn->error;
    }
} else {
    echo "Email não encontrado na sessão.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
