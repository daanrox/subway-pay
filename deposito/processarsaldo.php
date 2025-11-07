<?php
$valor_transacao_multiplicado = isset($_GET["valor_transacao_multiplicado"])
    ? $_GET["valor_transacao_multiplicado"]
    : 0;

session_start();

include "./../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];

    $saldo = isset($_POST["valor_transacao_multiplicado"])
        ? $_POST["valor_transacao_multiplicado"]
        : 0;

    $sql = "UPDATE appconfig SET saldo = saldo + '$saldo' WHERE email = '$email'";

    if ($conn->query($sql) === true) {
        echo "Saldo atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o saldo: " . $conn->error;
    }
} else {
    echo "Email não encontrado na sessão.";
}

$conn->close();
?>
