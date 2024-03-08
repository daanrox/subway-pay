<?php
session_start();

// Verificar se a sessão existe
if (!isset($_SESSION['emailadm'])) {
    // Sessão não existe, redirecionar para outra página
    header("Location: ../login");
    exit();
}

// O restante do código da sua página continua aqui
// ...

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">


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

            <a class="navbar-brand" href="#">
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
              class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          </div>

          <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
           
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
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
            <tr style='background-color: #1f262d; color: #a5a8ab;'>

              <th style='background-color: #1f262d; color: #a5a8ab;'>EMAIL</th>
              <th style='background-color: #1f262d; color: #a5a8ab;'>REFERENCIA</th>
              <th style='background-color: #1f262d; color: #a5a8ab;'>NOME</th>
              <th style='background-color: #1f262d; color: #a5a8ab;'>CPF</th>
              <th style='background-color: #1f262d; color: #a5a8ab;'>VALOR</th>
              <th style='background-color: #1f262d; color: #a5a8ab;'>STATUS</th>
              <th style='background-color: #1f262d; color: #a5a8ab;'>GERIR</th>
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


<script>
  $(document).ready(function() {
    // Use AJAX para buscar dados do arquivo PHP
    $.ajax({
      url: 'bd.php',
      method: 'GET',
      success: function(data) {
        // Limpar o corpo da tabela
        $('#table-body').empty();

        // Verificar se 'data' é um array
        if (Array.isArray(data)) {
          // Inserir dados na tabela
          data.forEach(function(row) {
            var newRow = "<tr data-id='" + row.id + "'>" +
              "<td>" + row.email + "</td>" +
              "<td>" + row.externalreference + "</td>" +
              "<td>" + row.destino + "</td>" +
              "<td>" + row.chavepix + "</td>" +
              "<td>" + row.valor + "</td>" +
              "<td class='status-column'>" + row.status + "</td>" +
              "<td>" +
                "<div class='d-flex align-items-center'>" +
                  "<select class='form-selectatt status-select'>" +
                    "<option value='Pendente'>Processando</option>" +
                    "<option value='Aprovado'>Aprovado</option>" +
                    "<option value='Rejeitado'>Rejeitado</option>" +
                  "</select>" +
                  "<button class='btnatt btn-primaryatt btn-atualizar ms-2'>✔</button>" +
                "</div>" +
              "</td>" +
            "</tr>";

            // Adicionar a nova linha à tabela
            $('#table-body').append(newRow);
          });

          // Adicionar manipulador de evento para os botões de atualização
          $('.btn-atualizar').on('click', function () {
            console.log("Cliquei no botão para atualizar");
            var novoStatus = $(this).siblings('.status-select').val();
            var statusColumn = $(this).closest('tr').find('.status-column');

            // Obter o ID da linha usando o atributo 'data-id'
            var id = $(this).closest('tr').data('id');

            console.log('ID:', id);
            console.log('Novo Status:', novoStatus);

            // Use AJAX para enviar o novo status para o servidor
            $.ajax({
              url: 'atualizar_status.php',
              method: 'POST',
              data: { id: id, novoStatus: novoStatus },
              success: function (response) {
                console.log('Resposta do servidor:', response);
                alert(response);
                // Atualizar a coluna de status na tabela
                statusColumn.text(novoStatus);
              },
              error: function (xhr, status, error) {
                console.log('Erro na requisição AJAX:', status, error);
                console.log('Resposta do servidor:', xhr.responseText);
                alert('Erro ao enviar dados para o servidor.');
              }
            });
          });
        } else {
          console.log('Os dados não são um array:', data);
        }
      },
      error: function () {
        console.log('Erro ao obter dados do servidor.');
      }
    });
  });
</script>
<style>
    .btnatt {
    display: inline-block;
    font-weight: 400;
    line-height: 1.5;
    color: #3e5569;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    border-radius: 2px;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.btn-primaryatt {
    color: #fff;
    background-color: #2962ff;
    border-color: #2962ff;
}
.form-selectatt {
    display: block;
    width: 60%;
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #3e5569;
    vertical-align: middle;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 11px;
    border: 1px solid #e9ecef;
    border-radius: 2px;
    -webkit-appearance: none;
    appearance: none;
}

</style>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>



 <footer class="footer text-center">
        Desenvolvido por
        <a href="http://daanrox.com/">DAANROX</a>.
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
