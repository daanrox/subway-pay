<?php
session_start();

// Verificar se a sessão existe
if (!isset($_SESSION['emailadm'])) {
    // Sessão não existe, redirecionar para outra página
    header("Location: login");
    exit();
}

  function get_conn()
{
    $dbname = "u574069177_frutinhamoney";
    $dbuser = "u574069177_tki3";
    $dbpass = "Severino@123";

    return new mysqli('localhost', $dbuser, $dbpass, $dbname);
}

$conn = get_conn();
$sql = "SELECT * FROM integracao_chaves";
$result2 = $conn->query($sql);
$result = $result2->fetch_assoc();


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Admin Dashboard" />
    <meta name="description" content="Admin Dashboard" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Admin Dashboard</title>

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="../libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />



    <style>
        .text-yellow {
            color: yellow;
            font-size: 25px;
        }

        .text-white2 {
            color: aliceblue;
            font-size: 25px;
        }

        .text-green {
            color: rgb(15, 222, 15);
            font-size: 25px;
        }

        .text-red {
            color: red;
            font-size: 25px;
        }


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
        
        .row{
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .card-body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 5vw auto;
        }

        .container3 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }



        #qr-code-text {
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            padding: 10px;
            word-break: break-all;
        }

        #qrcode {
            margin-left: 60px;
            padding: 10px;

            border-radius: 10px;
        }




        h4 {
            display: inline-block;
            margin-right: 5px;
            /* Adiciona um espaço entre os elementos, se necessário */
            font-size: 25px;
            color: yellow;
        }

        h5 {
            display: inline-block;
            margin-right: 5px;
            /* Adiciona um espaço entre os elementos, se necessário */
            font-size: 25px;
            color: rgb(255, 255, 255);
        }
    </style>

</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="../">
                        <!-- Logo icon -->
                        <b class="logo-icon ps-2">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo-icon.png " alt="homepage" class="light-logo" width="25" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text ms-2">
                            <!-- dark Logo text -->
                            <img src="../assets/images/logo-text.png" width="150" height="50" alt="homepage"
                                class="light-logo" />
                        </span>

                    </a>

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                        </li>



                    </ul>
                </div>
            </nav>
        </header>
        <!-- ==========    MENU    =================== -->
        <?php include '../components/aside.php' ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">

                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">

                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <form action="alterarchaves.php" method="post" class="form-horizontal">
                            <div class="card-body">
                                <h3 class="card-title">Insira a Chave da API de Pagamento</h3>
                                <div class="form-group row">
                                    <label for="valor"
                                        class="col-sm-3 text-end control-label col-form-label">Access Key: </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="access_key" value="<?php echo $result['access_key'] ?>" class="form-control" id="access_key" placeholder="Digite a sua chave de acesso" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cpf" class="col-sm-3 text-end control-label col-form-label">Secret Key: </label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $result['secret_key'] ?>" name="secret_key" class="form-control" id="secret_key" placeholder="Digite a sua chave secreta" />
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-secondary btn-lg"
                                    onclick="atualizarChave()">Atualizar Chave</button>

                            </div>


                        </form>
                    </div>

                    <script>
                        function atualizarChave() {
                            alert('Solicitação Enviada.');
                    </script>
                </div>
            </div>
        </div>

        <footer class="footer text-center">
            Desenvolvido por
            <a href="">CDC COMPANY</a>.
        </footer>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../assets/libs/flot/excanvas.js"></script>
    <script src="../assets/libs/flot/jquery.flot.js"></script>
    <script src="../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../dist/js/pages/chart/chart-page-init.js"></script>
</body>

</html>