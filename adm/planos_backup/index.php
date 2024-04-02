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
    
    $cpa = $result['cpa'];
    $chance_afiliado = $result['chance_afiliado'];
    $deposito_min_cpa = $result['deposito_min_cpa'];
    $revenue_share_falso = $result['revenue_share_falso'];
    $max_saque_cpa = $result['max_saque_cpa'];
    $revenue_share = $result['revenue_share'];
    
    
    
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
    <meta
      name="keywords"
      content="Admin Dashboard"
    />
    <meta
      name="description"
      content="Admin Dashboard"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>Admin Dashboard</title>
 
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="../assets/images/favicon.png"
    />
    <!-- Custom CSS -->
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />

  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
  
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
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
              <!--  <img-->
              <!--    src="../assets/images/logo-icon.png "-->
              <!--    alt="homepage"-->
              <!--    class="light-logo"-->
              <!--    width="25"-->
              <!--  />-->
              <!--</b>-->
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2">
                <!-- dark Logo text -->
                <img
                  src="https://daanrox.com/assets/image/daanrox-logo.png"
                  width="100%" height="50"
                  alt="homepage"
                  class="light-logo"
                />
              </span>
           
            </a>
        
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>

          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5">
   
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>
            
         
            
            </ul>
          </div>
        </nav>
      </header>
       <!-- ==========    MENU    =================== -->
    <?php include '../components/aside.php' ?>
      
      
      
      
      
      <style>
  /* Estilos da tabela */
  #user-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  #user-table th, #user-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  #user-table th {
    background-color: #f2f2f2;
  }

  #user-table input[type="text"] {
    width: 80px; /* Ajuste conforme necessário */
    padding: 5px;
    margin: 0;
    box-sizing: border-box;
    border: none; /* Remover as bordas dos inputs */
    background-color: transparent; /* Tornar os inputs transparentes */
  }
  /* Estilos do botão */
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
                width: 320px;
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
                <form action='update.php?field=cpa' method='post'>
                    <p class="title">CPA (R$):</p> 
                    <p class="description">Ganho em R$ pelo primeiro depósito do indicado, feito ao afiliado.</p>
                    <input class="box-input" name="value" value="<?php echo $cpa?>"/>
                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
            <div class="box">
                <form action='update.php?field=chance_afiliado' method='post'>
                    <p class="title">Chance do afiliado ganhar comissões de seus indicados (%):</p> 
                    <p class="description">Quantos % de cadastros irão contabilizar. (Ideal: 100%)</p>
                    <input class="box-input" name="value" value="<?php echo $chance_afiliado?>"/>
                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
            <div class="box">
                <form action='update.php?field=deposito_min_cpa' method='post'>
                    <p class="title">Depósito Mínimo Para Afiliado Ganhar CPA:</p> 
                    <p class="description">Valor de depósito mínimo que os convidados do afiliado devem fazer para gerar receita de CPA.</p>
                    <input class="box-input" name="value"value="<?php echo $deposito_min_cpa?>"/>
                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
            <div class="box">
                <form action='update.php?field=revenue_share_falso' method='post'>
                    <p class="title">Porcentagem de Rev. Share Falso (%):</p> 
                    <p class="description">Valor a mais de revenue share que irá aparecer aos usuários (aumentar lucros do site).</p>
                    <input class="box-input" name="value" value="<?php echo $revenue_share_falso?>"/>
                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
            <div class="box">
                <form action='update.php?field=max_saque_cpa' method='post'>
                    <p class="title">Saque máximo:</p> 
                    <p class="description">Quantidade de saques máxima que um afiliado pode fazer por dia.</p>
                    <input class="box-input" name="value" value="<?php echo $max_saque_cpa?>"/>
                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
            <div class="box">
                <form action='update.php?field=max_por_saque_cpa' method='post'>
                    <p class="title">Máximo por saque:</p> 
                    <p class="description">Valor máximo que um afiliado irá conseguir sacar por dia.</p>
                    <input class="box-input" name="value" value="<?php echo $max_por_saque_cpa?>"/>
                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
            <div class="box">
                <form action='update.php?field=revenue_share' method='post'>
                    <p class="title">Revenue Share (%):</p> 
                    <p class="description">Porcentagem dada aos afiliados por cada perca real dos indicados.</p>
                    <input class="box-input" name="value" value="<?php echo $revenue_share?>"/>
                    <button type="submit" class="btn box-btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>

    </div>
  </div>
</div>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>







      
         <footer class="footer text-center">
                        Desenvolvido por
                        <a href="https://daanrox.com">DAANROX</a>
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
