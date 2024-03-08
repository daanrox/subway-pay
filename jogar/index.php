<!DOCTYPE html>

<?php 
session_start();

include './../config.php';

?>
<html lang="en">

<head>

    
<script>
        let statusPage = localStorage.getItem('realBetPage');
        if (statusPage === 'false'){
            window.location.href = '../painel/';
            
        }
        
        
        
        window.addEventListener('pageshow', function (event) {
    // Verificar o localStorage quando a página for exibida ou recarregada
    var statusPage2 = localStorage.getItem("realBetPage");

    if (statusPage2 === "false") {
        window.location.href = '../painel/';
    }
    
    if(!statusPage2){
        window.location.href= '../painel/';
    }
});
        
</script>
    
    <script type="text/javascript">

        function extrairvalorAposta() {

            var url = window.location.href;

            var match = url.match(/jogarsubway=(\d+BC)/);

            if (match) {

                var valorAposta = match[1];

                var valorMapeado;
                switch (valorAposta) {
                    case '1BC':
                        valorMapeado = 1;
                        break;
                    case '2BC':
                        valorMapeado = 2;
                        break;
                    case '3BC':
                        valorMapeado = 5;
                        break;
                    default:
                        valorMapeado = 1;
                }

                return valorMapeado;
            }


            return 1;
        }


        var valorAposta = extrairvalorAposta();


        const aposta = extrairvalorAposta();


    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport"
        content="height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui, viewport-fit=cover" />
    <link rel="manifest" href="subwaysurfers.webmanifest">
    <link rel="icon" href="assets/images/app-icon-16.png" type="image/png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/app-icon-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/app-icon-72.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/images/app-icon-57.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/app-icon-57.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="robots" content="noindex,nofollow" />
    <title><?php echo $title_site; ?></title>
    <style>
        body,
        html {
            margin: 0;
            height: 100%;
            background-color: #0b316b;
            overflow: hidden;
            background-image: url('assets/preload/splash.png');
            background-repeat: no-repeat;
            background-position: center;
        }

        #message {
            text-align: center;
            font-size: 8px;
            z-index: 5;
            font-family: "Verdana", sans-serif;
            color: #fff;
            position: fixed;
            width: 100%;
            z-index: 9999;
        }

        .dot {
            display: inline;
            margin-left: 0.2em;
            margin-right: 0.2em;
            position: relative;
            top: -1em;
            font-size: 3.5em;
            opacity: 0;
            animation: showHideDot 2.5s ease-in-out infinite;
        }

        .dot.one {
            animation-delay: 0.2s;
        }

        .dot.two {
            animation-delay: 0.4s;
        }

        .dot.three {
            animation-delay: 0.6s;
        }

        @keyframes showHideDot {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            60% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        button#sair {
            position: absolute;
            display: none;
            top: 135px;
            left: calc(50% - 130px);
            padding:.85rem 2.8rem;
            line-height: 32px;
            font-size: 18px;
            text-align: center;
            font-weight:700;
            color: white;
            background-color: #1fbffe;
            box-shadow:-3px 3px 0 0 #1f2024;
            border:4px solid #1f2024;
            border-radius:8px;
            transition:background-color .2s ease,transform .2s ease,box-shadow .2s ease;
            z-index: 100000;
        }
    </style>
</head>

<body>
    <button id="sair">ENCERRAR APOSTA</button>
    <script>
        window.NOSW = true;
        window.GAME_CONFIG = {
            leaderboard: 'mockup',
            bundlesPath: './bundles',
        }
    </script>
    <div id="message">
        <h1>Loading</h1>
        <h1 class="dot one">.</h1>
        <h1 class="dot two">.</h1>
        <h1 class="dot three">.</h1>
    </div>
    <script src="js/loading.js"></script>
    <script src="js/boot.js?v=<?php echo time(); ?>"></script>
    <script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
</body>

</html>