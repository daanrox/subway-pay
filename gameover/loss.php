<?php
session_start();

include './../conectarbanco.php';

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$noback = isset($_SESSION['noback']) && $_SESSION['noback'] === 'true';

// Se 'noback' for verdadeiro, redireciona para a página do painel sem executar comandos SQL
if ($noback) {
    header("Location: ../painel/");
    exit;
}



$betValues = [
    '1BC' => 1.00,
    '2BC' => 2.00,
    '3BC' => 5.00,
];

$bet = isset($_POST['bet']) && isset($betValues[$_POST['bet']]) ? $betValues[$_POST['bet']] : 0.00;
// echo "Aposta: " . $bet;



        $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        $saldoQuery = "SELECT saldo FROM appconfig WHERE email = ?";
        $saldoStmt = $conn->prepare($saldoQuery);
        $saldoStmt->bind_param("s", $email);
        $saldoStmt->execute();
        $saldoStmt->bind_result($saldoAtual);
        $saldoStmt->fetch();
        $saldoStmt->close();
        

        $updatePercas = "UPDATE appconfig SET percas = percas + ? WHERE email = ?";
        $updatePercasStmt = $conn->prepare($updatePercas);
        $updatePercasStmt->bind_param("ds", $bet, $email);
        $updatePercasStmt->execute();
        $updatePercasStmt->close();

        $leadAffId = "SELECT lead_aff FROM appconfig WHERE email = ?";
        $leadAffStmt = $conn->prepare($leadAffId);
        $leadAffStmt->bind_param("s", $email);
        $leadAffStmt->execute();
        $leadAffStmt->bind_result($leadAff);
        $leadAffStmt->fetch();
        $leadAffStmt->close();
        
        if($leadAff){
         
            $percentAff = "SELECT plano FROM appconfig WHERE id = ?";
            $percentAffStmt = $conn->prepare($percentAff);
            $percentAffStmt->bind_param("s", $leadAff);
            $percentAffStmt->execute();
            $percentAffStmt->bind_result($plano);
            $percentAffStmt->fetch();
            $percentAffStmt->close();
    
            if (is_numeric($plano) && $plano > 0) {
                // Executar ações relacionadas ao banco de dados
             
        
                $addValue = $bet * ($plano / 100);
        
                $updateComissao = "UPDATE appconfig SET saldo_comissao = saldo_comissao + ? WHERE id = ?";
                $updateComissaoStmt = $conn->prepare($updateComissao);
                $updateComissaoStmt->bind_param("di", $addValue, $leadAff);
                $updateComissaoStmt->execute();
                $updateComissaoStmt->close();
        }
            
            
            
            
            
        }


        $novoSaldo = $saldoAtual - $bet;

        $updateQuery = "UPDATE appconfig SET saldo = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ds", $novoSaldo, $email);
        $updateStmt->execute();
        $updateStmt->close();

        $conn->close();
    

?>


<!DOCTYPE html>

<html lang="pt-br" class="w-mod-js w-mod-ix wf-spacemono-n4-active wf-spacemono-n7-active wf-active">

<head>
    <script>
         <script>
        // Adicione esta parte ao final do seu corpo HTML
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Verifica se o noback está definido como true e redireciona para o painel
        if (<?php echo $noback ? 'true' : 'false'; ?>) {
            window.location.href = '../painel/redirect.php';
        }
    </script>
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        .wf-force-outline-none[tabindex="-1"]:focus {
            outline: none;
        }
    </style>
    <meta charset="pt-br">
    <title>Você perdeu! 🌊 </title>
    <meta property="og:image" content="../img/logo.png">
    <meta content="SubwayPay 🌊" property="og:title">
    <meta name="twitter:image" content="../img/logo.png">

    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="./arquivos/page.css" rel="stylesheet" type="text/css">


<script>
    localStorage.setItem('realBetPage', 'false');

    window.addEventListener('pageshow', function (event) {
        // Verificar o localStorage quando a página for exibida ou recarregada
        localStorage.setItem('realBetPage', 'false');
    });


    window.onload = function() {
        // Adicione esta parte ao final do seu código PHP
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function(event) {
            window.history.pushState(null, null, window.location.href);
            // Configurar sessionStorage para evitar execução adicional
            sessionStorage.setItem('noback', 'true');
        };
        
        // Verificar sessionStorage quando a página for carregada ou recarregada
        if (sessionStorage.getItem('noback') === 'true') {
            window.location.href = '../painel/redirect.php';
        }
    };
</script>

<script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ["Space Mono:regular,700"]
            
            }
        });
       
    </script>




    <link rel="apple-touch-icon" sizes="180x180" href="../img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/logo.png">


    <link rel="icon" type="image/x-icon" href="../img/logo.png">


    <link rel="stylesheet" href="./arquivos/css" media="all">


