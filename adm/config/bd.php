<?php
include './../../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR']) {
    http_response_code(403);
    exit("Acesso não autorizado.");
}

$nomeUnico = "";
$nomeUm = "";
$nomeDois = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUnico = $_POST["nomeUnico"];
    $nomeUm = $_POST["nomeUm"];
    $nomeDois = $_POST["nomeDois"];

    if (strpos(strtolower($nomeUnico), '<script>') !== false) {
        $nomeUnico = 'Subway Pay';
    }
    if (strpos(strtolower($nomeUm), '<script>') !== false) {
        $nomeUm = 'SUBWAY';
    }
    if (strpos(strtolower($nomeDois), '<script>') !== false) {
        $nomeDois = 'PAY';
    }

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
