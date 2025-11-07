<?php
session_start();
if (!isset($_SESSION['emailadm'])) {
    header("Location: ../login");
    exit();
}
include './../../conectarbanco.php';
$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM app LIMIT 1");
$result = $result->fetch_assoc();
$google_ads_tag = $result['google_ads_tag'];
$facebook_ads_tag = $result['facebook_ads_tag'];
$facebook_meta_key = isset($result['facebook_ads_key']) ? $result['facebook_ads_key'] : '';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Admin Dashboard" />
    <meta name="description" content="Admin Dashboard" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://daanrox.com/assets/image/rox-footer.png" />
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <link href="../dist/css/style.min.css" rel="stylesheet" />
</head>

<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="navbar-brand" href="../">
                        <span class="logo-text ms-2">
                            <img src="https://daanrox.com/assets/image/daanrox-logo.png" width="100%" height="50"
                                alt="homepage" class="light-logo" />
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php include '../components/aside.php' ?>
        <style>
            #user-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            #user-table th,
            #user-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            #user-table th {
                background-color: #f2f2f2;
            }

            #user-table input[type="text"] {
                width: 80px;
                padding: 5px;
                margin: 0;
                box-sizing: border-box;
                border: none;
                background-color: transparent;
            }

            .btn-success {
                background-color: #28a745;
                color: #fff;
                border: none;
                padding: 10px 15px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 4px;
            }
        </style>
        <div class="page-wrapper">
            <div class="card">
                <div class="card-body">
                    <style>
                        .box-container {
                            display: flex;
                            flex-direction: row;
                            flex-wrap: wrap;
                            width: 100%;
                            justify-content: space-around;
                        }

                        .box {
                            border: 1px solid white;
                            padding: 20px;
                            margin: 20px 0;
                            min-width: 320px;
                            background-color: #1f262d;
                            border-radius: 15px;
                            display: block;
                        }

                        .title {
                            font-size: 20px;
                            font-weight: bold;
                            color: white;
                        }

                        .description {
                            color: #b6b7bf;
                            font-weight: 500;
                        }

                        .box-input {
                            background: #b6b7bf;
                            width: 100%;
                            height: 32px;
                            border-radius: 5px;
                            border: 1px solid #dadbe5;
                        }

                        .box-btn {
                            margin-top: 10px;
                            border-radius: 5px;
                        }
                    </style>
                    <div class="box-container">
                        <div class="box">
                            <form action='update.php?field=google_ads_tag' method='post'>
                                <p class="title">Google ADS TAG:</p>
                                <p class="description">Chave para fazer o trackeamento do seu site utilizando o google
                                    ADS.</p>
                                <input class="box-input" name="value" value="<?php echo $google_ads_tag?>" />
                                <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                            </form>
                        </div>
                        <div class="box">
                            <form action='update.php?field=facebook_ads_tag' method='post'>
                                <p class="title">Facebook ADS TAG:</p>
                                <p class="description">Chave para fazer o trackamento do seu site utilizando o facebook
                                    ADS</p>
                                <input class="box-input" name="value" value="<?php echo $facebook_ads_tag?>" />
                                <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    $conn->close();
    ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <footer class="footer text-center">
            Desenvolvido por
            <a href="http://daanrox.com/">DAANROX</a>.
        </footer>
    </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../dist/js/waves.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        $("#zero_config").DataTable();
    </script>
    <link rel="stylesheet"
        href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
    <a id="robbu-whatsapp-button" target="_blank"
        href="https://api.whatsapp.com/send?phone=5531992812273&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">
        <div class="rwb-tooltip">Entre em contato!</div>
        <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
    </a>
</body>

</html>