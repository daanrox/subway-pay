<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['email'])) {
    header("Location: ../");
    exit();}

?> 

<?php
session_start();

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

if (!empty($email)) {
    try {
        
        
         include './../conectarbanco.php';

        $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
        $dbuser = $config['db_user'];
        $conn = new PDO("mysql:host=localhost;dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM confirmar_deposito WHERE email = :email AND status = 'pendente'");
        $stmt->bindParam(':email', $email);
        $stmt->execute();


        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stmtPix = $conn->prepare("SELECT * FROM pix_deposito WHERE code = :externalReference");
            $stmtPix->bindParam(':externalReference', $result['externalreference']);
            $stmtPix->execute();

            $resultPix = $stmtPix->fetch(PDO::FETCH_ASSOC);

            if ($resultPix !== false) {
                $updateStmt = $conn->prepare("UPDATE confirmar_deposito SET status = 'aprovado' WHERE externalreference = :externalReference");
                $updateStmt->bindParam(':externalReference', $result['externalreference']);
                $updateStmt->execute();

                $valorCorrespondencia = $resultPix['value'];

                $updateSaldoStmt = $conn->prepare("UPDATE appconfig SET saldo = saldo + :valorCorrespondencia, depositou = depositou + :valorCorrespondencia WHERE email = :email");
                $updateSaldoStmt->bindParam(':valorCorrespondencia', $valorCorrespondencia);
                $updateSaldoStmt->bindParam(':email', $email);
                $updateSaldoStmt->execute();
                break;
            }
        }


    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
}
?> <?php

    include './../conectarbanco.php';

    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);


if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $consulta_saldo = "SELECT saldo FROM appconfig WHERE email = '$email'";

    $resultado_saldo = $conn->query($consulta_saldo);

    if ($resultado_saldo) {
        if ($resultado_saldo->num_rows > 0) {
            $row = $resultado_saldo->fetch_assoc();
            $saldo = $row['saldo'];
        }
    }
}

$conn->close();
?>

