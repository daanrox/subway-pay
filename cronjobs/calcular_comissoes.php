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

// Exibir os resultados
while ($row = $indicadosResult->fetch_assoc()) {
    $idPrincipal = $row['id'];
    $indicados = $row['indicados'];

    echo "<div style='$stylePrincipal'>ID Principal: $idPrincipal, Indicados: $indicados</div>";

    // Inicializar a variável para a soma total de depositou do ID principal
    $somaTotalDepositouPrincipal = 0;

    // Inicializar a variável para a soma total de percas do ID principal
    $somaTotalPercasPrincipal = 0;

    // Inicializar um array para armazenar IDs afiliados
    $idsAfiliados = array();

    // Verificar contas vinculadas ao ID principal na coluna lead_aff
    $leadAffQuery = "SELECT id, depositou, percas FROM appconfig WHERE lead_aff = $idPrincipal";
    $leadAffResult = $conn->query($leadAffQuery);

    // Exibir contas vinculadas
    while ($leadAffRow = $leadAffResult->fetch_assoc()) {
        $idVinculado = $leadAffRow['id'];
        $depositou = $leadAffRow['depositou'];
        $percas = $leadAffRow['percas'];

        echo "<div style='$styleAfiliado'>ID Afiliado: $idVinculado, Depositou: $depositou, Percas: $percas</div>";

        // Armazenar ID afiliado no array
        $idsAfiliados[] = $idVinculado;

        // Somar o valor da coluna depositou do ID vinculado, se não for vazio
        if (!empty($depositou)) {
            $somaTotalDepositouPrincipal += $depositou;
        }

        // Somar o valor da coluna percas do ID vinculado, se não for vazio
        if (!empty($percas)) {
            $somaTotalPercasPrincipal += $percas;
        }
    }

    // Exibir a soma total de depositou do ID principal
    echo "<div style='$stylePrincipal'>Soma Total de Depositou do ID Principal: $somaTotalDepositouPrincipal</div>";

    // Exibir a soma total de percas do ID principal
    echo "<div style='$stylePrincipal'>Soma Total de Percas do ID Principal: $somaTotalPercasPrincipal</div>";

    // Calcular a comissão do ID principal (20% da soma total de percas)
    $comissaoPrincipal = $somaTotalPercasPrincipal * 0.20;

    // Atualizar a coluna saldo_comissao do ID principal
    $updateComissaoQuery = "UPDATE appconfig SET saldo_comissao = $comissaoPrincipal WHERE id = $idPrincipal";
    $conn->query($updateComissaoQuery);

    // Exibir a comissão do ID principal
    echo "<div style='$stylePrincipal'>Comissão do ID Principal: $comissaoPrincipal</div>";

    // Exibir os IDs afiliados
    if (!empty($idsAfiliados)) {
        echo "<div style='$styleAfiliado'>IDs Afiliados: " . implode(", ", $idsAfiliados) . "</div>";
    }

    echo "<br>";
}

// Fechar conexão
$conn->close();
?>

