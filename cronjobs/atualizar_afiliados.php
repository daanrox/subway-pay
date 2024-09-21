<?php
session_start();

include './../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$batchSize = 1000;
$start = 0;

do {
    // Atualizar a coluna indicados com base na contagem da ocorrência do ID na coluna lead_aff
    $updateQuery = "
        UPDATE appconfig
        SET indicados = (
            SELECT COUNT(*) 
            FROM appconfig AS ac 
            WHERE FIND_IN_SET(appconfig.id, ac.lead_aff) > 0
        )
        LIMIT $start, $batchSize
    ";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Atualização de $batchSize registros concluída com sucesso.<br>";
        $start += $batchSize;
    } else {
        echo "Erro na atualização: " . $conn->error;
    }

} while ($conn->affected_rows > 0);

$conn->close();
?>
