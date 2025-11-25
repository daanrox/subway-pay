<?php
ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

session_start();


function validateForm($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

include "../conectarbanco.php";

$conn = new mysqli(
    "localhost",
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

if ($conn->connect_error) {
    $errorMsg = "Erro na conexão com o banco de dados: " . $conn->connect_error;
    die($errorMsg);
}

$sql = "SELECT nome_unico, nome_um, nome_dois, cpa, revenue_share FROM app LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nomeUnico = $row["nome_unico"];
    $nomeUm = $row["nome_um"];
    $nomeDois = $row["nome_dois"];
    $cpa = $row["cpa"];
    $plano = $row["revenue_share"];
} else {
    $nomeUnico = "Sistema";
    $nomeUm = "Nome Um";
    $nomeDois = "Nome Dois";
    $cpa = 0;
    $plano = "basic";
}

$baseUrl = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
$callbackUrl = $baseUrl . "/cadastrar/?aff=";

function idExists($id, $conn)
{
    $checkIdQuery = "SELECT id FROM appconfig WHERE id = ?";
    $checkIdStmt = $conn->prepare($checkIdQuery);
    $checkIdStmt->bind_param("s", $id);
    $checkIdStmt->execute();
    $checkIdStmt->store_result();
    $exists = $checkIdStmt->num_rows > 0;
    $checkIdStmt->close();
    return $exists;
}

function emailExists($email, $conn)
{
    $checkEmailQuery = "SELECT email FROM appconfig WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();
    $exists = $checkEmailStmt->num_rows > 0;
    $checkEmailStmt->close();
    return $exists;
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = validateForm($_POST["email"]);
    $senha = validateForm($_POST["senha"]);
    $confirmarSenha = validateForm($_POST["password_confirmation"]);
    $telefone = validateForm($_POST["telefone_confirmation"]);
    $leadAff = isset($_POST["lead_aff"]) ? validateForm($_POST["lead_aff"]) : "";
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "E-mail inválido.";
    } elseif ($senha !== $confirmarSenha) {
        $errorMessage = "As senhas não coincidem.";
    } elseif (strlen($senha) < 6) {
        $errorMessage = "A senha deve ter pelo menos 6 caracteres.";
    } elseif (emailExists($email, $conn)) {
        $errorMessage = "Já existe uma conta com esse e-mail.";
    } else {
        
        $getNextIdQuery = "SELECT MAX(CAST(id AS UNSIGNED)) AS max_id FROM appconfig";
        $nextIdResult = $conn->query($getNextIdQuery);
        if ($nextIdResult) {
            $nextIdRow = $nextIdResult->fetch_assoc();
            $nextId = ($nextIdRow["max_id"] ?? 0) + 1;
        } else {
            $nextId = 1;
        }

        while (idExists($nextId, $conn)) {
            $nextId++;
        }

        $saldo = "0";
        $saldo_comissao = "0";
        $linkAfiliado = $callbackUrl . $nextId;
        
        $dataCadastro = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
        $dataCadastroFormatada = $dataCadastro->format("d-m-Y H:i");
        
        $afiliado = isset($_GET["aff"]) ? $_GET["aff"] : "";
        

        $insertQuery = "INSERT INTO appconfig (id, cpa, email, senha, telefone, saldo, lead_aff, linkafiliado, indicados, plano, saldo_comissao, data_cadastro, afiliado) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, '0', ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insertQuery);
        
        if ($stmt) {            
            $stmt->bind_param(
                "ssssssssssss",
                $nextId,
                $cpa,
                $email,
                $senha,
                $telefone,
                $saldo,
                $leadAff,
                $linkAfiliado,
                $plano,
                $saldo_comissao,
                $dataCadastroFormatada,
                $afiliado
            );
            
            if ($stmt->execute()) {
                $_SESSION["email"] = $email;
                $_SESSION["user_id"] = $nextId;
                
                header("Location: /deposito");
                exit();
            } else {
                $errorMessage = "Erro ao cadastrar usuário: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = "Erro ao preparar a consulta: " . $conn->error;
        }
        if (isset($nextIdResult)) {
            $nextIdResult->close();
        }
    }
}
?>

<!DOCTYPE html>

<html lang="pt-br" class="w-mod-js wf-spacemono-n4-active wf-spacemono-n7-active wf-active w-mod-ix">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        .wf-force-outline-none[tabindex="-1"]:focus {
            outline: none;
        }
    </style>
    <meta charset="pt-br">
    <title>
        <?= $nomeUnico ?> 🌊
    </title>
    <meta property="og:image" content="../img/logo.png">
    <meta content="<?= $nomeUnico ?> 🌊" property="og:title">
    <meta name="twitter:image" content="../img/logo.png">
    <meta content="<?= $nomeUnico ?> 🌊" property="twitter:title">
    <meta property="og:type" content="website">
    <meta content="summary_large_image" name="twitter:card">
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
    <link rel="apple-touch-icon" sizes="180x180" href="../img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/logo.png">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <style>
        .notification-container {
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            text-align: center;
        }
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }
        .success-message {
            background-color: #e8f5e8;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
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
</head>

<body>
    <div>
        <div data-collapse="small" data-animation="default" data-duration="400" role="banner" class="navbar w-nav">
            <div class="container w-container">
                <a href="../" aria-current="page" class="brand w-nav-brand" aria-label="home">
                    <img src="arquivos/l2.png" loading="lazy" height="28" alt="" class="image-6">
                    <div class="nav-link logo">
                        <?= $nomeUnico ?>
                    </div>
                </a>
                <nav role="navigation" class="nav-menu w-nav-menu">
                    <a href="../login/" class="nav-link w-nav-link" style="max-width: 940px;">Jogar</a>
                    <a href="../login/" class="nav-link w-nav-link" style="max-width: 940px;">Login</a>
                    <a href="../cadastrar/" class="button nav w-button w--current">Cadastrar</a>
                </nav>
                <script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var menuButton = document.querySelector('.menu-button');
                        var navBar = document.querySelector('.nav-bar');

                        menuButton.addEventListener('click', function () {
                            if (navBar.style.display === 'block') {
                                navBar.style.display = 'none';
                            } else {
                                navBar.style.display = 'block';
                            }
                        });
                    });
                </script>
                <div class="w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button"
                    tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
                </div>
                <div class="menu-button w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button"
                    tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
                    <div class="icon w-icon-nav-menu"></div>
                </div>
            </div>
            <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
        </div>
        <div class="nav-bar">
            <a href="../login/" class="button w-button w--current">
                <div>Jogar</div>
            </a>
            <a href="../login/" class="button w-button w--current">
                <div>Login</div>
            </a>
            <a href="../cadastrar/" class="button w-button w--current">Cadastrar</a>
        </div>
        <section id="hero" class="hero-section dark wf-section"
            style="background-image: url('/af835635b84ba0916d7c0ddd4e0bd25b.jpg') !important; background-attachment: fixed !important; background-position: center; background-size: cover;">
            <div class="minting-container w-container">
                <img src="arquivos/Kcykfsq.png" loading="lazy" width="240"
                    data-w-id="6449f730-ebd9-23f2-b6ad-c6fbce8937f7" alt="Roboto #6340" class="mint-card-image">
                <h2>CADASTRO</h2>
                <p>É rapidinho, menos de 1 minuto. <br>Vai perder a oportunidade de faturar com o jogo do surfista?
                    <br>
                </p>

                <?php 
                if (!empty($errorMessage)) {
                    echo '<div class="notification-container error-message">' .
                        $errorMessage .
                        "</div>";
                } elseif (!empty($successMessage)) {
                    echo '<div class="notification-container success-message">' .
                        $successMessage .
                        "</div>";
                } ?>

                <form method="POST" action="">
                    <div class="properties">
                        <h4 class="rarity-heading">E-mail</h4>
                        <div class="rarity-row roboto-type2">
                            <input type="e-mail" class="large-input-field w-input" maxlength="256" name="email"
                                placeholder="seuemail@gmail.com" id="email" required value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                        </div>
                        <h4 class="rarity-heading">Telefone</h4>
                        <div class="rarity-row roboto-type2">
                            <input type="tel" class="large-input-field w-input" maxlength="15" minlength: "15"
                                name="telefone_confirmation" placeholder="(XX) 9XXXX-XXXX" id="telefone_confirmation"
                                required value="<?= isset($_POST['telefone_confirmation']) ? $_POST['telefone_confirmation'] : '' ?>">
                        </div>
                        <h4 class="rarity-heading">Senha</h4>
                        <div class="rarity-row roboto-type2">
                            <input type="password" class="large-input-field w-input" maxlength="256" name="senha"
                                data-name="password" placeholder="Uma senha segura" id="senha" required>
                        </div>
                        <h4 class="rarity-heading">Confirme sua Senha</h4>
                        <div class="rarity-row roboto-type2">
                            <input type="password" class="large-input-field w-input" maxlength="256"
                                name="password_confirmation" data-name="password" placeholder="Confirme sua senha"
                                id="password_confirmation" required>

                            <input type="hidden" name="lead_aff" id="lead_aff" value="<?= isset($_GET['aff']) ? $_GET['aff'] : '' ?>">
                        </div>
                        <br>
                        <input type="checkbox" onclick="mostrarSenha()"> Mostrar senha
                    </div>

                    <script>
                        function mostrarSenha() {
                            var senhaInput = document.getElementById('senha');
                            var confirmInput = document.getElementById('password_confirmation');
                            if (senhaInput.type === 'password') {
                                senhaInput.type = 'text';
                                confirmInput.type = 'text';
                            } else {
                                senhaInput.type = 'password';
                                confirmInput.type = 'password';
                            }
                        }

                        document.addEventListener('DOMContentLoaded', function () {
                            const urlParams = new URLSearchParams(window.location.search);
                            const leadAff = urlParams.get('aff');
                            document.getElementById('lead_aff').value = leadAff;
                        });
                    </script>

                    <div class="">
                        <button type="submit" class="primary-button w-button">
                            <i class="fa fa-check fa-fw"></i>
                            Criar Conta
                        </button><br>
                        <p class="medium-paragraph _3-2vw-margin">Ao registrar você concorda com os
                            <a href="../terms">termos de serviço</a> e que possui pelo menos 18 anos.
                        </p>
                    </div>
                </form>
            </div>
        </section>
        <div class="intermission wf-section"></div>
        <div id="rarity" class="rarity-section wf-section">
            <div class="minting-container left w-container">
                <div class="w-layout-grid grid-2">
                    <div>
                        <h2>💸 Tudo via PIX &amp; na hora. 🔥</h2>
                        <p>Seu dinheiro cai na hora na sua conta bancária, sem burocracia e sem taxas.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-section wf-section">
            <div class="domo-text">
                <?= $nomeUm ?> <br>
            </div>
            <div class="domo-text purple">
                <?= $nomeDois ?> <br>
            </div>
            <div class="follow-test">© Copyright xlk Limited, with registered offices at Dr. M.L. King Boulevard 117,
                accredited by license GLH-16289876512. </div>
            <div class="follow-test">
                <a href="/legal">
                    <strong class="bold-white-link">Termos de uso</strong>
                </a>
            </div>
            <div class="follow-test">contato@
                <?php
          $nomeUnico = strtolower(str_replace(" ", "", $nomeUnico));
          echo $nomeUnico;
          ?>.com
            </div>
        </div>
    </div>
    <div id="imageDownloaderSidebarContainer">
        <div class="image-downloader-ext-container">
            <div tabindex="-1" class="b-sidebar-outer">
                <div id="image-downloader-sidebar" tabindex="-1" role="dialog" aria-modal="false" aria-hidden="true"
                    class="b-sidebar shadow b-sidebar-right bg-light text-dark" style="width: 500px; display: none;">
                    <div class="b-sidebar-body">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="visibility: visible;">
        <div></div>
        <div>
            <style>
                @-webkit-keyframes ww-51fbc3b8-5830-4bee-ad15-8955338512d0-launcherOnOpen {
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
                @keyframes ww-51fbc3b8-5830-4bee-ad15-8955338512d0-launcherOnOpen {
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
                @keyframes ww-51fbc3b8-5830-4bee-ad15-8955338512d0-widgetOnLoad {
                    0% {
                        opacity: 0;
                    }
                    100% {
                        opacity: 1;
                    }
                }
                @-webkit-keyframes ww-51fbc3b8-5830-4bee-ad15-8955338512d0-widgetOnLoad {
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
        document.addEventListener('DOMContentLoaded', function () {
            var telefoneInput = document.getElementById('telefone_confirmation');

            if (telefoneInput) {
                telefoneInput.addEventListener('input', function (e) {
                    var value = e.target.value.replace(/\D/g, '');
                    if (value.length > 11) value = value.substring(0, 11);
                    
                    if (value.length > 0) {
                        if (value.length <= 2) {
                            value = '(' + value;
                        } else if (value.length <= 7) {
                            value = '(' + value.substring(0, 2) + ') ' + value.substring(2);
                        } else if (value.length <= 11) {
                            value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 7) + '-' + value.substring(7);
                        }
                    }
                    
                    e.target.value = value;
                });
            }
        });
    </script>
</body>
</html>
