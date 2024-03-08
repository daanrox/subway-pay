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
    // Inicia a sessão
    session_start();

    // Verifica se 'email' está definido na sessão
    if (!isset($_SESSION['email'])) {
        header('Location: /login');
        die();
    }

    $email = $_SESSION['email'];
?>

<?php
// Iniciar ou resumir a sessão
session_start();

// Obtém o valor após o '=' na URL
$externalReference = isset($_GET['externalReference']) ? $_GET['externalReference'] : '';
$valor = isset($_GET['value']) ? $_GET['value'] : ''; // Adiciona esta linha para obter o valor da URL

// Armazena o externalReference e valor na sessão
$_SESSION['externalReference'] = $externalReference;
$_SESSION['valor'] = $valor; // Adiciona esta linha para armazenar o valor na sessão

// Obtém o email da sessão
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Define o status como pendente
$status = 'pendente';

// Se o externalReference, email e valor estiverem presentes, realiza a verificação e inserção no banco de dados
if (!empty($externalReference) && !empty($email) && !empty($valor)) {
    try {
        
        
           include './../conectarbanco.php';

        $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
        $dbuser = $config['db_user'];
        $conn = new PDO("mysql:host=localhost;dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se já existe um registro com o mesmo email e externalReference
        $stmt_check = $conn->prepare("SELECT COUNT(*) FROM confirmar_deposito WHERE email = :email AND externalreference = :externalReference");
        $stmt_check->bindParam(':email', $email);
        $stmt_check->bindParam(':externalReference', $externalReference);
        $stmt_check->execute();

        $count = $stmt_check->fetchColumn();

        if ($count == 0) {
            // Não há registro existente, pode realizar a inserção
            $stmt_insert = $conn->prepare("INSERT INTO confirmar_deposito (email, externalreference, status, valor) VALUES (:email, :externalReference, :status, :valor)");
            $stmt_insert->bindParam(':email', $email);
            $stmt_insert->bindParam(':externalReference', $externalReference);
            $stmt_insert->bindParam(':status', $status);
            $stmt_insert->bindParam(':valor', $valor); // Adiciona esta linha para inserir o valor no banco de dados
            $stmt_insert->execute();

        } else {
            // Se houver um registro existente, você pode decidir o que fazer aqui
            // Por exemplo, atualizar o valor no registro existente se necessário
        }
    } catch (PDOException $e) {
        // Trate a exceção, se necessário
        echo "Erro: " . $e->getMessage();
    }
} else {
    // Se algum dos parâmetros estiver faltando, você pode decidir o que fazer aqui
}

// Redireciona para outra página
// header('Location: ../deposito/consultarpagamento.php');
// exit();
?>


<!DOCTYPE html>


<html lang="pt-br" class="w-mod-js wf-spacemono-n4-active wf-spacemono-n7-active wf-active w-mod-ix">
<head>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>.wf-force-outline-none[tabindex="-1"]:focus {
            outline: none;
        }</style>


    <style type="text/css">.swal-icon--error {
            border-color: #f27474;
            -webkit-animation: animateErrorIcon .5s;
            animation: animateErrorIcon .5s
        }

        .swal-icon--error__x-mark {
            position: relative;
            display: block;
            -webkit-animation: animateXMark .5s;
            animation: animateXMark .5s
        }

        .swal-icon--error__line {
            position: absolute;
            height: 5px;
            width: 47px;
            background-color: #f27474;
            display: block;
            top: 37px;
            border-radius: 2px
        }

        .swal-icon--error__line--left {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            left: 17px
        }

        .swal-icon--error__line--right {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            right: 16px
        }

        @-webkit-keyframes animateErrorIcon {
            0% {
                -webkit-transform: rotateX(100deg);
                transform: rotateX(100deg);
                opacity: 0
            }
            to {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                opacity: 1
            }
        }

        @keyframes animateErrorIcon {
            0% {
                -webkit-transform: rotateX(100deg);
                transform: rotateX(100deg);
                opacity: 0
            }
            to {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                opacity: 1
            }
        }

        @-webkit-keyframes animateXMark {
            0% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }
            50% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }
            80% {
                -webkit-transform: scale(1.15);
                transform: scale(1.15);
                margin-top: -6px
            }
            to {
                -webkit-transform: scale(1);
                transform: scale(1);
                margin-top: 0;
                opacity: 1
            }
        }

        @keyframes animateXMark {
            0% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }
            50% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }
            80% {
                -webkit-transform: scale(1.15);
                transform: scale(1.15);
                margin-top: -6px
            }
            to {
                -webkit-transform: scale(1);
                transform: scale(1);
                margin-top: 0;
                opacity: 1
            }
        }

        .swal-icon--warning {
            border-color: #f8bb86;
            -webkit-animation: pulseWarning .75s infinite alternate;
            animation: pulseWarning .75s infinite alternate
        }

        .swal-icon--warning__body {
            width: 5px;
            height: 47px;
            top: 10px;
            border-radius: 2px;
            margin-left: -2px
        }

        .swal-icon--warning__body, .swal-icon--warning__dot {
            position: absolute;
            left: 50%;
            background-color: #f8bb86
        }

        .swal-icon--warning__dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-left: -4px;
            bottom: -11px
        }

        @-webkit-keyframes pulseWarning {
            0% {
                border-color: #f8d486
            }
            to {
                border-color: #f8bb86
            }
        }

        @keyframes pulseWarning {
            0% {
                border-color: #f8d486
            }
            to {
                border-color: #f8bb86
            }
        }

        .swal-icon--success {
            border-color: #a5dc86
        }

        .swal-icon--success:after, .swal-icon--success:before {
            content: "";
            border-radius: 50%;
            position: absolute;
            width: 60px;
            height: 120px;
            background: #fff;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg)
        }

        .swal-icon--success:before {
            border-radius: 120px 0 0 120px;
            top: -7px;
            left: -33px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-transform-origin: 60px 60px;
            transform-origin: 60px 60px
        }

        .swal-icon--success:after {
            border-radius: 0 120px 120px 0;
            top: -11px;
            left: 30px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-transform-origin: 0 60px;
            transform-origin: 0 60px;
            -webkit-animation: rotatePlaceholder 4.25s ease-in;
            animation: rotatePlaceholder 4.25s ease-in
        }

        .swal-icon--success__ring {
            width: 80px;
            height: 80px;
            border: 4px solid hsla(98, 55%, 69%, .2);
            border-radius: 50%;
            box-sizing: content-box;
            position: absolute;
            left: -4px;
            top: -4px;
            z-index: 2
        }

        .swal-icon--success__hide-corners {
            width: 5px;
            height: 90px;
            background-color: #fff;
            padding: 1px;
            position: absolute;
            left: 28px;
            top: 8px;
            z-index: 1;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg)
        }

        .swal-icon--success__line {
            height: 5px;
            background-color: #a5dc86;
            display: block;
            border-radius: 2px;
            position: absolute;
            z-index: 2
        }

        .swal-icon--success__line--tip {
            width: 25px;
            left: 14px;
            top: 46px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            -webkit-animation: animateSuccessTip .75s;
            animation: animateSuccessTip .75s
        }

        .swal-icon--success__line--long {
            width: 47px;
            right: 8px;
            top: 38px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-animation: animateSuccessLong .75s;
            animation: animateSuccessLong .75s
        }

        @-webkit-keyframes rotatePlaceholder {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }
            5% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }
            12% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }
            to {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }
        }

        @keyframes rotatePlaceholder {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }
            5% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }
            12% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }
            to {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }
        }

        @-webkit-keyframes animateSuccessTip {
            0% {
                width: 0;
                left: 1px;
                top: 19px
            }
            54% {
                width: 0;
                left: 1px;
                top: 19px
            }
            70% {
                width: 50px;
                left: -8px;
                top: 37px
            }
            84% {
                width: 17px;
                left: 21px;
                top: 48px
            }
            to {
                width: 25px;
                left: 14px;
                top: 45px
            }
        }

        @keyframes animateSuccessTip {
            0% {
                width: 0;
                left: 1px;
                top: 19px
            }
            54% {
                width: 0;
                left: 1px;
                top: 19px
            }
            70% {
                width: 50px;
                left: -8px;
                top: 37px
            }
            84% {
                width: 17px;
                left: 21px;
                top: 48px
            }
            to {
                width: 25px;
                left: 14px;
                top: 45px
            }
        }

        @-webkit-keyframes animateSuccessLong {
            0% {
                width: 0;
                right: 46px;
                top: 54px
            }
            65% {
                width: 0;
                right: 46px;
                top: 54px
            }
            84% {
                width: 55px;
                right: 0;
                top: 35px
            }
            to {
                width: 47px;
                right: 8px;
                top: 38px
            }
        }

        @keyframes animateSuccessLong {
            0% {
                width: 0;
                right: 46px;
                top: 54px
            }
            65% {
                width: 0;
                right: 46px;
                top: 54px
            }
            84% {
                width: 55px;
                right: 0;
                top: 35px
            }
            to {
                width: 47px;
                right: 8px;
                top: 38px
            }
        }

        .swal-icon--info {
            border-color: #c9dae1
        }

        .swal-icon--info:before {
            width: 5px;
            height: 29px;
            bottom: 17px;
            border-radius: 2px;
            margin-left: -2px
        }

        .swal-icon--info:after, .swal-icon--info:before {
            content: "";
            position: absolute;
            left: 50%;
            background-color: #c9dae1
        }

        .swal-icon--info:after {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-left: -3px;
            top: 19px
        }

        .swal-icon {
            width: 80px;
            height: 80px;
            border-width: 4px;
            border-style: solid;
            border-radius: 50%;
            padding: 0;
            position: relative;
            box-sizing: content-box;
            margin: 20px auto
        }

        .swal-icon:first-child {
            margin-top: 32px
        }

        .swal-icon--custom {
            width: auto;
            height: auto;
            max-width: 100%;
            border: none;
            border-radius: 0
        }

        .swal-icon img {
            max-width: 100%;
            max-height: 100%
        }

        .swal-title {
            color: rgba(0, 0, 0, .65);
            font-weight: 600;
            text-transform: none;
            position: relative;
            display: block;
            padding: 13px 16px;
            font-size: 27px;
            line-height: normal;
            text-align: center;
            margin-bottom: 0
        }

        .swal-title:first-child {
            margin-top: 26px
        }

        .swal-title:not(:first-child) {
            padding-bottom: 0
        }

        .swal-title:not(:last-child) {
            margin-bottom: 13px
        }

        .swal-text {
            font-size: 16px;
            position: relative;
            float: none;
            line-height: normal;
            vertical-align: top;
            text-align: left;
            display: inline-block;
            margin: 0;
            padding: 0 10px;
            font-weight: 400;
            color: rgba(0, 0, 0, .64);
            max-width: calc(100% - 20px);
            overflow-wrap: break-word;
            box-sizing: border-box
        }

        .swal-text:first-child {
            margin-top: 45px
        }

        .swal-text:last-child {
            margin-bottom: 45px
        }

        .swal-footer {
            text-align: right;
            padding-top: 13px;
            margin-top: 13px;
            padding: 13px 16px;
            border-radius: inherit;
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .swal-button-container {
            margin: 5px;
            display: inline-block;
            position: relative
        }

        .swal-button {
            background-color: #7cd1f9;
            color: #fff;
            border: none;
            box-shadow: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 24px;
            margin: 0;
            cursor: pointer
        }

        .swal-button:not([disabled]):hover {
            background-color: #78cbf2
        }

        .swal-button:active {
            background-color: #70bce0
        }

        .swal-button:focus {
            outline: none;
            box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(43, 114, 165, .29)
        }

        .swal-button[disabled] {
            opacity: .5;
            cursor: default
        }

        .swal-button::-moz-focus-inner {
            border: 0
        }

        .swal-button--cancel {
            color: #555;
            background-color: #efefef
        }

        .swal-button--cancel:not([disabled]):hover {
            background-color: #e8e8e8
        }

        .swal-button--cancel:active {
            background-color: #d7d7d7
        }

        .swal-button--cancel:focus {
            box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(116, 136, 150, .29)
        }

        .swal-button--danger {
            background-color: #e64942
        }

        .swal-button--danger:not([disabled]):hover {
            background-color: #df4740
        }

        .swal-button--danger:active {
            background-color: #cf423b
        }

        .swal-button--danger:focus {
            box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(165, 43, 43, .29)
        }

        .swal-content {
            padding: 0 20px;
            margin-top: 20px;
            font-size: medium
        }

        .swal-content:last-child {
            margin-bottom: 20px
        }

        .swal-content__input, .swal-content__textarea {
            -webkit-appearance: none;
            background-color: #fff;
            border: none;
            font-size: 14px;
            display: block;
            box-sizing: border-box;
            width: 100%;
            border: 1px solid rgba(0, 0, 0, .14);
            padding: 10px 13px;
            border-radius: 2px;
            transition: border-color .2s
        }

        .swal-content__input:focus, .swal-content__textarea:focus {
            outline: none;
            border-color: #6db8ff
        }

        .swal-content__textarea {
            resize: vertical
        }

        .swal-button--loading {
            color: transparent
        }

        .swal-button--loading ~ .swal-button__loader {
            opacity: 1
        }

        .swal-button__loader {
            position: absolute;
            height: auto;
            width: 43px;
            z-index: 2;
            left: 50%;
            top: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            text-align: center;
            pointer-events: none;
            opacity: 0
        }

        .swal-button__loader div {
            display: inline-block;
            float: none;
            vertical-align: baseline;
            width: 9px;
            height: 9px;
            padding: 0;
            border: none;
            margin: 2px;
            opacity: .4;
            border-radius: 7px;
            background-color: hsla(0, 0%, 100%, .9);
            transition: background .2s;
            -webkit-animation: swal-loading-anim 1s infinite;
            animation: swal-loading-anim 1s infinite
        }

        .swal-button__loader div:nth-child(3n+2) {
            -webkit-animation-delay: .15s;
            animation-delay: .15s
        }

        .swal-button__loader div:nth-child(3n+3) {
            -webkit-animation-delay: .3s;
            animation-delay: .3s
        }

        @-webkit-keyframes swal-loading-anim {
            0% {
                opacity: .4
            }
            20% {
                opacity: .4
            }
            50% {
                opacity: 1
            }
            to {
                opacity: .4
            }
        }

        @keyframes swal-loading-anim {
            0% {
                opacity: .4
            }
            20% {
                opacity: .4
            }
            50% {
                opacity: 1
            }
            to {
                opacity: .4
            }
        }

        .swal-overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0;
            overflow-y: auto;
            background-color: rgba(0, 0, 0, .4);
            z-index: 10000;
            pointer-events: none;
            opacity: 0;
            transition: opacity .3s
        }

        .swal-overlay:before {
            content: " ";
            display: inline-block;
            vertical-align: middle;
            height: 100%
        }

        .swal-overlay--show-modal {
            opacity: 1;
            pointer-events: auto
        }

        .swal-overlay--show-modal .swal-modal {
            opacity: 1;
            pointer-events: auto;
            box-sizing: border-box;
            -webkit-animation: showSweetAlert .3s;
            animation: showSweetAlert .3s;
            will-change: transform
        }

        .swal-modal {
            width: 478px;
            opacity: 0;
            pointer-events: none;
            background-color: #fff;
            text-align: center;
            border-radius: 5px;
            position: static;
            margin: 20px auto;
            display: inline-block;
            vertical-align: middle;
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            z-index: 10001;
            transition: opacity .2s, -webkit-transform .3s;
            transition: transform .3s, opacity .2s;
            transition: transform .3s, opacity .2s, -webkit-transform .3s
        }

        @media (max-width: 500px) {
            .swal-modal {
                width: calc(100% - 20px)
            }
        }

        @-webkit-keyframes showSweetAlert {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
            1% {
                -webkit-transform: scale(.5);
                transform: scale(.5)
            }
            45% {
                -webkit-transform: scale(1.05);
                transform: scale(1.05)
            }
            80% {
                -webkit-transform: scale(.95);
                transform: scale(.95)
            }
            to {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        @keyframes showSweetAlert {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
            1% {
                -webkit-transform: scale(.5);
                transform: scale(.5)
            }
            45% {
                -webkit-transform: scale(1.05);
                transform: scale(1.05)
            }
            80% {
                -webkit-transform: scale(.95);
                transform: scale(.95)
            }
            to {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }</style>
    <meta charset="pt-br">
    <title><?= $nomeUnico ?></title>


    <meta name="twitter:image" content="../img/logo.png">

    <meta content="summary_large_image" name="twitter:card">

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    
    

    <script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="./arquivos/page.css" rel="stylesheet" type="text/css">
    <link href="./arquivos/alert.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ["Space Mono:regular,700"]
            }
        });
    </script>
    <script type="text/javascript">
        !function (o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                .className += t + "touch")
        }(window, document);
    </script>
    <link rel="apple-touch-icon" sizes="180x180" href="../img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/logo.png">

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>


    <style>

        h1 {
            color: #333;
        }


        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            margin-top: 10px;
            border-radius: 6px;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }


        .divqr {
            align-items: center;
            padding: 20px;

            background-color: #ffffff;

        }

        .container3 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #qrcode {
            padding: 10px;
            border: 5px solid #1fbffe;
            border-radius: 10px;
        }


        #qr-code-text {
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            background-color: #e4e2e2;
            border: 2px solid #1fbffe;
            padding: 10px;
            word-break: break-all;
        }

        #copy-button {
           
            background-color: #1fbffe;
            border-radius: 6px;
            color: #fff;
            padding: 10px 80px;
            border: none;
            cursor: pointer;
            margin-top: 10px;

            animation: pulse 2s infinite;


            margin: 0 auto;
        }
        
        .redirectButton{
             background-color: #5a9759;
            border-radius: 6px;
            color: #fff;
            padding: 10px 120px;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            
        }


        .efeito-banner-topo {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            z-index: -2;
            display: block;
            width: 100%;
            height: 83%;
            max-height: 680px;
            opacity: 1;
        }

        .efeito-banner-topo img {
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            width: 120%;
            height: 120%;
            margin-top: -5%;
            background-position: 0 0, 50% 50%;
            background-size: auto, cover;
            background-repeat: repeat, no-repeat;
            opacity: 1;
            -webkit-filter: blur(24px);
            filter: blur(24px);
        }

        .img-banner-topo {
            border-radius: 0 0 10px 10px;
            /*margin: 0 auto;*/
            /*margin-right: auto;*/
            /*width: 100%;*/
            /*max-height: 500px;*/
            max-width: 1138px;
            max-height: 487px;
        }

        /*.orderbump-percent span.stats {*/
        /*    position: relative !important;*/
        /*    margin: 0 10px;*/
        /*}*/
        /*.orderbump-percent span.stats::before {*/
        /*    !*display: block !important;*!*/
        /*    position: absolute !important;*/
        /*    background-color: #50b232 !important;*/
        /*    display: inline-flex;*/
        /*    content: " ";*/
        /*    width: 124%;*/
        /*    height: 135%;*/
        /*    right: -2%;*/
        /*    top: -20%;*/
        /*}*/

        .card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            margin-top: 24px;
            box-shadow: 4px 2px 7px rgb(0 0 0 / 5%);
            /*padding: 15px 12px;*/
            position: relative;
        }

        .icon-detalhes {
            display: flex;
            color: #626262;
        }

        .icon-detalhes .icon-detalhes-icon {
            font-size: 1.5em;
            margin-right: 16px;
            display: grid;
            align-content: center;
        }

        .icon-detalhes .icon-detalhes-text h5 {
            font-size: 12px;
        }

        .rounded {
            border-radius: 10px !important;
        }

        .marginless {
            margin: 0 !important;
        }

        .paddingless {
            padding: 0 !important;
        }

        @media all and (max-width: 768px) {
            .img-banner-topo {
                max-width: 100%;
            }

            .efeito-banner-topo {
                display: none
            }
        }

        .video-player--iframe {
            border-radius: 10px
        }


        .order-bump {
            border: 2px dashed red;
            border-radius: 3px;
            margin: auto;
        }

        .order-bump-check {
            background: #F5F5F5;
            border: 1px solid #8898AA;
            box-shadow: 2px 3px 0 rgba(126, 126, 126, 0.7);
            border-radius: 3px;
        }

        .order-bump-text {
            font-size: 90%;
        }

        .card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            margin-top: 24px;
            box-shadow: 4px 2px 7px rgb(0 0 0 / 5%);
            /*padding: 15px 12px;*/
            position: relative;
        }

        .card-header {
            position: absolute;
            top: -18px;
            left: 10px;
            z-index: 10;
            padding: 0;
            margin: 0;
            text-transform: uppercase;
            background-color: transparent !important;
            border-bottom: 0 !important;
        }

        .card-header br {
            display: none;
        }

        .card-header small {
            display: none;
        }

        .card-header span.number {
            display: block !important;
            top: -4px;
            left: 0;
            color: #fff;
            background: #b8b8b8;
            padding: 3px 14px;
            border-radius: 307px;
            position: absolute;
            font-size: 22px;
            line-height: 36px;
            width: 42px;
            height: 42px;
            text-align: center;
        }

        .font-black {
            font-weight: 900 !important;
        }

        .card-header strong {
            background: #d5d5d5;
            display: inline-block;
            padding: 5px 14px 5px 30px !important;
            border-radius: 300px;
            color: #fff;
            margin-left: 18px !important;
        }

        .card-body {
            margin-top: 30px;
            padding: 15px 12px;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: #ffffff !important;
            border-top: 1px solid #eee;
        }

        label {
            font-weight: 600;
            font-size: 12px;
            color: #545454;
            text-transform: uppercase;
        }

        .flag-card:hover {
            transform: scale(1.05) !important;
            transition: .3s;
        }


        .footer-pay {
            font-size: 8px;
        }

        @media (max-width: 768px) {
            .footer-pay {
                text-align: center;
                margin: 50px auto 0 auto;
            }
        }

    </style>


    <link rel="stylesheet" href="./arquivos/css" media="all">