<?php
include 'conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT nome_unico, nome_um, nome_dois, saques_min FROM app";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();


    $nomeUnico = $row['nome_unico'];
    $nomeUm = $row['nome_um'];
    $nomeDois = $row['nome_dois'];
    
    $saqueMinimo = $row['saques_min'];

} else {
    return false;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br" class="w-mod-js w-mod-ix wf-spacemono-n4-active wf-spacemono-n7-active wf-active">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
      .wf-force-outline-none[tabindex="-1"]:focus {
        outline: none;
      }
    </style>
    <meta charset="pt-br">
    <title><?= $nomeUnico ?> 🌊 </title>
    <meta property="og:image" content="../img/logo.png">
    <meta content="<?= $nomeUnico ?> 🌊" property="og:title">
    <meta name="twitter:site" content="@subwaypay">
    <meta name="twitter:image" content="../img/logo.png">
    <meta property="og:type" content="website">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="arquivos/page.css" rel="stylesheet" type="text/css">
    <script src="arquivos/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">
      WebFont.load({
        google: {
          families: ["Space Mono:regular,700"]
        }
      });
    </script>
    <script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
    <script type="text/javascript">
      ! function(o, c) {
        var n = c.documentElement,
          t = " w-mod-";
        n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
      }(window, document);
    </script>
    <link rel="apple-touch-icon" sizes="180x180" href="../img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/logo.png">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <link rel="stylesheet" href="arquivos/css" media="all">
  </head>
  <body>
    <div>
      <div data-collapse="small" data-animation="default" data-duration="400" role="banner" class="navbar w-nav">
        <div class="container w-container">
          <a href="/painel" aria-current="page" class="brand w-nav-brand" aria-label="home">
            <img src="arquivos/l2.png" loading="lazy" height="28" alt="" class="image-6">
            <div class="nav-link logo"><?= $nomeUnico ?></div>
          </a>
          <nav role="navigation" class="nav-menu w-nav-menu">
            <a href="../painel/" class="nav-link w-nav-link" style="max-width: 940px;">Jogar</a>
            <a href="../saque/" class="nav-link w-nav-link w--current" style="max-width: 940px;">Saque</a>
            <a href="../afiliate" class="nav-link w-nav-link" style="max-width: 940px;">Indique e Ganhe</a>
            <a href="../logout.php" class="nav-link w-nav-link" style="max-width: 940px;">Sair</a>
            <a href="../deposito/" class="button nav w-button">Depositar</a>
          </nav>
          <style>
            .nav-bar {
              display: none;
              background-color: #333;
              padding: 20px;
              width: 90%;
              position: fixed;
              top: 0;
              left: 0;
              z-index: 1000;
            }

            .nav-bar a {
              color: white;
              text-decoration: none;
              padding: 10px;
              display: block;
              margin-bottom: 10px;
            }

            .nav-bar a.login {
              color: white;
            }

            .button.w-button {
              text-align: center;
            }
          </style>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              var menuButton = document.querySelector('.menu-button');
              var navBar = document.querySelector('.nav-bar');
              menuButton.addEventListener('click', function() {
                // Toggle the visibility of the navigation bar
                if (navBar.style.display === 'block') {
                  navBar.style.display = 'none';
                } else {
                  navBar.style.display = 'block';
                }
              });
            });
          </script>
          <style>
            .menu-button2 {
              border-radius: 15px;
              background-color: #000;
            }
          </style>
          <div class="w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
            <div class="" style="-webkit-user-select: text;">
              <a href="../deposito/" class="menu-button2 w-nav-dep nav w-button">DEPOSITAR</a>
            </div>
          </div>
          <div class="menu-button w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
            <div class="icon w-icon-nav-menu"></div>
          </div>
        </div>
        <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
      </div>
      <div class="nav-bar">
        <a href="../painel/" class="button w-button">
          <div>Jogar</div>
        </a>
        <a href="../saque/" class="button w-button">
          <div>Saque</div>
        </a>
        <a href="../afiliate/" class="button w-button">
          <div>Indique & ganhe</div>
        </a>
        <a href="../logout.php" class="button w-button">
          <div>Sair</div>
        </a>
        <a href="../deposito/" class="button w-button">Depositar</a>
      </div>
      <!--<link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">-->
      <!--<a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5531992812273&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">-->
      <!--  <div class="rwb-tooltip">Entre em contato!</div>-->
      <!--  <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">-->
      <!--</a>-->
      <section id="hero" class="hero-section dark wf-section">
        <div class="minting-container w-container">
          <img src="arquivos/with.gif" loading="lazy" width="240" data-w-id="6449f730-ebd9-23f2-b6ad-c6fbce8937f7" alt="Roboto #6340" class="mint-card-image">
          <h2>Saque</h2>
          <p>PIX: saques instantâneos com muita praticidade. <br>
          </p>
          <p>SALDO: R$<b class="saldo"> <?php echo isset($saldo) ? number_format($saldo, 2, ',', '.') : '0,00'; ?></p>
          <!--<form data-name="" id="payment_pix" name="payment_pix" method="post" aria-label="Form">-->
          <form data-name="" id="payment_pix" name="payment_pix" method="get" action="saque.php" aria-label="Form">
            <div class="properties">
              <h4 class="rarity-heading">Nome do destinatário:</h4>
              <div class="rarity-row roboto-type2">
                <input type="text" class="large-input-field w-node-_050dfc36-93a8-d840-d215-4fca9adfe60d-9adfe605 w-input" maxlength="256" name="withdrawName" placeholder="Nome do Destinatario" id="withdrawName" required="">
              </div>
              <h4 class="rarity-heading">Chave PIX CPF:</h4>
              <div class="rarity-row roboto-type2">
                <input type="text" class="large-input-field w-node-_050dfc36-93a8-d840-d215-4fca9adfe60d-9adfe605 w-input" maxlength="256" name="withdrawCPF" placeholder="Seu número de CPF" id="withdrawCPF" required="">
              </div>
              <h4 class=" rarity-heading">Valor para saque</h4>
              <div class="rarity-row roboto-type2">
                <input type="number" data-name="withdrawValue" id="withdrawValue" placeholder="Saque Mínimo: R$<?php echo $saqueMinimo; ?>" min="<?php echo $saqueMinimo; ?>" step="1" name="withdrawValue" class="large-input-field w-node-_050dfc36-93a8-d840-d215-4fca9adfe60d-9adfe605 w-input" required>
              </div>
            </div>
            <div class="">
              <!--<input type="submit" value="Sacar via PIX" id="pixgenerator" class="primary-button w-button"><br><br>-->
              <button onclick="solicitarSaque()" class="primary-button w-button">Sacar via PIX</button>
              <br>
              <br>
              <br>
              <br>
              <script>
                function solicitarSaque() {
                  const withdrawName = document.getElementById('withdrawName').value;
                  const withdrawCPF = document.getElementById('withdrawCPF').value;
                  const withdrawValue = document.getElementById('withdrawValue').value;
                  if(withdrawValue < <?php echo $saqueMinimo; ?>){
                      alert("Saque mínimo: R$<?php echo $saqueMinimo; ?>")
                      window.location.href= '../painel/'
                  }
                  if(withdrawValue >= <?php echo $saqueMinimo; ?>){
                      alert("Solicitação de saque realizada!");
                      const url = ``;
                      window.location.href = url;
                      
                      
                  }
                  
                }
              </script>
              <p>Ao solicitar saque você concorda com os <a href="../legal/"> termos de serviço</a> e a <br>taxa de 10% </span>
              </p>
            </div>
          </form>
        </div>
      </section>
      <style>
    .horizontal-table {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 8px;
        border-bottom: 1px solid #ccc;
    }

    .table-row {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 8px;
    }

    .table-row div {
        flex: 1;
        text-align: center;
    }
