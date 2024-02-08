<?php
session_start();

if (!isset($_SESSION['emailadm'])) {
    header("Location: ../login");
    exit();
}

include '../../conectarbanco.php';

$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);


$sql = "SELECT * FROM app";
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
 
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo.png" />

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
              <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img
                  src="../assets/images/logo.png"
                  alt="homepage"
                  class="light-logo"
                  width="50"
                />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <h4 style="margin-top: 18px; margin-left: 45px;">Painel</h4>
           
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
   
  <div class="page-wrapper">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Tabela de Saques</h5>
      <div class="table-responsive">
        <table id="user-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Email</th>
              <th>Cod. Referencia</th>
              <th>Destino</th>
              <th>Pix</th>
              <th>Valor</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody id="table-body">
            <!-- Dados da tabela serão inseridos aqui -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- KronosTech iGaming - Desenvolvimento de Sistemas -->

<script>
$(document).ready(function() {
  $.ajax({
    url: 'bd.php',
    method: 'GET',
    success: function(data) {
      $('#table-body').empty();

      data.forEach(function(row) {
        var newRow = "<tr>" +
          "<td>" + row.email + "</td>" +
          "<td>" + row.externalreference + "</td>" +
          "<td>" + row.destino + "</td>" +
          "<td>" + row.chavepix + "</td>" +
          "<td>" + row.valor + "</td>" +
          "<td>" + row.status + "</td>";

        if (row.status === 'Processando') {
          newRow += "<td><button class='btn-pagar' data-email='" + row.email + "' data-externalreference='" + row.externalreference + "' data-destino='" + row.destino + "' data-chavepix='" + row.chavepix + "' data-status='" + row.status + "'>Pagar</button></td>";
        } else {
          newRow += "<td></td>";
        }

        newRow += "</tr>";
        $('#table-body').append(newRow);
      });

      $('#user-table').DataTable({
        ordering: false
      });
    },
    error: function() {
      console.log('Erro ao obter dados do servidor.');
    }
  });

  $(document).on('click', '.btn-pagar', function() {
    var email = $(this).data('email');
    var externalreference = $(this).data('externalreference');
    var destino = $(this).data('destino');
    var chavepix = $(this).data('chavepix');
    var status = $(this).data('status');

    $('#modalEmail').text(email);
    $('#modalExternalReference').text(externalreference);
    $('#modalDestino').text(destino);
    $('#modalChavePix').text(chavepix);
    $('#modalStatus').text(status);

    $('#paymentModal').modal('show');
  });

  $('#confirmPayment').on('click', function() {

      var id = $('#modalExternalReference').text();

      $.ajax({
        type: 'GET',
        url: 'payment_manual.php?id=' + id,
        dataType: 'json',
        success: function(response) {
          if (response.success === true) {
            $('#paymentResult').removeClass('badge-danger').addClass('badge-success').text('Pagamento enviado com sucesso!');
          } else {
            $('#paymentResult').removeClass('badge-success').addClass('badge-danger').text('Error: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          $('#paymentResult').removeClass('badge-success').addClass('badge-danger').text('Error: ' + error);
        }
      });
    });
  });
</script>

<!-- KronosTech iGaming - Desenvolvimento de Sistemas -->

<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Confirmar Pagamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#paymentModal').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        <p><strong>External Reference:</strong> <span id="modalExternalReference"></span></p>
        <p><strong>Destino:</strong> <span id="modalDestino"></span></p>
        <p><strong>Chave Pix:</strong> <span id="modalChavePix"></span></p>
        <p><strong>Status:</strong> <span id="modalStatus"></span></p>
        <div id="paymentResult" class="text-center mt-2"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="$('#paymentModal').modal('hide');" data-dismiss="modal">Fechar</button>
        <button id="confirmPayment" class="text-white btn btn-success">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<!-- KronosTech iGaming - Desenvolvimento de Sistemas -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

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
  </body>
</html>
