<?php
include "./../../conectarbanco.php";

$conn = new mysqli(
    $config["db_host"],
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientID = $_POST["clientID"];
    $clientSecret = $_POST["clientSecret"];

    $checkSql = "SELECT * FROM gateway LIMIT 1";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $updateSql =
            "UPDATE gateway SET client_id = ?, client_secret = ? LIMIT 1";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ss", $clientID, $clientSecret);

        if ($stmt->execute()) {
            echo "Sucesso: Valores atualizados com sucesso!";
        } else {
            echo "Erro ao atualizar: " . $conn->error;
        }

        $stmt->close();
    } else {
        $insertSql =
            "INSERT INTO gateway (client_id, client_secret) VALUES (?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("ss", $clientID, $clientSecret);

        if ($stmt->execute()) {
            echo "Sucesso: Nova linha adicionada!";
        } else {
            echo "Erro ao inserir: " . $conn->error;
        }

        $stmt->close();
    }
}

$client_id = "";
$client_secret = "";

$sql = "SELECT client_id, client_secret FROM gateway LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $client_id = $row["client_id"];
    $client_secret = $row["client_secret"];
}

$conn->close();
?>