</head>

<body>



    <div>


        <section id="hero" class="hero-section dark wf-section">

            <style>
                div.escudo {
                    display: block;
                    width: 247px;
                    line-height: 65px;
                    font-size: 12px;
                    margin: -60px 0 0 0;
                    background-image: url(./arquivos/escudo-branco.png);
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center;
                    filter: drop-shadow(1px 1px 3px #00000099) hue-rotate(0deg);
                }

                div.escudo img {
                    width: 50px;
                    margin: -10px 6px 0 0;
                }
            </style>

            <div class="minting-container w-container" style="margin-top: -20%">
                <div class="escudo">
                    <img src="arquivos/trophy.gif">
                </div>
                <h2>VOCÊ PERDEU</H2> 
                <h2>NÃO DESANIME!</h2>
                <!--<p class="win-warn"><strong>Você poderia ter ganho incríveis R$-->
                <!--        <?php echo $valor; ?>-->
                <!--    </strong>-->
                <!--</p>-->
                <p>A persistência é a chave para o sucesso, não deixe isso te por pra baixo. #ficadica!</p>
                <strong style="margin-top: 20px"> ⬇️ Clique no Botão Abaixo para Jogar Novamente</strong>

                <a href="../painel/redirect.php" class="cadastro-btn">JOGAR</a>

                <style>
                    .win-warn {
                        color: red;
                    }

                    .cadastro-btn {
                        display: inline-block;
                        margin-top: 20px;
                        padding: 16px 40px;
                        border-style: solid;
                        border-width: 4px;
                        border-color: #1f2024;
                        border-radius: 8px;
                        background-color: #1fbffe;
                        box-shadow: -3px 3px 0 0 #1f2024;
                        -webkit-transition: background-color 200ms ease, box-shadow 200ms ease, -webkit-transform 200ms ease;
                        transition: background-color 200ms ease, box-shadow 200ms ease, -webkit-transform 200ms ease;
                        transition: background-color 200ms ease, transform 200ms ease, box-shadow 200ms ease;
                        transition: background-color 200ms ease, transform 200ms ease, box-shadow 200ms ease, -webkit-transform 200ms ease;
                        font-family: right grotesk, sans-serif;
                        color: #fff;
                        font-size: 1.25em;
                        text-align: center;
                        letter-spacing: .12em;
                        cursor: pointer;
                    }
                </style>

            </div>


            <div id="wins" style="
                display: block;
                width: 240px;
                font-size: 12px;
                padding: 5px 0;
                text-align: center;
                line-height: 13px;
                background-color: #FFC107;
                border-radius: 10px;
                border: 3px solid #1f2024;
                box-shadow: -3px 3px 0 0px #1f2024;
                margin: -24px auto 0 auto;
                z-index: 5;
            ">

                <?php
                function obterNumeroAleatorio()
                {
                    $numeroAleatorio = rand(500, 1000);

                    return $numeroAleatorio;
                }

                $numero = obterNumeroAleatorio();

                ?>


                Usuários Online:<br class="jWQDfMST8B">
                <?php echo $numero; ?>
            </div>



        </section>

        <div style="visibility: visible;">
            <div></div>
            <div>
                <div
                    style="display: flex; flex-direction: column; z-index: 999999; bottom: 88px; position: fixed; right: 16px; direction: ltr; align-items: end; gap: 8px;">
                    <div style="display: flex; gap: 8px;"></div>
                </div>
                <style>
                    @-webkit-keyframes ww-c5d711d7-9084-48ed-a561-d5b5f32aa3a5-launcherOnOpen {
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

                    @keyframes ww-c5d711d7-9084-48ed-a561-d5b5f32aa3a5-launcherOnOpen {
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

                    @keyframes ww-c5d711d7-9084-48ed-a561-d5b5f32aa3a5-widgetOnLoad {
                        0% {
                            opacity: 0;
                        }

                        100% {
                            opacity: 1;
                        }
                    }

                    @-webkit-keyframes ww-c5d711d7-9084-48ed-a561-d5b5f32aa3a5-widgetOnLoad {
                        0% {
                            opacity: 0;
                        }

                        100% {
                            opacity: 1;
                        }
                    }

                    </style>
                    </div></div> <script>
        window.onload = function() {
            // Adicione esta parte ao final do seu código PHP
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function(event) {
                window.history.pushState(null, null, window.location.href);
            };
        };
    </script> 
    
    <script>
    // Adicione esta parte ao final do seu corpo HTML
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    // Impede o usuário de voltar à página anterior
    window.addEventListener('popstate', function (event) {
        window.history.pushState(null, null, window.location.href);
        window.location.href = '../painel/redirect.php'; // Redireciona para o painel
    });
</script>
    </body></html>