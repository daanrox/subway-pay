<?php
// Inicia a sessão

function bad_request()
{
    echo 'a';
    http_response_code(400);
    exit;
}

if (!isset($_GET['token'])) {
    bad_request();
}




// Obtém o valor da sessão
// $externalReference = isset($_SESSION['externalReference']) ? $_SESSION['externalReference'] : '';
$externalReference = $_GET['token'];

include './../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
if ($conn->connect_error) {
    echo 'error';
    return;
}

// Consulta o banco de dados
$sql = sprintf("SELECT status FROM confirmar_deposito WHERE externalreference = '%s'", $externalReference);

$result = $conn->query($sql);

// Verifica se há uma correspondência
$result = $result->fetch_assoc();

# if the payment is not found, exit
if (!$result) {
    echo json_encode(array('message' => 'Token inválido'));
    http_response_code(400);
    return;
}

echo json_encode($result);
http_response_code(200);
?>
