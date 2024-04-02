<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
  
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
      href="https://daanrox.com/assets/image/rox-footer.png"
    />
    <!-- Custom CSS -->
    <link href="../libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />



    <style>
      .text-yellow{
        color: yellow;
        font-size:25px;
       

    
      }

      .text-white2{
        color: aliceblue;
        font-size:25px;
      }

      .text-green{
        color: rgb(15, 222, 15);
        font-size:25px;
      }
      
      .bold-red{
        color: red;
        font-size: 20px;
      }
      .text-red{
       color: red;
        font-size:25px;
      }

      .text-red{
       color: red;
        font-size:25px;
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
        margin-right: 5px; /* Adiciona um espaço entre os elementos, se necessário */
        font-size:25px;
        color: yellow;
    }

    h5 {
        display: inline-block;
        margin-right: 5px; /* Adiciona um espaço entre os elementos, se necessário */
        font-size:25px;
        color: rgb(255, 255, 255);
    }




    </style>




  </head>

  <body>
  
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
              <!--    src="https://daanrox.com/assets/image/daanrox-logo.png"-->
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
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
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
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
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
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Sales Cards  -->
          <!-- ============================================================== -->




          
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>



<div class="row">
              




<div class="col-md-6 col-lg-3 col-xlg-3">
  <div class="card card-hover">
    <div class="box bg-dark text-center">
      <h1 class="font-light text-white">
        <i class="mdi mdi-cash-multiple"></i>
      </h1>
    
      <h6 class="text-white">Percas em jogos totais</h6>
      <h5>R$</h5>  <h4 class="text-white2" id="valorUsuarios3">0.00</h4>
    </div>
  </div>
</div>



  
   <script>
    // Evento de clique ou outra ação que aciona a leitura
    $(document).ready(function () {
        // Solicitação AJAX
        $.ajax({
            type: "GET",
            url: "total_percas.php",
            success: function (response) {
                // Atualiza o valor exibido na página
                $("#valorUsuarios3").text(response);
                console.log(response); // Exibe a resposta do servidor no console
            },
            error: function (error) {
                console.log("Erro na solicitação AJAX: " + error);
            }
        });
    });
  </script>



<!-- ============================================================== -->



<!-- ============================================================== -->


<div class="col-md-6 col-lg-3 col-xlg-3">
  <div class="card card-hover">
    <div class="box bg-dark text-center">
      <h1 class="font-light text-white">
        <i class="mdi mdi-cash-multiple"></i>
      </h1>
    
      <h6 class="text-white">GGR Total</h6>
      <h5>R$</h5> <h4 class="text-white2" id="valorUsuarios8">0.00</h4>
    </div>
  </div>
</div>



  
   <script>
    // Evento de clique ou outra ação que aciona a leitura
    $(document).ready(function () {
        // Solicitação AJAX
        $.ajax({
            type: "GET",
            url: "ggrtotal.php",
            success: function (response) {
                // Atualiza o valor exibido na página
                $("#valorUsuarios8").text(response);
                console.log(response); // Exibe a resposta do servidor no console
            },
            error: function (error) {
                console.log("Erro na solicitação AJAX: " + error);
            }
        });
    });
  </script>



<!-- ============================================================== -->



<!-- ============================================================== -->


<div class="col-md-6 col-lg-3 col-xlg-3">
  <div class="card card-hover">
    <div class="box bg-dark text-center">
      <h1 class="font-light text-white">
        <i class="mdi mdi-cash-multiple"></i>
      </h1>
    
      <h6 class="text-white">Sua % de GGR</h6>
      <h4 class="text-yellow" id="valorUsuarios4">8.00</h4><h4>%</h4>
    </div>
  </div>
</div>



  
   <script>
    // Evento de clique ou outra ação que aciona a leitura
    $(document).ready(function () {
        // Solicitação AJAX
        $.ajax({
            type: "GET",
            url: "ggr_taxa.php",
            success: function (response) {
                // Atualiza o valor exibido na página
                $("#valorUsuarios4").text(response);
                console.log(response); // Exibe a resposta do servidor no console
            },
            error: function (error) {
                console.log("Erro na solicitação AJAX: " + error);
            }
        });
    });
  </script>



<!-- ============================================================== -->

</div>
</div>
</div>

















       
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
          Desenvolvido por
          <a href="https://daanrox.com" target='_blank'>DAANROX</a>.
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
     <link rel="stylesheet" href="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-button.css">
      <a id="robbu-whatsapp-button" target="_blank" href="https://api.whatsapp.com/send?phone=5531992812273&text=Ol%C3%A1,%20vim%20pelo%20site%20e%20gostaria%20de%20tirar%20uma%20d%C3%BAvida%20sobre%20abrir%20uma%20plataforma%20de%20apostas%20ou%20problemas%20em%20algum%20de%20seus%20sites.">
        <div class="rwb-tooltip">Entre em contato!</div>
        <img src="https://cdn.positus.global/production/resources/robbu/whatsapp-button/whatsapp-icon.svg">
      </a>
  </body>
</html>