<body class="no-touch">


<div>
    <div data-collapse="small" data-animation="default" data-duration="400" role="banner" class="navbar w-nav">
        <div class="container w-container">


            <a href="/painel" aria-current="page" class="brand w-nav-brand" aria-label="home">
                <img src="../img/logo.png" loading="lazy" height="28" alt="" class="image-6">
                <div class="nav-link logo"><?= $nomeUnico ?></div>
            </a>
            <nav role="navigation" class="nav-menu w-nav-menu">
                <a href="../painel" class="nav-link w-nav-link" style="max-width: 940px;">Jogar</a>
                <a href="../saque" class="nav-link w-nav-link" style="max-width: 940px;">Saque</a>
                <a href="../afiliate" class="nav-link w-nav-link" style="max-width: 940px;">Indique e Ganhe</a>  

                <a href="../logout.php" class="nav-link w-nav-link" style="max-width: 940px;">Sair</a>
                <a href="../deposito" class="button nav w-button w--current">Depositar</a>
            </nav>
            <div class="w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0"
                 aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
                <div class="" style="-webkit-user-select: text;">
                    <a href="../deposito" class="menu-button w-nav-dep nav w-button w--current">DEPOSITAR</a>
                </div>
            </div>
            <div class="menu-button w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button"
                 tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
                <div class="icon w-icon-nav-menu"></div>
            </div>
        </div>
        <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
    </div>
    <div class="nav-bar">
        <a href="../painel" class="link-block rarity w-inline-block">
            <div>Jogar</div>
        </a>
        <a href="../saque" class="link-block last w-inline-block">
            <div class="text-block-8">Saque</div>
        </a>


        <a href="../logout.php" class="link-block last w-inline-block">
            <div class="text-block-8">Sair</div>
        </a>
        <a href="../deposito" class="button w-button w--current">Depositar</a>
    </div>


    <div id="deposito">
        <section id="hero" class="hero-section dark wf-section">
            <div class="minting-container w-container">
                <img src="../img/ok.webp" loading="lazy" width="240" alt="Roboto #6340" class="mint-card-image">
                <h2>BÔNUS DE DEPÓSITO VÁLIDO
                    POR ATÉ
                    <spam id="countdown">
                </h2>
                </spam>
                <p>PIX: depósitos instantâneos com uma pitada de diversão e muita praticidade. <br>
                </p>

                <script>
                    // Definindo a data alvo (5 minutos a partir do momento atual)
                    const now = new Date().getTime();
                    const targetTime = now + 5 * 60 * 1000; // 5 minutos em milissegundos

                    // Atualização do contador a cada segundo
                    const countdown = document.getElementById('countdown');
                    const x = setInterval(function () {
                        const currentTime = new Date().getTime();
                        const distance = targetTime - currentTime;

                        // Cálculos para minutos e segundos
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Exibindo o contador regressivo
                        countdown.innerHTML = minutes + ":" + seconds + " ";

                        // Condição para parar o contador quando o tempo acabar
                        if (distance < 0) {
                            clearInterval(x);
                            countdown.innerHTML = "EXPIRADO";
                            countdown.style.color = 'red';
                        }
                    }, 1000);
                </script>


                <div class="conteiner">

                    <div id="qrcode"></div>

                </div>
                
                  <div class="divqr">


                    <div id="qr-code-text" ></div>
                     <button id="copy-button">Copiar Código Pix</button>
                    
                     <br>
                     <button class="redirectButton"id="redirectButton">Paguei</button>



                </div>
                
                
                 <script>
        // Adiciona um evento de clique ao botão
        document.getElementById('redirectButton').addEventListener('click', function() {
            // Redireciona para a página desejada
            window.location.href = '../painel'; // Substitua 'sua_pagina_destino.php' pela URL da sua página de destino
        });
    </script>
                
                
                
                
                
     
    <script>
      (function(d,t) {
        var BASE_URL="https://app.chatwoot.com";
        var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=BASE_URL+"/packs/js/sdk.js";
        g.defer = true;
        g.async = true;
        s.parentNode.insertBefore(g,s);
        g.onload=function(){
          window.chatwootSDK.run({
            websiteToken: '=======',
            baseUrl: BASE_URL
          })
        }
      })(document,"script");
    </script>
    



     
                
                
         
     
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
    // Obtenha os parâmetros da URL
    const urlParams = new URLSearchParams(window.location.search);
    const pixKey = urlParams.get('pix_key');

    // Verifique se a chave PIX está presente
    if (pixKey) {
        // Crie uma instância do QRCode
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: pixKey,
            width: 256,
            height: 256
        });

        // Exiba a chave PIX abaixo do QR code
        document.getElementById('qr-code-text').innerText = "PIX Key: " + pixKey;

        // Adicione a funcionalidade de cópia do PIX Key
        document.getElementById("copy-button").addEventListener("click", function () {
            var textArea = document.createElement("textarea");
            textArea.value = pixKey; // Adicione a chave PIX como valor
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);
            alert("PIX Key copiada para a área de transferência.");
        });
    } else {
        // Caso a chave PIX não esteja presente, exiba uma mensagem de erro
        document.getElementById('qr-code-text').innerText = 'Chave PIX não encontrada.';
    }