</style>



      <div class="intermission wf-section"></div>
      <div id="about" class="comic-book white wf-section">
        <div class="minting-container left w-container">
          <div class="w-layout-grid grid-2">
            <img src="arquivos/money.png" loading="lazy" width="240" alt="Roboto #6340" class="mint-card-image v2">
            <div>
              <h2>Indique um amigo e ganhe R$ no PIX</h2>
              <h3>Como funciona?</h3>
              <p>Convide seus amigos que ainda não estão na plataforma. Você receberá R$5 por cada amigo que se inscrever e fizer um depósito. Não há limite para quantos amigos você pode convidar. Isso significa que também não há limite para quanto você pode ganhar!</p>
              <h3>Como recebo o dinheiro?</h3>
              <p>O saldo é adicionado diretamente ao seu saldo no painel abaixo, com o qual você pode sacar via PIX.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-section wf-section">
        <div class="domo-text"><?= $nomeUm ?> <br>
        </div>
        <div class="domo-text purple"><?= $nomeDois ?> <br>
        </div>
        <div class="follow-test">© Copyright xlk Limited, with registered offices at Dr. M.L. King Boulevard 117, accredited by license GLH-16289876512. </div>
        <div class="follow-test">
          <a href="/legal">
            <strong class="bold-white-link">Termos de uso</strong>
          </a>
        </div>
          <div class="follow-test">contato@<?php
$nomeUnico = strtolower(str_replace(' ', '', $nomeUnico));
echo $nomeUnico;
?>.com</div>
      </div>
      <script type="text/javascript">
        $("#withdrawValue").keyup(function(e) {
          var value = $("[name='withdrawValue']").val();
          var final = (value / 100) * 95;
          $('#updatedValue').text('' + final.toFixed(2));
        });
      </script>
    </div>
    <div id="imageDownloaderSidebarContainer">
      <div class="image-downloader-ext-container">
        <div tabindex="-1" class="b-sidebar-outer">
          <!---->
          <div id="image-downloader-sidebar" tabindex="-1" role="dialog" aria-modal="false" aria-hidden="true" class="b-sidebar shadow b-sidebar-right bg-light text-dark" style="width: 500px; display: none;">
            <!---->
            <div class="b-sidebar-body">
              <div></div>
            </div>
            <!---->
          </div>
          <!---->
          <!---->
        </div>
      </div>
    </div>
    <div style="visibility: visible;">
      <div></div>
      <div>
        <div style="display: flex; flex-direction: column; z-index: 999999; bottom: 88px; position: fixed; right: 16px; direction: ltr; align-items: end; gap: 8px;">
          <div style="display: flex; gap: 8px;"></div>
        </div>
        <style>
          @-webkit-keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-launcherOnOpen {
            0% {
              -webkit-transform: translateY(0px) rotate(0deg);
              transform: translateY(0px) rotate(0deg);
            }

            30% {
              -webkit-transform: translateY(-5px) rotate(2deg);
              transform: translateY(-5px) rotate(2deg);
            }

            60% {
              -webkit-transform: translateY(0px) rotate(0deg);
              transform: translateY(0px) rotate(0deg);
            }

            90% {
              -webkit-transform: translateY(-1px) rotate(0deg);
              transform: translateY(-1px) rotate(0deg);
            }

            100% {
              -webkit-transform: translateY(-0px) rotate(0deg);
              transform: translateY(-0px) rotate(0deg);
            }
          }

          @keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-launcherOnOpen {
            0% {
              -webkit-transform: translateY(0px) rotate(0deg);
              transform: translateY(0px) rotate(0deg);
            }

            30% {
              -webkit-transform: translateY(-5px) rotate(2deg);
              transform: translateY(-5px) rotate(2deg);
            }

            60% {
              -webkit-transform: translateY(0px) rotate(0deg);
              transform: translateY(0px) rotate(0deg);
            }

            90% {
              -webkit-transform: translateY(-1px) rotate(0deg);
              transform: translateY(-1px) rotate(0deg);
            }

            100% {
              -webkit-transform: translateY(-0px) rotate(0deg);
              transform: translateY(-0px) rotate(0deg);
            }
          }

          @keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-widgetOnLoad {
            0% {
              opacity: 0;
            }

            100% {
              opacity: 1;
            }
          }

          @-webkit-keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-widgetOnLoad {
            0% {
              opacity: 0;
            }

            100% {
              opacity: 1;
            }
          }
        </style>
      </div>
    </div>
  </body>
</html>