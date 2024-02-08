<?php
include './../conectarbanco.php';

// Conectar ao banco de dados
$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter a sessão do navegador (certifique-se de que a sessão foi iniciada antes)
session_start();
$session_email = $_SESSION['email'];

// Verificar se a sessão do navegador está presente
if (!$session_email) {
    die("Sessão do navegador não encontrada.");
}

// Obter o valor enviado pelo formulário
$valor = floatval($_POST['valor']); // Certifique-se de validar e limpar os dados do formulário

// Consultar o saldo do usuário na tabela appconfig
$sql = "SELECT saldo FROM appconfig WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_email);
$stmt->execute();
$stmt->bind_result($saldo);
$stmt->fetch();
$stmt->close();

// Verificar se o saldo é suficiente
if ($saldo >= $valor && $valor > 0) {
    // Subtrair o valor do saldo na tabela appconfig
    $novo_saldo = $saldo - $valor;

    // Adicionar o valor ao campo 'percas'
    $sql_update = "UPDATE appconfig SET saldo = saldo - ?, percas = percas + ? WHERE email = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("dds", $valor, $valor, $session_email);
    $stmt_update->execute();
    $stmt_update->close();

    // Aqui você pode adicionar qualquer lógica adicional, se necessário
    header("Location: ../jogar");
    exit();
} else {
    echo "Saldo insuficiente ou valor inválido.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>