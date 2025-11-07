<?php
try {
    
    include './../../conectarbanco.php';

    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
    
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

$sql = "SELECT email, externalreference, destino, chavepix, data, valor, status FROM saques";
$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$data = array_reverse($data);

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
} catch(Exception $e) {
    var_dump($e);
    http_response_code(200);
}
?>
