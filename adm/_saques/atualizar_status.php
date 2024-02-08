<?php
include './../../conectarbanco.php';
error_reporting(0);

$externalReference = $_GET['externalReference'];

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "UPDATE saques SET status = 'Concluído' WHERE externalreference = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $externalReference);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

$stmt->close();
$conn->close();
?>
