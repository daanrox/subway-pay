<?php
session_start();


?>




<?php
// Iniciar ou resumir a sessão
session_start();

// Obtém o email da sessão
$email = 'influencer@mail.com';
$saldo = 1

    ?>


<?php
if (isset($_POST['msg'])) {
    $valor = $_POST['msg'];

    if ($valor === 0 || $valor === null || $valor === '') {
        $valor = 0.00;
    }
}
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
    <title>SubwayPay 🌊 </title>
    <meta property="og:image" content="../img/logo.png">
    <meta content="SubwayPay 🌊" property="og:title">
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








    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 100;
        }


        .popup-content {
            margin-bottom: 20px;
        }

        .popup-button {
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
            letter-spacing: .12em cursor: pointer;
            transition: background-color 0.3s;
        }

        .popup-button:hover {
            background-color: #0f9bd8;
        }
    </style>

    <div class="overlay" id="overlay"></div>
    <div id="popup" class="minting-container w-container"
        style=" z-index: 200; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="popup-content">
            <h2 class="win-warn" style="display: flex;">Excelente!</h2>
            <p>Parabéns campeão, você ganhou <strong>R$
                    <?php echo $valor; ?>
                </strong> de Bônus no seu Primeiro deposito </p>
            <p>Continue assim, <strong>faça seu cadastro!</strong></p>
        </div>
        <button class="popup-button" onclick="closePopup()">OK</button>
    </div>





    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
        });

        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }
    </script>










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
                <h2>VAMOS JOGAR COM DINHEIRO REAL?</h2>
                <p class="win-warn"><strong>Uau! Continue assim, ganhou R$
                        <?php echo $valor; ?>
                    </strong>
                </p>
                <p>Para aproveitar o seu Bônus você precisa criar sua conta e depósitar um valor minimo. #ficadica!</p>
                <strong style="margin-top: 20px"> ⬇️ Clique no Botão Abaixo</strong>

                <a href="../cadastrar/" class="cadastro-btn">CADASTRAR</a>

                <style>
                    .win-warn {
                        color: #22C55E;
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

                    </st></div></div></body></html>