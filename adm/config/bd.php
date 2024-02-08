<?php
include './../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$nomeUnico = "";
$nomeUm = "";
$nomeDois = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUnico = $_POST["nomeUnico"];
    $nomeUm = $_POST["nomeUm"];
    $nomeDois = $_POST["nomeDois"];

    $response = array(); // Inicializa o array de resposta

    // Atualiza a tabela app se já existir uma linha
    $checkSql = "SELECT * FROM app LIMIT 1";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $updateSql = "UPDATE app SET nome_unico = '$nomeUnico', nome_um = '$nomeUm', nome_dois = '$nomeDois' LIMIT 1";

        if ($conn->query($updateSql) === TRUE) {
            $response["sucesso"] = "Valores atualizados com sucesso!";
            $response["nomeUnico"] = $nomeUnico; // Adiciona as variáveis ao array de resposta
            $response["nomeUm"] = $nomeUm;
            $response["nomeDois"] = $nomeDois;
        } else {
            $response["erro"] = "Erro ao atualizar: " . $conn->error;
        }
    } else {
        // Se não existir, insere uma nova linha
        $insertSql = "INSERT INTO app (nome_unico, nome_um, nome_dois) VALUES ('$nomeUnico', '$nomeUm', '$nomeDois')";

        if ($conn->query($insertSql) === TRUE) {
            $response["sucesso"] = "Nova linha adicionada!";
            $response["nomeUnico"] = $nomeUnico; // Adiciona as variáveis ao array de resposta
            $response["nomeUm"] = $nomeUm;
            $response["nomeDois"] = $nomeDois;
        } else {
            $response["erro"] = "Erro ao inserir: " . $conn->error;
        }
    }

    // Retorna a resposta como JSON
    return true;
} else {
    // Se a requisição não for do tipo POST, você pode adicionar aqui lógica adicional conforme necessário
    return false;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
