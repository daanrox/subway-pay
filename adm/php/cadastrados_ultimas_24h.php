<?php
try {
    include './../../conectarbanco.php';

    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
    
    // Verificar a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    
    // Verificar se o parâmetro leadAff está presente
    $leadAff = isset($_GET['leadAff']) ? $_GET['leadAff'] : null;

    // Consulta SQL para obter dados da tabela, ordenados pela hora em ordem ascendente
    $sql = "SELECT id
            FROM appconfig";

    // Adicionar cláusula WHERE se o parâmetro leadAff estiver presente
    if (!empty($leadAff)) {
        // Use prepared statement para evitar injeção de SQL
        $sql .= " WHERE lead_aff = ?";
    }

    $sql .= " ORDER BY 
                CASE 
                    WHEN data_cadastro IS NULL THEN 1  -- Coloca registros com data_cadastro vazia por último
                    ELSE 0
                END,
                STR_TO_DATE(data_cadastro, '%H:%i:%s') ASC";

    // Use prepared statement se o parâmetro leadAff estiver presente
    if (!empty($leadAff)) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $leadAff);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($sql);
    }
    
    // Verificar se a consulta foi bem-sucedida
    if (!$result) {
        die("Erro na consulta: " . $conn->error);
    }
    
    // Inicializar um array para armazenar os dados
    $data = array();
    
    // Extrair dados da consulta
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Consulta para obter a quantidade total
    $sqlTotal = "SELECT COUNT(*) as total FROM appconfig";

    // Adicionar cláusula WHERE se o parâmetro leadAff estiver presente
    if (!empty($leadAff)) {
        $sqlTotal .= " WHERE lead_aff = '$leadAff'";
    }

    $resultTotal = $conn->query($sqlTotal);
    $total = ($resultTotal && $resultTotal->num_rows > 0) ? $resultTotal->fetch_assoc()['total'] : 0;

    // Consulta para obter a quantidade nas últimas 24 horas
    $sqlUltimas24h = "SELECT COUNT(*) as ultimas_24h FROM appconfig WHERE STR_TO_DATE(data_cadastro, '%d-%m-%Y %H:%i:%s') >= NOW() - INTERVAL 24 HOUR";

    // Adicionar cláusula WHERE se o parâmetro leadAff estiver presente
    if (!empty($leadAff)) {
        $sqlUltimas24h .= " AND lead_aff = '$leadAff'";
    }

    $resultUltimas24h = $conn->query($sqlUltimas24h);
    $ultimas24h = ($resultUltimas24h && $resultUltimas24h->num_rows > 0) ? $resultUltimas24h->fetch_assoc()['ultimas_24h'] : 0;

    // Fechar a conexão com o banco de dados
    $conn->close();
    
    // Enviar os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(['data' => $data, 'total' => $total, 'ultimas_24h' => $ultimas24h]);
} catch(Exception $e) {
    var_dump($e);
    http_response_code(200);
}
?>
