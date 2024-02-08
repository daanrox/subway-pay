<?php
// Detalhes de conexão com o banco de dados
include './../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter o valor da coluna debito_ggr na tabela ggr
$sql_obter_debito_ggr = "SELECT debito_ggr, credito_ggr FROM ggr LIMIT 1";

$result_obter_debito_ggr = $conn->query($sql_obter_debito_ggr);

if ($result_obter_debito_ggr) {
    $row_debito_ggr = $result_obter_debito_ggr->fetch_assoc();
    $debito_ggr = $row_debito_ggr['debito_ggr'];

    // Verificar se o valor de debito_ggr é maior que zero e menor ou igual a credito_ggr
    if ($debito_ggr > 0 && $debito_ggr <= $row_debito_ggr['credito_ggr']) {
        // Consulta para somar o valor de debito_ggr à coluna ggr_pago
        $sql_atualizar_ggr_pago = "UPDATE ggr SET ggr_pago = ggr_pago + $debito_ggr";

        if ($conn->query($sql_atualizar_ggr_pago) === TRUE) {
            echo "Valor de debito_ggr somado à coluna ggr_pago com sucesso!\n";
        } else {
            echo "Erro ao somar o valor de debito_ggr à coluna ggr_pago: " . $conn->error . "\n";
        }

        // Consulta para atualizar as colunas debito_ggr e credito_ggr
        $sql_atualizar_debito_credito = "UPDATE ggr SET debito_ggr = 0, credito_ggr = credito_ggr - $debito_ggr";

        if ($conn->query($sql_atualizar_debito_credito) === TRUE) {
            echo "Valor de debito_ggr subtraído de credito_ggr e colunas atualizadas com sucesso!\n";
        } else {
            echo "Erro ao atualizar as colunas: " . $conn->error . "\n";
        }
    } else {
        echo "Nenhum valor válido para somar (debito_ggr <= 0 ou maior que credito_ggr). Nenhuma operação realizada.\n";
    }
} else {
    echo "Erro ao obter o valor de debito_ggr: " . $conn->error . "\n";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
