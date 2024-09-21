<?php


include './../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter o valor da coluna saldo_inserido na tabela ggr
$sql_obter_saldo_inserido = "SELECT saldo_inserido FROM ggr LIMIT 1";

$result_obter_saldo_inserido = $conn->query($sql_obter_saldo_inserido);

if ($result_obter_saldo_inserido) {
    $row_saldo_inserido = $result_obter_saldo_inserido->fetch_assoc();
    $saldo_inserido = $row_saldo_inserido['saldo_inserido'];

    if ($saldo_inserido > 0) {
        // Consulta para obter o valor da coluna debito_ggr na tabela ggr
        $sql_obter_debito_ggr = "SELECT debito_ggr FROM ggr LIMIT 1";

        $result_obter_debito_ggr = $conn->query($sql_obter_debito_ggr);

        if ($result_obter_debito_ggr) {
            $row_debito_ggr = $result_obter_debito_ggr->fetch_assoc();
            $debito_ggr = $row_debito_ggr['debito_ggr'];

            // Subtrair o valor de debito_ggr de saldo_inserido
            $resultado = $saldo_inserido - $debito_ggr;

            // Consulta para atualizar a coluna credito_ggr com o resultado
            $sql_atualizar_credito_ggr = "UPDATE ggr SET credito_ggr = $resultado, debito_ggr = 0, saldo_inserido = 0";

            if ($conn->query($sql_atualizar_credito_ggr) === TRUE) {
                // Consulta para somar o valor de debito_ggr à coluna ggr_pago
                $sql_atualizar_ggr_pago = "UPDATE ggr SET ggr_pago = ggr_pago + $debito_ggr";

                if ($conn->query($sql_atualizar_ggr_pago) === TRUE) {
                    echo "Resultado adicionado à coluna credito_ggr, colunas debito_ggr e saldo_inserido definidas como 0, e valor de debito_ggr somado à coluna ggr_pago com sucesso!";
                } else {
                    echo "Erro ao somar o valor de debito_ggr à coluna ggr_pago: " . $conn->error;
                }
            } else {
                echo "Erro ao atualizar as colunas: " . $conn->error;
            }
        } else {
            echo "Erro ao obter o valor de debito_ggr: " . $conn->error;
        }
    } else {
        echo "Nenhum valor para subtrair (saldo_inserido <= 0)";
    }
} else {
    echo "Erro ao obter o valor de saldo_inserido: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
