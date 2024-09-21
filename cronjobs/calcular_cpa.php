<?php
include './../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consultar a coluna indicados na tabela appconfig
$indicadosQuery = "SELECT id, indicados FROM appconfig WHERE indicados > 0";
$indicadosResult = $conn->query($indicadosQuery);

// Estilo CSS para as linhas
$stylePrincipal = "color: blue; font-weight: bold;";
$styleAfiliado = "color: green; margin-left: 20px;";
$styleIdsAfiliado = "color: red; margin-left: 20px;";

// Exibir os resultados
while ($row = $indicadosResult->fetch_assoc()) {
    $idPrincipal = $row['id'];
    $indicados = $row['indicados'];

    echo "<div style='$stylePrincipal'>ID Principal: $idPrincipal, Indicados: $indicados</div>";

    // Inicializar a variável para a soma total de primeiro_deposito do ID principal
    $somaTotalDepositouPrincipal = 0;
    $quantidadeCPA = 0;

    // Inicializar um array para armazenar IDs afiliados
    $idsAfiliados = array();

    // Verificar contas vinculadas ao ID principal na coluna lead_aff
    $leadAffQuery = "SELECT id, primeiro_deposito, cont_cpa FROM appconfig WHERE lead_aff = $idPrincipal";
    $leadAffResult = $conn->query($leadAffQuery);

    // Verificar se a consulta foi bem-sucedida
    if (!$leadAffResult) {
        die("Erro na consulta de contas vinculadas: " . $conn->error);
    }

    // Exibir contas vinculadas
    while ($leadAffRow = $leadAffResult->fetch_assoc()) {
        $idVinculado = $leadAffRow['id'];
        $primeiroDeposito = $leadAffRow['primeiro_deposito'];
        $qtdCPA = $leadAffRow['cont_cpa'];

        // Verificar se a coluna primeiro_deposito está vazia ou nula
        if ($primeiroDeposito !== null && $primeiroDeposito !== '') {
            echo "<div style='$styleAfiliado'>ID Afiliado: $idVinculado, Primeiro Depósito: $primeiroDeposito</div>";

            // Armazenar ID afiliado no array
            $idsAfiliados[] = $idVinculado;

            // Somar o valor da coluna primeiro_deposito do ID vinculado, se não for vazio
            $somaTotalDepositouPrincipal += $primeiroDeposito;
            if ($primeiroDeposito > 0) {
                $quantidadeCPA = $quantidadeCPA + 1;
            }
        }
    }

    // Atualizar a coluna saldo_cpa do ID principal
    $updateComissaoQuery = "UPDATE appconfig SET saldo_cpa = $somaTotalDepositouPrincipal, cont_cpa =  $quantidadeCPA WHERE id = $idPrincipal";
    $conn->query($updateComissaoQuery);

    // Exibir a soma total de primeiro_deposito do ID principal
    echo "<div style='$styleAfiliado'>Soma Total de CPA do ID Principal: $somaTotalDepositouPrincipal</div>";
    echo "<div style='$styleAfiliado'>quantidade de CPA's: $quantidadeCPA</div>";

    // Exibir os IDs afiliados
    if (!empty($idsAfiliados)) {
        echo "<div style='$styleIdsAfiliado'>IDs Afiliados: " . implode(", ", $idsAfiliados) . "</div>";
    }

    echo "<br>";
}

// Fechar conexão
$conn->close();
?>
