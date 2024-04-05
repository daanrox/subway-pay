<?php
include './../../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$nomeUnico = "";
$nomeUm = "";
$nomeDois = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUnico = $_POST["nomeUnico"];
    $nomeUm = $_POST["nomeUm"];
    $nomeDois = $_POST["nomeDois"];

    $response = array();
    $updateSql = "UPDATE app SET nome_unico = ?, nome_um = ?, nome_dois = ? LIMIT 1";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sss", $nomeUnico, $nomeUm, $nomeDois);

    if ($stmt->execute()) {
        $response["sucesso"] = "Valores atualizados com sucesso!";
        $response["nomeUnico"] = $nomeUnico; 
        $response["nomeUm"] = $nomeUm;
        $response["nomeDois"] = $nomeDois;
    } else {
        $response["erro"] = "Erro ao atualizar: " . $conn->error;
    }

    $stmt->close();

    
    echo json_encode($response);
} else {
   
    return false;
}

$conn->close();
?>
