<?php
include "./../../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$novoValor = $_POST["novo_valor"];

$sqlUpdate = "UPDATE app SET deposito_min = ? LIMIT 1";
$stmt = $conn->prepare($sqlUpdate);
$stmt->bind_param("i", $novoValor);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Valor atualizado com sucesso!";
} else {
    echo "Erro ao atualizar o valor: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
