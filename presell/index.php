<?php
include '../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT nome_unico, nome_um, nome_dois FROM app";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();


    $nomeUnico = $row['nome_unico'];
    $nomeUm = $row['nome_um'];
    $nomeDois = $row['nome_dois'];

} else {
    return false;
}

$conn->close();
?>


<?php
session_start();


?>




<?php
// Iniciar ou resumir a sessão
session_start();

// Obtém o email da sessão
$email = 'influencer@mail.com';
$saldo = 10

    ?>












<!DOCTYPE html>

<html lang="pt-br" class="w-mod-js w-mod-ix wf-spacemono-n4-active wf-spacemono-n7-active wf-active">
<script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
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
    <meta name="twitter:image" content="../img/logo.png">

    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="./arquivos/page.css" rel="stylesheet" type="text/css">



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



        <div id="saldoDiv"
            style="position: absolute; top: 100px; width: 100%; line-height: 26px; color: #fff; z-index: 10; text-align: center; margin-top: -60px;">
            SALDO: R$<b class="saldo">
                <?php echo isset($saldo) ? number_format($saldo, 2, ',', '.') : '0,00'; ?>
            </b>
        </div>









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

            <div class="minting-container w-container" style="margin-top: -40px;" >
                <div class="escudo">
                    <img src="arquivos/trophy.gif">
                </div>
                <h2>Iniciar corrida!</h2>
                <p>Pronto para iniciar mais uma corrida? Vamos fugir do policial e coletar o máximo de moedas possíveis!
                </p>
                <strong>⚠️ Não colida com os obstáculos</strong>
                <strong>❌ Não deixe o policial te pegar</strong>
                <strong>✅ Corra, Pule e Desvie-se</strong>


                <?php
                session_start();

                // Pegar o email da sessão
                $email = 'influencer@mail.com';
                $jogo_demo = 2;

                // Configurações do banco de dados
                $dbname = "u756913841_<?= $nomeUnico ?>pv";
                $dbuser = "u756913841_tki20";
                $dbpass = "Severino@123";

                ?>


                <p style="margin-top: 20px;">Você tem
                    <?php echo $jogo_demo; ?> tentativas!
                </p>

                <form data-name="" id="auth" method="post" aria-label="Form" action="jogoteste">
                    <div class="">
                        <?php if ($jogo_demo > 0): ?>
                            <input type="submit" value="Iniciar Jogo" class="botao-jogar" style='cursor: pointer'><br><br>
                        <?php else: ?>
                            <p>Todas as tentativas foram usadas.</p>
                        <?php endif; ?>
                    </div>
                </form>


                <style>
                    .botao-jogar {
                            display: inline-block;
                            padding: 16px 40px;
                            border-style: solid;
                            border-width: 4px;
                            border-color: #1f2024;
                            border-radius: 8px;
                            background-color: #ACE5D7;
                            box-shadow: -3px 3px 0 0 #1f2024;
                            -webkit-transition: background-color 200ms ease, box-shadow 200ms ease, -webkit-transform 200ms ease;
                            transition: background-color 200ms ease, box-shadow 200ms ease, -webkit-transform 200ms ease;
                            transition: background-color 200ms ease, transform 200ms ease, box-shadow 200ms ease;
                            transition: background-color 200ms ease, transform 200ms ease, box-shadow 200ms ease, -webkit-transform 200ms ease;
                            font-family: right grotesk, sans-serif;
                            color: #1f2024;
                            font-size: 1.25em;
                            text-align: center;
                            letter-spacing: .12em;
                    }
                </style>


                <i style="font-size: 10px;">Teste agora o <?= $nomeUnico ?>!</i>
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
                z-index: 1000;
            ">

                <?php
                function obterNumeroAleatorio() {
                $numeroAleatorio = rand(500, 1000);

                return $numeroAleatorio;
                }

                $numero = obterNumeroAleatorio();

                ?>


                Usuários Online:<br class="jWQDfMST8B"> <?php echo $numero; ?> </div>



        </section>
        <section id="mint" class="mint-section wf-section">
            <div class="minting-container w-container">
                <img src="arquivos/jake.gif" loading="lazy" width="240" alt="" class="mint-card-image">
                <h2><?= $nomeUnico ?></h2>
                <p class="paragraph">Bem-vindo ao mundo emocionante de <?= $nomeUnico ?>!
                    Prepare-se para uma aventura eletrizante nos trilhos, onde cada curva guarda a promessa de fortuna.
                    Desvie dos obstáculos, colete moedas reluzentes e desbloqueie novos percursos enquanto corre em
                    busca da riqueza. Sua jornada pela cidade começa agora – acelere, desfrute e acumule sua fortuna nos
                    trilhos de <?= $nomeUnico ?>!. </p>


                <a href="../painel" class="primary-button hero w-button">JOGAR AGORA</a>




                <div class="price">
                    <strong>Rodadas de boas vindas disponível</strong>
                </div>
            </div>
        </section>
        <div class="intermission wf-section">
            <div data-w-id="aa174648-9ada-54b0-13ed-6d6e7fd17602" class="center-image-block">
                <img src="arquivos/" loading="eager" alt="">
            </div>
            <div data-w-id="6d7abe68-30ca-d561-87e1-a0ecfd613036" class="center-image-block _2">
                <img src="arquivos/" loading="eager" alt="">
            </div>
            <div data-w-id="e04b4de1-df2a-410e-ce98-53cd027861f6" class="center-image-block _2">
                <img src="arquivos/" loading="eager" alt="" class="image-3">
            </div>
        </div>
    </div>
    <div id="faq" class="faq-section">
        <div class="faq-container w-container">
            <h2>faq</h2>
            <div class="question first">
                <img src="arquivos/60f988c9d3d37e14794eca22_head 25.svg" loading="lazy" width="110" alt="">
                <h3>Como funciona?</h3>
                <div><?= $nomeUnico ?> é o mais novo jogo divertido e lucrativo da galera! Lembra daquele joguinho de surfar
                    por cima dos trens que todo mundo era viciado? Ele voltou e agora dá para ganhar dinheiro de
                    verdade, mas cuidado com os obstáculos para você garantir o seu prêmio. É super simples, surf,
                    desvie dos obstáculos e colete seus prêmios.
                </div>
            </div>
            <div class="question">
                <img src="arquivos/60fa0061a0450e3b6f52e12f_Body.svg" loading="lazy" width="90" alt="">
                <h3>Como posso jogar?</h3>
                <div class="w-richtext">
                    <p>Você precisa fazer um depósito inicial na plataforma para começar a jogar e faturar.
                        Lembrando
                        que você indicando amigos, você ganhará dinheiro de verdade na sua conta bancária.</p>
                </div>
            </div>
            <div class="question">
                <img src="arquivos/61070a430f976c13396eee00_Gradient Shades.svg" loading="lazy" width="120" alt="">
                <h3>Como posso sacar? <br>
                </h3>
                <p>O saque é instantâneo. Utilizamos a sua chave PIX como CPF para enviar o pagamento, é na hora e
                    no
                    PIX. 7 dias por semana e 24 horas por dia. <br>
                </p>
            </div>
            <div class="question">
                <img src="arquivos/60fa004b7690e70dded91f9a_light.svg" loading="lazy" width="80" alt="">
                <h3>É tipo foguetinho?</h3>
                <div>
                    <b>Não</b>! <?= $nomeUnico ?> é totalmente diferente, basta apenas estar atento para desviar dos
                    obstáculos na hora certa. Não existe sua sorte em jogo, basta ter foco e completar o percurso
                    até resgatar o máximo de moedas que conseguir.
                </div>
            </div>
            <div class="question">
                <img src="arquivos/60f8d0c69b41fe00d53e8807_Helmet.svg" loading="lazy" width="90" alt="">
                <h3>Existem eventos?</h3>
                <div class="w-richtext">
                    <ul role="list">
                        <li>
                            <strong>Jogatina</strong>. Quanto mais você correr, mais moedas você coleta e mais
                            dinheiro você ganha. Mas cuidado! Há trens escondidas entre as
                            ruas.
                        </li>
                        <li>
                            <strong>Torneios</strong>. Além disso, você pode competir com outros jogadores em
                            torneios e
                            desafios diários para ver quem consegue a maior pontuação e fatura mais dinheiro. A
                            emoção
                            da competição e a chance de ganhar grandes prêmios adicionam uma camada extra de
                            adrenalina
                            ao jogo.
                        </li>
                    </ul>
                    <p>Clique <a href="https://t.me/">aqui</a> e acesse nosso grupo no Telegram
                        para
                        participar de eventos exclusivos. </p>
                </div>
            </div>
            <div class="question last">
                <img src="arquivos/60f8d0c657c9a88fe4b40335_Exploded Head.svg" loading="lazy" width="72" alt="">
                <h3>Dá para ganhar mais?</h3>
                <div class="w-richtext">
                    <p>Chame um amigo para jogar e após o depósito e a primeira partida será creditado em sua conta
                        R$5
                        para sacar a qualquer momento. </p>
                    <ol role="list">
                        <li>O saldo é adicionado diretamente ao seu saldo em dinheiro, com o qual você pode jogar ou
                            sacar. </li>
                        <li>Seu amigo deve se inscrever através do seu link de convite pessoal. </li>
                        <li>Seu amigo deve ter depositado pelo menos R$25.00 BRL para receber o prêmio do convite.
                        </li>
                        <li>Você não pode criar novas contas na <?= $nomeUnico ?> e se inscrever através do seu próprio link
                            para receber a recompensa. O programa Indique um Amigo é feito para nossos jogadores
                            convidarem amigos para a plataforma <?= $nomeUnico ?>. Qualquer outro uso deste programa é
                            estritamente proibido. </li>
                    </ol>
                    <p>‍</p>
                </div>
            </div>
        </div>
        <div class="faq-left">
            <img src="arquivos/60f988c7c856f076b39f8fa4_head 04.svg" loading="eager" width="238.5" alt=""
                class="faq-img" style="opacity: 0;">
            <img src=".arquivos/60f988c9402afc1dd3f629fe_head 26.svg" loading="eager" width="234" alt=""
                class="faq-img _1" style="opacity: 0;">
            <img src="arquivos/60f988c9bc584ead82ad8416_head 29.svg" loading="lazy" width="234" alt=""
                class="faq-img _2" style="opacity: 0;">
            <img src="arquivos/60f988c913f0ba744c9aa13e_head 27.svg" loading="lazy" width="234" alt=""
                class="faq-img _3" style="opacity: 0;">
            <img src="arquivos/60f988c9d3d37e14794eca22_head 25.svg" loading="lazy" width="234" alt=""
                class="faq-img _1" style="opacity: 0;">
            <img src="arquivos/60f988c98b7854f0327f5394_head 24.svg" loading="lazy" width="234" alt=""
                class="faq-img _2" style="opacity: 0;">
            <img src="arquivos/60f988c82f5c199c4d2f6b9f_head 05.svg" loading="lazy" width="234" alt=""
                class="faq-img _3" style="opacity: 0;">
        </div>
        <div class="faq-right">
            <img src="arquivos/60f988c88b7854b5127f5393_head 23.svg" loading="eager" width="238.5" alt=""
                class="faq-img" style="opacity: 0;">
            <img src="arquivos/60f988c8bf76d754b9c48573_head 12.svg" loading="eager" width="234" alt=""
                class="faq-img _1" style="opacity: 0;">
            <img src="arquivos/60f988c8f2b58f55b60d858f_head 21.svg" loading="lazy" width="234" alt=""
                class="faq-img _2" style="opacity: 0;">
            <img src="arquivos/60f988c8e83a994a38909bc4_head 22.svg" loading="lazy" width="234" alt=""
                class="faq-img _3" style="opacity: 0;">
            <img src="arquivos/60f988c8a97a7c125d72046d_head 20.svg" loading="lazy" width="234" alt=""
                class="faq-img _1" style="opacity: 0;">
            <img src="arquivos/60f988c8fbbbfe5fc68169e0_head 14.svg" loading="lazy" width="234" alt=""
                class="faq-img _2" style="opacity: 0;">
            <img src="arquivos/60f988c88b7854b35e7f5390_head 18.svg" loading="lazy" width="234" alt=""
                class="faq-img _3" style="opacity: 0;">
        </div>
        <div class="faq-bottom">
            <img src="arquivos/60f988c8ba5339712b3317c0_head 16.svg" loading="lazy" width="234" alt=""
                class="faq-img _3" style="opacity: 0;">
            <img src="arquivos/60f988c86e8603bce1c16a98_head 17.svg" loading="lazy" width="234" alt="" class="faq-img"
                style="opacity: 0;">
            <img src="arquivos/60f988c889b7b12755035f2f_head 19.svg" loading="lazy" width="234" alt=""
                class="faq-img _1" style="opacity: 0;">
        </div>
        <div class="faq-top">
            <img src="arquivos/60f988c8a97a7ccf6f72046a_head 11.svg" loading="eager" width="234" alt=""
                class="faq-img _3" style="opacity: 0;">
            <img src="arquivos/60f988c7fbbbfed6f88169df_head 02.svg" loading="eager" width="234" alt="" class="faq-img"
                style="opacity: 0;">
            <img src="arquivos/60f8dbc385822360571c62e0_icon-256w.png" loading="eager" width="234" alt=""
                class="faq-img _1" style="opacity: 0;">
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




    <div id="imageDownloaderSidebarContainer">
        <div class="image-downloader-ext-container">
            <div tabindex="-1" class="b-sidebar-outer"><!---->
                <div id="image-downloader-sidebar" tabindex="-1" role="dialog" aria-modal="false" aria-hidden="true"
                    class="b-sidebar shadow b-sidebar-right bg-light text-dark" style="width: 500px; display: none;">
                    <!---->
                    <div class="b-sidebar-body">
                        <div></div>
                    </div><!---->
                </div><!----><!---->
            </div>
        </div>
    </div>
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
        </div>
    </div>
</body>

</html>