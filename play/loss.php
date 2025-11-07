<?php
session_start();
include "./../config.php";
include "./../conectarbanco.php";

$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";

$betValues = [
    "1BC" => 1.0,
    "2BC" => 2.0,
    "3BC" => 5.0,
];

$bet =
    isset($_GET["bet"]) && isset($betValues[$_GET["bet"]])
        ? $betValues[$_GET["bet"]]
        : 0.0;

if (isset($_GET["msg"])) {
    $valor = $_GET["msg"];

    if ($valor === 0 || $valor === null || $valor === "") {
        $valor = 0.0;
    }

    if ($email) {
        $conn = new mysqli(
            "localhost",
            $config["db_user"],
            $config["db_pass"],
            $config["db_name"]
        );

        if ($conn->connect_error) {
            die(
                "Erro na conexão com o banco de dados: " . $conn->connect_error
            );
        }

        $saldoQuery = "SELECT saldo FROM appconfig WHERE email = '$email'";
        $saldoResult = $conn->query($saldoQuery);

        if ($saldoResult) {
            $row = $saldoResult->fetch_assoc();
            $saldoAtual = $row["saldo"];

            $novoSaldo = $saldoAtual - $bet;

            $updateQuery = "UPDATE appconfig SET saldo = $novoSaldo WHERE email = '$email'";
            $updateResult = $conn->query($updateQuery);

            if (!$updateResult) {
                echo "Erro ao atualizar o saldo: " . $conn->error;
            }
        } else {
            echo "Erro ao obter o saldo: " . $conn->error;
        }

        $conn->close();
    }
}
?>

<?php
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";

if ($email) {
    $conn = new mysqli(
        "localhost",
        $config["db_user"],
        $config["db_pass"],
        $config["db_name"]
    );

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $percasQuery = "SELECT percas FROM appconfig WHERE email = '$email'";
    $percasResult = $conn->query($percasQuery);

    if ($percasResult) {
        $row1 = $percasResult->fetch_assoc();
        $percasAtual = $row1["percas"];

        $percas = floatval($percasAtual) + floatval($bet);

        $updatePercasQuery = "UPDATE appconfig SET percas = $percas WHERE email = '$email'";
        $updatePercasResult = $conn->query($updatePercasQuery);

        if (!$updatePercasResult) {
            echo "Erro ao atualizar percas: " . $conn->error;
        }
    } else {
        echo "Erro ao obter percas: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Email não está definido.";
}
?>



<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../");
    exit();
}
?>
<?php
session_start();
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
if (!empty($email)) {
    try {
        include "./../conectarbanco.php";
        $conn = new mysqli(
            "localhost",
            $config["db_user"],
            $config["db_pass"],
            $config["db_name"]
        );
        $dbuser = $config["db_user"];
        $conn = new PDO(
            "mysql:host=localhost;dbname={$config["db_name"]}",
            $config["db_user"],
            $config["db_pass"]
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare(
            "SELECT * FROM confirmar_deposito WHERE email = :email AND status = 'pendente'"
        );
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stmtPix = $conn->prepare(
                "SELECT * FROM pix_deposito WHERE code = :externalReference"
            );
            $stmtPix->bindParam(
                ":externalReference",
                $result["externalreference"]
            );
            $stmtPix->execute();
            $resultPix = $stmtPix->fetch(PDO::FETCH_ASSOC);
            if ($resultPix !== false) {
                $updateStmt = $conn->prepare(
                    "UPDATE confirmar_deposito SET status = 'aprovado' WHERE externalreference = :externalReference"
                );
                $updateStmt->bindParam(
                    ":externalReference",
                    $result["externalreference"]
                );
                $updateStmt->execute();
                $valorCorrespondencia = $resultPix["value"];
                $updateSaldoStmt = $conn->prepare(
                    "UPDATE appconfig SET saldo = saldo + :valorCorrespondencia, depositou = depositou + :valorCorrespondencia WHERE email = :email"
                );
                $updateSaldoStmt->bindParam(
                    ":valorCorrespondencia",
                    $valorCorrespondencia
                );
                $updateSaldoStmt->bindParam(":email", $email);
                $updateSaldoStmt->execute();
                header("Location: ../obrigado");
                break;
            }
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
}
?>

<?php
include "./../conectarbanco.php";
$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $consulta_saldo = "SELECT saldo FROM appconfig WHERE email = '$email'";
    $resultado_saldo = $conn->query($consulta_saldo);
    if ($resultado_saldo) {
        if ($resultado_saldo->num_rows > 0) {
            $row = $resultado_saldo->fetch_assoc();
            $saldo = $row["saldo"];
        }
    }
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
    <title>
        <?php echo $title_site; ?>
    </title>
    <meta property="og:image" content="../img/logo.png">
    <meta content="<?php echo $title_site; ?>" property="og:title">
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


    <link rel="stylesheet" href="../arquivos/css" media="all">


</head>

<body>



    <div>


        <section id="hero" class="hero-section dark wf-section"
            style="background-image: url('/af835635b84ba0916d7c0ddd4e0bd25b.jpg') !important; background-attachment: fixed !important; background-position: center; background-size: cover;">

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
                    <img src="https://raw.githubusercontent.com/daanrox/subway-pay/main/assets/img/user/trophy.gif">
                </div>
                <h2>VOCÊ PERDEU</H2>
                <h2>NÃO DESANIME!</h2>

                <p>A persistência é a chave para o sucesso, não deixe isso te por pra baixo. #ficadica!</p>
                <strong style="margin-top: 20px"> ⬇️ Clique no Botão Abaixo para Jogar Novamente</strong>

                <a href="../painel/" class="cadastro-btn">JOGAR</a>

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
                    $numeroAleatorio = rand(16, 22);

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
            </div>
        </div>
</body>

</html>