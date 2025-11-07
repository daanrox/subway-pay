<?php
include './../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

session_start();
$session_email = $_SESSION['email'];

if (!$session_email) {
    die("Sessão do navegador não encontrada.");
}

$valor = floatval($_POST['valor']); 

$sql = "SELECT saldo FROM appconfig WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_email);
$stmt->execute();
$stmt->bind_result($saldo);
$stmt->fetch();
$stmt->close();

if ($saldo >= $valor && $valor > 0) {
    $novo_saldo = $saldo - $valor;

    $sql_update = "UPDATE appconfig SET saldo = saldo - ?, percas = percas + ? WHERE email = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("dds", $valor, $valor, $session_email);
    $stmt_update->execute();
    $stmt_update->close();

    header("Location: ../jogar");
    exit();
} else {
    echo "Saldo insuficiente ou valor inválido.";
}

$conn->close();
?>