</script>









                   
              

            </div>
        </section>
    </div>
    <div class="intermission wf-section"></div>
    <div id="about" class="comic-book white wf-section">
        <div class="minting-container left w-container">
            <div class="w-layout-grid grid-2">
                <img src="arquivos/money.png" loading="lazy" width="240" alt="Roboto #6340" class="mint-card-image v2">
                <div>
                    <h2>Indique um amigo e ganhe R$ no PIX</h2>
                    <h3>Como funciona?</h3>
                    <p>Convide seus amigos que ainda não estão na plataforma. Você receberá R$ por cada amigo que
                        se
                        inscrever e fizer um depósito. Não há limite para quantos amigos você pode convidar. Isso
                        significa que também não há limite para quanto você pode ganhar!</p>
                    <h3>Como recebo o dinheiro?</h3>
                    <p>O saldo é adicionado diretamente ao seu saldo no painel abaixo, com o qual você pode sacar
                        via
                        PIX.</p>
                    <h3>Upgrade</h3>
                    <p>No primeiro amigo que você indicar, você terá acesso ao modo ULTIMATE da nossa plataforma.
                        Você
                        poderá apostar valores maiores e ter mais chances de ganhar jogando.</p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
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
        $(document).ready(function () {
            var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function (val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };

            $('.phone-mask').mask(SPMaskBehavior, spOptions);
            $('.date-mask').mask('00/00/0000', {clearIfNotMatch: true, selectOnFocus: true});
            $('.cpf-mask').mask('000.000.000-00', {reverse: true, clearIfNotMatch: true, selectOnFocus: true});
            $('.cep-mask').mask('00000-000', {clearIfNotMatch: true, selectOnFocus: true});
            $('.creditCardDate-mask').mask('00/00', {clearIfNotMatch: true, selectOnFocus: true});
            $('.money-mask').mask("#.##0,00", {clearIfNotMatch: true, reverse: true});
            $('.percent-mask').mask("##0.0", {clearIfNotMatch: true, reverse: true});
            $(".username-mask").mask("000000000000000000000000", {"translation": {0: {pattern: /[A-Za-z0-9]/}}});
        });

    </script>
    <script type="text/javascript">
        function copyToClipboard(bt, text) {
            const elem = document.createElement('textarea');
            elem.value = text;
            document.body.appendChild(elem);
            elem.select();
            document.execCommand('copy');
            document.body.removeChild(elem);
            document.getElementById('depCopiaCodigo').innerHTML = "URL Copiada";
        }

        $('.playersOn').on('click', function () {
            $(this).toggleClass('ativo');
        });
    </script>
