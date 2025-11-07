<?php
include "./../../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$status = isset($_GET["status"]) ? $_GET["status"] : null;

$sql =
    "SELECT email, externalreference, valor, status, data FROM confirmar_deposito";

if (!empty($status)) {
    $sql .= " WHERE status = ?";
}

$sql .= " ORDER BY 
            CASE 
                WHEN data IS NULL THEN 1  -- Coloca registros com data vazia por último
                ELSE 0
            END,
            STR_TO_DATE(data, '%H:%i:%s') DESC";

if (!empty($status)) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

$data = [];

while ($row = $result->fetch_assoc()) {
    $row["status"] =
        $row["status"] == "WAITING_FOR_APPROVAL" ? "Pendente" : "Aprovado";

    $data[] = $row;
}

$conn->close();

header("Content-Type: application/json");
echo json_encode($data);
?>
