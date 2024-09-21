<?php
include './../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Primeira parte: Consulta para somar os valores da coluna 'percas' na tabela 'appconfig'
$sql_soma_percas = "SELECT ROUND(SUM(percas), 2) AS total_percas FROM appconfig";

$result_soma_percas = $conn->query($sql_soma_percas);

if ($result_soma_percas) {
    $row = $result_soma_percas->fetch_assoc();
    $total_percas = $row['total_percas'];

    // Verificar se já existe uma linha na tabela 'ggr'
    $sql_verificar_ggr = "SELECT COUNT(*) AS count FROM ggr";
    $result_verificar_ggr = $conn->query($sql_verificar_ggr);

    if ($result_verificar_ggr) {
        $row_count = $result_verificar_ggr->fetch_assoc();

        if ($row_count['count'] > 0) {
            // Se já existir uma linha, atualize o valor existente
            $sql_atualizar_ggr = "UPDATE ggr SET total_percas = $total_percas";
        } else {
            // Se não existir uma linha, insira uma nova linha
            $sql_atualizar_ggr = "INSERT INTO ggr (total_percas) VALUES ($total_percas)";
        }

        if ($conn->query($sql_atualizar_ggr) === TRUE) {
            echo "Valor total de perdas atualizado na tabela 'ggr' com sucesso!\n";
        } else {
            echo "Erro ao atualizar o valor total de perdas na tabela 'ggr': " . $conn->error . "\n";
        }

        // Segunda parte: Consulta para obter o valor da coluna 'ggr_taxa' na tabela 'ggr'
        $sql_obter_taxa = "SELECT ROUND(ggr_taxa, 2) AS ggr_taxa FROM ggr LIMIT 1";

        $result_obter_taxa = $conn->query($sql_obter_taxa);

        if ($result_obter_taxa) {
            $row_taxa = $result_obter_taxa->fetch_assoc();
            $ggr_taxa = $row_taxa['ggr_taxa'];

            // Consulta para obter o valor da coluna 'total_percas' na tabela 'ggr'
            $sql_obter_total_percas = "SELECT ROUND(total_percas, 2) AS total_percas FROM ggr LIMIT 1";
            $result_obter_total_percas = $conn->query($sql_obter_total_percas);

            if ($result_obter_total_percas) {
                $row_total_percas = $result_obter_total_percas->fetch_assoc();
                $total_percas = $row_total_percas['total_percas'];

                // Calcular a porcentagem
                $porcentagem_desconto = ROUND(($ggr_taxa / 100) * $total_percas, 2);

                // Atualizar a coluna 'ggr_total' na tabela 'ggr' com o valor da porcentagem
                $sql_atualizar_ggr = "UPDATE ggr SET ggr_total = $porcentagem_desconto";

                if ($conn->query($sql_atualizar_ggr) === TRUE) {
                    echo "Valor da porcentagem atualizado na coluna 'ggr_total' com sucesso!\n";
                } else {
                    echo "Erro ao atualizar o valor da porcentagem na coluna 'ggr_total': " . $conn->error . "\n";
                }

                // Terceira parte: Consulta para calcular a diferença e garantir que nunca seja negativa
                $sql_calcula_diferenca = "SELECT ROUND(GREATEST(ggr_total - ggr_pago, 0), 2) AS resultado FROM ggr LIMIT 1";

                $result_calcula_diferenca = $conn->query($sql_calcula_diferenca);

                if ($result_calcula_diferenca) {
                    $row_calcula_diferenca = $result_calcula_diferenca->fetch_assoc();
                    $resultado = $row_calcula_diferenca['resultado'];

                    // Consulta para atualizar 'debito_ggr' com o resultado calculado
                    $sql_atualizar_debito_ggr = "UPDATE ggr SET debito_ggr = $resultado";

                    if ($conn->query($sql_atualizar_debito_ggr) === TRUE) {
                        echo "Valor da diferença adicionado à coluna 'debito_ggr' com sucesso!\n";
                    } else {
                        echo "Erro ao atualizar o valor da coluna 'debito_ggr': " . $conn->error . "\n";
                    }

                    // Quarta parte: Consulta para obter o valor da coluna 'debito_ggr' na tabela 'ggr'
                    $sql_obter_debito_ggr = "SELECT ROUND(debito_ggr, 2) AS debito_ggr FROM ggr LIMIT 1";

                    $result_obter_debito_ggr = $conn->query($sql_obter_debito_ggr);

                    if ($result_obter_debito_ggr) {
                        $row_debito_ggr = $result_obter_debito_ggr->fetch_assoc();
                        $debito_ggr = $row_debito_ggr['debito_ggr'];

                        // Calcular o status com base no valor da coluna 'debito_ggr'
                        $status_ggr = ($debito_ggr == 0) ? 'REGULAR' : 'IRREGULAR';

                        // Atualizar a coluna 'status_ggr' na tabela 'ggr' com o novo valor
                        $sql_atualizar_status_ggr = "UPDATE ggr SET status_ggr = '$status_ggr'";

                        if ($conn->query($sql_atualizar_status_ggr) === TRUE) {
                            echo "Status atualizado com sucesso!\n";
                        } else {
                            echo "Erro ao atualizar o status: " . $conn->error . "\n";
                        }
                    } else {
                        echo "Erro ao obter o valor de debito_ggr: " . $conn->error . "\n";
                    }
                } else {
                    echo "Erro ao calcular a diferença: " . $conn->error . "\n";
                }
            } else {
                echo "Erro ao obter o valor total de perdas: " . $conn->error . "\n";
            }
        } else {
            echo "Erro ao obter a taxa de desconto: " . $conn->error . "\n";
        }
    } else {
        echo "Erro ao verificar a tabela 'ggr': " . $conn->error . "\n";
    }
} else {
    echo "Erro ao calcular o valor total de perdas: " . $conn->error . "\n";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