</div>
<iframe allow="join-ad-interest-group" data-tagging-id="AW-11305271105" data-load-time="1694530834556" height="0"
        width="0" style="display: none; visibility: hidden;"
        src="./FruitsMoney 🍓 _ Jogo da Frutinha_files/11305271105.html"></iframe>

<iframe data-product="web_widget" title="No content" role="presentation" tabindex="-1" allow="microphone *"
        aria-hidden="true" src="./FruitsMoney 🍓 _ Jogo da Frutinha_files/saved_resource.html"
        style="width: 0px; height: 0px; border: 0px; position: absolute; top: -9999px;"></iframe>
<div style="visibility: visible;">
    <div></div>
    <div>
        <style>
            @-webkit-keyframes ww-c40cdd29-7aaa-4e69-9538-973a5e1343c2-launcherOnOpen {
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

            @keyframes ww-c40cdd29-7aaa-4e69-9538-973a5e1343c2-launcherOnOpen {
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

            @keyframes ww-c40cdd29-7aaa-4e69-9538-973a5e1343c2-widgetOnLoad {
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

            @-webkit-keyframes ww-c40cdd29-7aaa-4e69-9538-973a5e1343c2-widgetOnLoad {
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

<script>
async function c() {
    const now = new Date().getTime();
    // 5 minutes
    const interval = 5 * 60 * 1000;

    while (new Date().getTime() < now + interval) {
        const params = new URLSearchParams(window.location.search);
        const token = params.get('token');
        const url = '../deposito/consultarpagamento.php?token=' + token; //<--------------COLOCAR URL
        await fetch(url)
            .then((resp) => resp.json())
            .then(function ({status}) {
                console.log(status)
                if (status === 'PAID_OUT') {
                    window.location.href = '../obrigado/';//<--------------COLOCAR URL
                }
            })
            .catch(function (error) {
                console.log(error);
            });
            await new Promise(resolve => setTimeout(resolve, 2000));
    }
}

setTimeout(c, 1000)
</script>

</body>
</html>
