<?php
session_start();
$vida_sessao = 15 * 60; // 15 minutos em segundos
session_set_cookie_params($vida_sessao);

include './../../conectarbanco.php';

try {
    $conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obter dados do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Consulta SQL para verificar o login usando consulta preparada
        $sql = "SELECT * FROM admlogin WHERE email = ? AND senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Login bem-sucedido
            $_SESSION['emailadm'] = $email;
            header("Location: ../");
            exit();
        } else {
            // Login falhou
            $erro = "Email ou senha incorretos";
        }

        $stmt->close();
    }

    $conn->close();
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>

<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="keywords" content="Dashboard"/>
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework"/>
    <meta name="robots" content="noindex,nofollow"/>
    <title>Login Admin</title>

    <link rel="icon" type="image/png" sizes="16x16" href="https://daanrox.com/assets/image/rox-footer.png"/>

    <link href="../dist/css/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="arquivos/css" media="all"
</head>

<body class='bg-dark'>
<div class="main-wrapper">
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div>
                <div class="text-center pt-3 pb-3">
                    <span class="db">
                        <img src="https://daanrox.com/assets/image/rox-footer.png" alt="logo" width="90" height="90" class="rotate-image"/>
                    </span>
                </div>

                <?php
                if (isset($erro)) {
                    echo "<p style='color:red;'>$erro</p>";
                }
                ?>
                <!-- Form -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="row pb-4">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-white h-100" id="basic-addon1">
                                        <i class="mdi mdi-account fs-4"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" id="email" aria-describedby="basic-addon1" required/>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-white h-100" id="basic-addon2">
                                        <i class="mdi mdi-lock fs-4"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control form-control-lg" placeholder="Password" id="senha" name="senha" aria-label="Password" aria-describedby="basic-addon1" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="pt-3 d-grid">
                                    <button class="btn btn-block btn-lg btn-info" type="submit">Logar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
      <a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5531992812273&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">
        <div class="rwb-tooltip">Entre em contato!</div>
        <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
      </a>
</body>
</html>
