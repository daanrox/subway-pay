<?php
try {
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

    $leadAff = isset($_GET["leadAff"]) ? $_GET["leadAff"] : null;

    $sql = "SELECT id
            FROM appconfig";

    if (!empty($leadAff)) {
        $sql .= " WHERE lead_aff = ?";
    }

    $sql .= " ORDER BY 
                CASE 
                    WHEN data_cadastro IS NULL THEN 1  -- Coloca registros com data_cadastro vazia por último
                    ELSE 0
                END,
                STR_TO_DATE(data_cadastro, '%H:%i:%s') ASC";

    if (!empty($leadAff)) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $leadAff);
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
        $data[] = $row;
    }

    $sqlTotal = "SELECT COUNT(*) as total FROM appconfig";

    if (!empty($leadAff)) {
        $sqlTotal .= " WHERE lead_aff = '$leadAff'";
    }

    $resultTotal = $conn->query($sqlTotal);
    $total =
        $resultTotal && $resultTotal->num_rows > 0
            ? $resultTotal->fetch_assoc()["total"]
            : 0;

    $sqlUltimas24h =
        "SELECT COUNT(*) as ultimas_24h FROM appconfig WHERE STR_TO_DATE(data_cadastro, '%d-%m-%Y %H:%i:%s') >= NOW() - INTERVAL 24 HOUR";

    if (!empty($leadAff)) {
        $sqlUltimas24h .= " AND lead_aff = '$leadAff'";
    }

    $resultUltimas24h = $conn->query($sqlUltimas24h);
    $ultimas24h =
        $resultUltimas24h && $resultUltimas24h->num_rows > 0
            ? $resultUltimas24h->fetch_assoc()["ultimas_24h"]
            : 0;

    $conn->close();

    header("Content-Type: application/json");
    echo json_encode([
        "data" => $data,
        "total" => $total,
        "ultimas_24h" => $ultimas24h,
    ]);
} catch (Exception $e) {
    var_dump($e);
    http_response_code(200);
}
?>
