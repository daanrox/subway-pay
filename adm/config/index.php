<?php
include './../../conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT nome_unico, nome_um, nome_dois FROM app";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();


    $nomeUnicoPlace = $row['nome_unico'];
    $nomeUmPlace = $row['nome_um'];
    $nomeDoisPlace = $row['nome_dois'];

} else {
    return false;
}

$conn->close();
?>


<?php
include './bd.php'; ?>

 <script>
        var nomeUnicoPHP = "<?php echo $nomeUnico; ?>";
        var nomeUmPHP = "<?php echo $nomeUm; ?>";
    </script>
    

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
  <!-- Custom CSS -->
  <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="../dist/css/style.min.css" rel="stylesheet" />
  
  



    <script>
        $(document).ready(function () {
            $("#gateway-form").submit(function (event) {
                event.preventDefault();

                var nomeUnico = $("#input-unico").val();
                var nomeUm = $("#input-um").val();
                var nomeDois = $("#input-dois").val();

                $.ajax({
                    type: "POST",
                    url: "bd.php",
                    data: {
                        nomeUnico: nomeUnico,
                        nomeUm: nomeUm,
                        nomeDois: nomeDois
                    },
                    success: function (response) {
                        alert("Valores atualizados com sucesso!");
                    },
                    error: function (error) {
                        console.error("Erro na requisição AJAX", error);
                    }
                });
            });
        });
    </script>







  
  
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->

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
            <!--<b class="logo-icon ps-2">-->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
            <!--  <img src="../assets/images/logo-icon.png " alt="homepage" class="light-logo" width="25" />-->
            <!--</b>-->
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text ms-2">
              <!-- dark Logo text -->
              <img src="https://daanrox.com/assets/image/daanrox-logo.png" width="100%" height="50" alt="homepage" class="light-logo" />
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
    <!-- ==========    MENU    =================== -->
    <?php include '../components/aside.php' ?>
    
    <div class="page-wrapper">
      <div class="card" style="margin-bottom: 100px;">
        <div class="card-body">
          <h5 class="card-title">Configurações do Site</h5>
        </div>
        <h2 style="margin-left: 25px;">Configurações de Nomes</h1>
        <p style=" margin-left: 25px;">Atenção! Não mexa nessa etapa sem ter certeza do que está fazendo.</p>

        <style>
          #card-title {
            font-size: 25px;
          }

          .input-unico, .input-um, .input-dois, .input-umdois {
            width: 100%;
            min-width: 400px;
            min-height: 40px;
            background-color: #DCDCDC;
            border: none;
            border-radius: 15px;
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
          }

          .card-id,
          .card-secret {
            border: none;
            border-radius: 15px;
            padding: 16px;
            margin: 16px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            width: 600px;
            box-sizing: border-box;
          }

          .button-container {
            margin-left: 20px;
            margin-top: 25px;
          }

          #gateway-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 15px;
            background-color: #27a9e3;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            color: white;
            cursor: pointer;
            outline: none;
          }
          
          #atual-title {
            margin-top: 25px;
            margin-left: 5px;
          }
          
        </style>

        <div class="card-container" style="display: flex;">
            
          <form id="gateway-form">
            <div class="card-id" id="card-gateway">
              <p id="card-title"><strong>Nome do Jogo Único</strong></p>
              
              
              
              <input id="input-unico" class="input-unico" type="text" placeholder="Siga o Padrão: SubwayPay">
              
              
              <h5 id="atual-title">Nome do Jogo Único atual:</h5>
              <input id="atual-unico" class="input-umdois" type="text" disabled placeholder="<?= $nomeUnicoPlace ?>">
              <p style="margin-top: 5px; margin-left: 5px;">Após as alterações, o Jogo Único atual acima, deve estar assim como foi digitado.</p>
            </div>

            <div class="card-secret" id="card-gateway">
              <p id="card-title"><strong>Nome do Jogo Separado</strong></p>
              
              
              
              
              <input id="input-um" class="input-um" type="text" placeholder="Primeira Parte: Subway">
              
              <input id="input-dois" class="input-dois" type="text" style="margin-top: 15px;"placeholder="Segunda Parte: Pay">
              
              
              
              
              
              <h5 id="atual-title">Nome do Jogo Separado atual:</h5>
              
              <input id="atual-umdois" class="input-umdois" type="text" disabled placeholder="<?= $nomeUmPlace ?> <?= $nomeDoisPlace ?>">
              
              <p style="margin-top: 5px; margin-left: 5px;">Após as alterações, o Jogo Separado atual acima, deve estar separado por um espaço.</p>
            </div>

            <div class="button-container">
              <button type="submit" id="gateway-btn"><strong>Salvar Alterações</strong></button>
            </div>
          </form>
        </div>
      </div>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>








    <footer style="position: fixed; bottom: 0; width: 100%; left: 0;" class="footer text-center">
      Desenvolvido por
      <a href="https://daanrox.com">DAANROX</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Page wrapper  -->
  <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="../dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="../dist/js/custom.min.js"></script>
  <!-- this page js -->
  <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
  <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
  <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
  <script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $("#zero_config").DataTable();
  </script>
  <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
      <a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5531992812273&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">
        <div class="rwb-tooltip">Entre em contato!</div>
        <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
      </a>
</body>

</html>
