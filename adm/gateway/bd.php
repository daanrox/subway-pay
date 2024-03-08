<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientID = $_POST["clientID"];
    $clientSecret = $_POST["clientSecret"];

    // Verificar se já existe uma linha na tabela
    $checkSql = "SELECT * FROM gateway LIMIT 1";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // Se existe, atualizar os valores
        $updateSql = "UPDATE gateway SET client_id = '$clientID', client_secret = '$clientSecret' LIMIT 1";

        if ($conn->query($updateSql) === TRUE) {
            echo "Sucesso: Valores atualizados com sucesso!";
        } else {
            echo "Erro ao atualizar: " . $conn->error;
        }
    } else {
        // Se não existe, inserir uma nova linha
        $insertSql = "INSERT INTO gateway (client_id, client_secret) VALUES ('$clientID', '$clientSecret')";

        if ($conn->query($insertSql) === TRUE) {
            echo "Sucesso: Nova linha adicionada!";
        } else {
            echo "Erro ao inserir: " . $conn->error;
        }
    }
}

$client_id = 'josecmarketing_1703711893600';
$client_secret = '20f95e89705f8e688876fcc45594cfdffea8b8a77cc4948e0393383abe99fa33d5a1f049ee434d318a59a5b820b40a37';

// Consulta SQL para obter client_id e client_secret da tabela gateway
$sql = "SELECT client_id, client_secret FROM gateway LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obter o resultado como um array associativo
    $row = $result->fetch_assoc();

    // Atribuir os valores a variáveis
    $client_id = $row['client_id'];
    $client_secret = $row['client_secret'];
}

$conn->close();
?>
