<?php
include './../conectarbanco.php';

// Verificar se o método de requisição é POST para processamento do saque
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    session_start();
    $session_email = $_SESSION['email'];

    if (!$session_email) {
        die("Sessão do navegador não encontrada.");
    }

    $valor = floatval($_POST['valor']);

    $sql_saldo = "SELECT saldo FROM appconfig WHERE email = ?";
    $stmt_saldo = $conn->prepare($sql_saldo);
    $stmt_saldo->bind_param("s", $session_email);
    $stmt_saldo->execute();
    $stmt_saldo->bind_result($saldo);
    $stmt_saldo->fetch();
    $stmt_saldo->close();

    if ($saldo >= $valor && $valor > 0) {
        $conn->begin_transaction();

        $novo_saldo = $saldo - $valor;

        $sql_update_saldo = "UPDATE appconfig SET saldo = ? WHERE email = ?";
        $stmt_update_saldo = $conn->prepare($sql_update_saldo);
        $stmt_update_saldo->bind_param("ds", $novo_saldo, $session_email);
        $stmt_update_saldo->execute();

        $external_reference = uniqid();
        $status = "Pendente";

        $sql_insert_saque = "INSERT INTO saques (email, externalreference, valor, status) VALUES (?, ?, ?, ?)";
        $stmt_insert_saque = $conn->prepare($sql_insert_saque);
        $stmt_insert_saque->bind_param("ssds", $session_email, $external_reference, $valor, $status);
        $stmt_insert_saque->execute();

        if ($stmt_update_saldo->affected_rows > 0 && $stmt_insert_saque->affected_rows > 0) {
            $conn->commit();
            // Redirecionar para a página de sucesso com parâmetros da URL
            header("Location: saque_realizado.php?withdrawName=" . urlencode($_POST['withdrawName']) . "&withdrawCPF=" . urlencode($_POST['withdrawCPF']) . "&withdrawValue=" . urlencode($_POST['valor']));
            exit();
        } else {
            $conn->rollback();
            echo "Falha ao processar o saque.";
            exit;
        }
    } else {
        echo "Saldo insuficiente ou valor inválido.";
        exit;
    }

    $conn->close();
}

// Obter valores da URL, se existirem
$withdrawName = isset($_GET['withdrawName']) ? htmlspecialchars(urldecode($_GET['withdrawName'])) : '';
$withdrawCPF = isset($_GET['withdrawCPF']) ? urldecode($_GET['withdrawCPF']) : '';
$withdrawValue = isset($_GET['withdrawValue']) ? urldecode($_GET['withdrawValue']) : '';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saque Recebido - SubwayMoney [Pix]</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Efeito de luz pulsante no fundo do div */
    @keyframes neon-background {
      0% {
        background-color: #1a202c; /* Cor inicial do fundo */
      }
      50% {
        background-color: #2d3748; /* Cor intermediária */
      }
      100% {
        background-color: #1a202c; /* Cor final igual à inicial */
      }
    }

    .neon-background {
      animation: neon-background 2s ease-in-out infinite; /* Ajuste a duração e a temporização conforme necessário */
    }
  </style>
</head>
<body class="bg-gray-900 text-white flex justify-center items-center h-screen">
  <div class="w-full md:w-3/4 lg:w-1/2 xl:w-1/3">
    <div class="bg-gray-800 p-6 rounded-lg shadow-md neon-background">
      <h1 class="text-2xl font-semibold mb-4 text-center">Solicitação de Saque realizada!</h1>
      <div class="mb-4">
        <p class="font-semibold">ID de Transação:</p>
        <p><?php echo md5(rand(1111,9999)); ?></p>
      </div>
      <div class="mb-4">
        <p class="font-semibold">Data de Solicitação:</p>
        <p><?= date('d/m/Y H:i') ?></p>
      </div>
      <div class="mb-4">
        <p class="font-semibold">Nome do Recebedor:</p>
        <p><?= $withdrawName ?></p>
      </div>
      <div class="mb-4">
        <p class="font-semibold">Chave Pix (CPF):</p>
        <p><?= $withdrawCPF ?></p>
      </div>
      <div class="mb-4">
        <p class="font-semibold">Valor do Saque:</p>
        <p>R$ <?= number_format($withdrawValue, 2, ',', '.') ?></p>
      </div>
      <div class="mb-4">
        <p class="font-semibold">Prazo para Envio:</p>
        <p><?= date('d/m/Y H:i', strtotime('+48 hours')) ?></p>
      </div>
      <!--<a href="https://api.whatsapp.com/send?phone=5518991286757&text=Ol%C3%A1,%20quero%20agilizar%20meu%20saque%20por%20favor." class="bg-green-500 text-white py-2 px-4 rounded-md inline-block block w-full text-center">Enviar comprovante via WhatsApp</a>-->
      <a href="https://api.whatsapp.com/send?phone=5518981000529&text=Ol%C3%A1,%20quero%20agilizar%20meu%20saque%20por%20favor." class="bg-green-500 text-white py-2 px-4 rounded-md inline-block block w-full text-center relative whatsapp-button">
        Enviar comprovante via <span class="neon-text">WhatsApp</span>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1191px-WhatsApp.svg.png" alt="WhatsApp" class="whatsapp-icon absolute h-4 top-1/2 transform -translate-y-1/2 left-4">
      </a>
    </div>
    <footer class="text-center text-gray-500 text-sm py-4">
      &copy; <?= date('Y') ?> subwayvip.com.br - Todos os direitos reservados
    </footer>
  </div>

  <script>
    // Highlight.js para destacar a sintaxe do código
    document.addEventListener('DOMContentLoaded', (event) => {
      document.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightBlock(block);
      });
    });
  </script>
  
  <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
<a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5518981000529&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">
  <div class="rwb-tooltip">Entre em contato!</div>
  <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
</a>
  
</body>

</html>
