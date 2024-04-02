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
    $sql = "SELECT id, data_cadastro, email, senha, telefone, saldo, linkafiliado, plano, depositou, indicados, bloc, saldo_comissao, percas, ganhos, cpa, cpafake, comissaofake 
            FROM appconfig";

    // Adicionar cláusula WHERE se o parâmetro leadAff estiver presente
    if (!empty($leadAff)) {
        // Use prepared statement para evitar injeção de SQL
        $sql .= " WHERE afiliado = ?";
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
    
    // Fechar a conexão com o banco de dados
    $conn->close();
    
    // Enviar os dados como JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch(Exception $e) {
    var_dump($e);
    http_response_code(200);
}
?>
